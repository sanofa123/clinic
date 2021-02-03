<?php

namespace App\Http\Controllers\Nurse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\image;
use App\Models\comment;
use App\Models\admin;
use App\Models\prescription;
use Illuminate\Validation\Rule;
use Auth;
use Storage;

class FileController extends Controller
{
    public function __construct() {
        $this->middleware('auth:nurse');
    }

    /**
     * Display the specified resource.
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient){
        $pages = $this->get_pages($patient);
        return view('/nurse/patient/file', compact('patient', 'pages'));
    }

     /**
     * Display the specified resource.
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function print(Patient $patient){
        $pages = $this->get_pages($patient);
        return view('/nurse/patient/print', compact('patient', 'pages'));
    }

     /**
     * Delete Patient File
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient){
        $patient->prescriptions()->delete();
        $patient->images()->delete();
        $patient->comments()->delete();

        return redirect()->route("nurse.patient.file", $patient->id)->with('status' ,'Patient File has been deleted Successfully!!!');
    }

     /**
     * Convert a string of HTML tags to array of separate tags
     *
     * @param  String $tags
     * @return array
     */
    private function string2tags($tags){
        $tagsArray = array();
        $start = 0;
        $flag = false;

        for ($i = 0; $i < strlen($tags); $i++){
            if($flag == false && $tags[$i] == '<'){
                $flag = true;
                $start = $i;
            }

            if($flag == true && $tags[$i] == '<'){
                if($tags[$i + 1] == '/'){
                    $i = $i + 2;
                    while($tags[$i++] != '>');
                    $tagsArray[] = substr($tags, $start, $i - $start);
                    $flag = false;
                    $i--;
                }
            }

            if($i == strlen($tags)){
                break;
            }
        }

        return $tagsArray;
    }

    /**
     * Get image size from stored image
     *
     * @param  String $imagePath
     * @return Array
     */
    private function data2size($imagePath){
        $photo = Storage::get($imagePath);

        $size = getimagesizefromstring($photo);

        $dimentions = array();

        $dimentions[] = $size[0];
        $dimentions[] = $size[1];

        return $dimentions;
    }

     /**
     * Group all images created at the same time in an array
     *
     * @param  Array $images
     * @return array
     */
    public function groupImages($images)
    {
        for ($i = 0; $i < count($images); $i++) {
            $imageSize = $this->data2size($images[$i]->image);

            $images[$i]->width = $imageSize[0];
            $images[$i]->height = $imageSize[1];
        }

        if (count($images) > 1){
            $start = $images[0]->created_at;
            $group[] = $images[0];
            for ($i = 1; $i < count($images); $i++) {
                if ($images[$i]->created_at == $start) {
                    $group[] = $images[$i];
                    if($i == count($images) - 1){
                        $photos[] = $group;
                    }
                }
                else{
                    $photos[] = $group;
                    $group = null;
                    $group[] = $images[$i];
                    $start = $images[$i]->created_at;
                }
            }
        }
        else if(count($images) == 1) {
            $group[] = $images[0];
            $photos[] = $group;
        }
        else{
            $photos = array();
        }

        return $photos;
    }

    /**
     * Group all file elements to one array
     *
     * @param  Array $prescriptions
     * @param  Array $images
     * @param  Array $comments
     * @return array
     */
    public function arrays2pages($prescriptions, $images, $comments)
    {
        $pages = null;
        $sortedPages = null;

        for ($i = 0; $i < count($prescriptions); $i++) {
            $admin = Admin::find($prescriptions[$i]->admin_id);
            $page = array($prescriptions[$i], null, null, $admin->name, $admin->email, $prescriptions[$i]->created_at);
            $sortedPages[] = $prescriptions[$i]->created_at;

            for ($j = 0; $j < count($images); $j++) {
                $image = $images[$j];
                if($image != null) {
                    if ($image[0]->created_at == $prescriptions[$i]->created_at) {
                        $page[1] = $image;
                        $images[$j] = null;
                        break;
                    }
                }
            }

            for ($j = 0; $j < count($comments); $j++) {
                if($comments[$j] != null) {
                    if ($comments[$j]->created_at == $prescriptions[$i]->created_at) {
                        $page[2] = $comments[$j];
                        $comments[$j] = null;
                        break;
                    }
                }
            }

            $pages[] = $page;
        }

        for ($i = 0; $i < count($images); $i++) {
            if ($images[$i] != null) {
                $image = $images[$i];
                $admin = Admin::find($image[0]->admin_id);
                $page = array(null, $image, null, $admin->name, $admin->email, $image[0]->created_at);
                
                $sortedPages[] = $image[0]->created_at;

                for ($j = 0; $j < count($images); $j++) {
                    if ($comments[$j] != null) {
                        if ($comments[$j]->created_at == $image[0]->created_at) {
                            $page[2] = $comments[$j];
                            $comments[$j] = null;
                            break;
                        }
                    }
                }

                $pages[] = $page;
            }
        }

        foreach ($comments as $comment) {
            if ($comment != null) {
                $admin = Admin::find($comment->admin_id);
                $sortedPages[] = $comment->created_at;
                $pages[] = array(null, null, $comment, $admin->name, $admin->email, $comment->created_at);
            }
        }

        return array($pages, $sortedPages);
    }

    /**
     * Sort pages with creation time
     *
     * @param  Array $sort
     * @param  Array $pages
     * @return array
     */
    public function sortPages($sort, $pages){
        $sortedPages = null;

        sort($sort, SORT_REGULAR);

        foreach ($sort as $s) {
            foreach($pages as $page){
                if ($page[0] != null){
                    if ($s == $page[0]->created_at){
                        $sortedPages[] = $page;
                        break;
                    }
                }
                else if ($page[1] != null) {
                    $p = $page[1];
                    if ($s == $p[0]->created_at){
                        $sortedPages[] = $page;
                        break;
                    }
                }
                else{
                    if ($s == $page[2]->created_at){
                        $sortedPages[] = $page;
                        break;
                    }
                }
            }
        }

        return $sortedPages;
    }

    /**
     * Create pages array from prescriptions, images and comments
     *
     * @param  Patient $patient
     * @return array
     */
    public function get_pages($patient){
        $prescriptions = $patient->prescriptions;
        $images = $this->groupImages($patient->images);
        $comments = $patient->comments;
        
        if ($images == null && count($prescriptions) == 0 && count($comments) == 0) {
            return null;
        }
        
        $pages = $this->arrays2pages($prescriptions, $images, $comments);
        
        $pages = $this->sortPages($pages[1], $pages[0]);

        for ($i = 0; $i < count($pages); $i++) {
            $page = $pages[$i];
            $prescriptions = $page[0];
            $comments = $page[2];

            if ($prescriptions != null) {
                $page[0] = $this->string2tags($prescriptions->name);
            }
            else{
                $page[0] = array();
            }

            if ($comments != null) {
                $page[2] = $this->string2tags($comments->content);
            }
            else{
                $page[2] = array();
            }

            $pages[$i] = $page;
        }

        return $pages;
    }
}