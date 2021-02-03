<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('auth:admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient){
        $pages = $this->get_pages($patient);
        return view('/admin/patient/file', compact('patient', 'pages'));
    }

     /**
     * Display the specified resource.
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function print(Patient $patient){
        $pages = $this->get_pages($patient);
        return view('/admin/patient/print', compact('patient', 'pages'));
    }

     /**
     * Get add new appointment data form
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function edit_add(Patient $patient){
        return view('/admin/patient/addfile', compact('patient'));
    }

     /**
     * Get update previous appointment data form
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function edit_update(Request $request, Patient $patient){
        $prescriptions = $patient->prescriptions;
        $images = $this->groupImages($patient->images);
        $comments = $patient->comments;
        
        $pages = $this->arrays2pages($prescriptions, $images, $comments);
        
        $pages = $this->sortPages($pages[1], $pages[0]);
        $page = $pages[((int)$request->pageNumber) - 1];
        $date = $page[5];

        $ids[0] = null;
        $ids[1] = array();
        $ids[2] = null;

        if ($page[0] != null) {
            $ids[0] = $page[0]->id;
        }

        if($page[1] != null){
            $images = $page[1];
            for ($i = 0; $i < count($images); $i++) {
                $imagesIds[] = $images[$i]->id;
            }
            $ids[1] = $imagesIds;
        }

        if ($page[2] != null) {
            $ids[2] = $page[2]->id;
        }

        return view('/admin/patient/updatefile', compact('patient', 'page', 'ids', 'date'));
    }

    /**
     * Store file photos
     *
     * @param  Image $photo
     * @param  String $caption
     * @param  Int $id
     * @return void
     */
    private function update_photo($photo, $caption, $id, $date){
        // store the picture (you must run this commant to view the pictures in the views `php artisan storage:link`)
        $filePath = $photo->store('/public/patients/files/' . $id);

        $photo = new image;

        $photo->image = $filePath;
        $photo->caption = $caption;
        $photo->patient_id = $id;
        $photo->admin_id = Auth::user()->id;
        $photo->created_at = $date;

        $photo->save();
    }

    /**
     * Store file photos
     *
     * @param  Array $photos
     * @param  Array $captions
     * @param  Int $id
     * @return void
     */
    private function update_photos($id, $photos, $captions, $date){
        for ($i = 0; $i < count($photos); $i++) {
            $this->update_photo($photos[$i], $captions[$i], $id, $date);
        }
    }

     /**
     * Update previous appointments data to patient file
     *
     * @param  Request $request
     * @param  array $arr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient){

        $ids[0] = (int)$request->prescriptions_id;
        $ids[1] = explode(" ", $request->photos_ids);
        $ids[2] = (int)$request->comments_id;
        $photos_ids = $ids[1];
        for ($i = 0; $i < count($photos_ids); $i++) {
            $photos_ids[$i] = (int)$photos_ids[$i];
        }

        $date = $request->date;

        $prescriptions = null;
        $comments = null;
        $photos = null;
        $captions = null;
        $pages = null;

        echo $date;

        $images = $ids[1];
        
        foreach ($images as $image) {
            $i = image::find($image);
            if($i)
                $i->delete();
        }

        $this->validate($request, [
            'photo_1' => 'image',
            'photo_2' => 'image',
            'photo_3' => 'image',
            'photo_4' => 'image',
            'photo_5' => 'image',
            'photo_6' => 'image',
            'photo_7' => 'image',
            'photo_8' => 'image',
            'photo_9' => 'image',
            'photo_10' => 'image',
        ]);

        if ($request->photo_1 != "") {
            $photos[] = $request->photo_1;
            $captions[] = $request->photo_1_cap;
        }

        if ($request->photo_2 != "") {
            $photos[] = $request->photo_2;
            $captions[] = $request->photo_2_cap;
        }

        if ($request->photo_3 != "") {
            $photos[] = $request->photo_3;
            $captions[] = $request->photo_3_cap;
        }

        if ($request->photo_4 != "") {
            $photos[] = $request->photo_4;
            $captions[] = $request->photo_4_cap;
        }

        if ($request->photo_5 != "") {
            $photos[] = $request->photo_5;
            $captions[] = $request->photo_5_cap;
        }

        if ($request->photo_6 != "") {
            $photos[] = $request->photo_6;
            $captions[] = $request->photo_6_cap;
        }

        if ($request->photo_7 != "") {
            $photos[] = $request->photo_7;
            $captions[] = $request->photo_7_cap;
        }

        if ($request->photo_8 != "") {
            $photos[] = $request->photo_8;
            $captions[] = $request->photo_8_cap;
        }

        if ($request->photo_9 != "") {
            $photos[] = $request->photo_9;
            $captions[] = $request->photo_9_cap;
        }

        if ($request->photo_10 != "") {
            $photos[] = $request->photo_10;
            $captions[] = $request->photo_10_cap;
        }

        if ($photos != null) {
            $this->update_photos($patient->id, $photos, $captions, $date);
        }

        
        if ($ids[0] == null && $request->prescription != "") {
            $prescription = new prescription;
            $prescription->name = $request->prescription;
            $prescription->patient_id = $patient->id;
            $prescription->admin_id = Auth::id();
            $prescription->created_at = $date;
            $prescription->save();
        }
        else if ($request->prescription == ""){
            $prescription = prescription::find($ids[0]);
            if($prescription)
            $prescription->delete();
        }
        else{
                $prescription = prescription::find($ids[0]);
                if($prescription)
                $prescription->name = $request->prescription;
                $prescription->save();
            }

        if ($ids[2] == null && $request->comment != "") {
            $comment = new comment;
            $comment->content = $request->comment;
            $comment->patient_id = $patient->id;
            $comment->admin_id = Auth::id();
            $comment->created_at = $date;
            $comment->save();
        }
        else if ($request->comment == "") {
            $comment = comment::find($ids[2]);
            if($comment)
            $comment->delete();
        }
        else{
            $comment = comment::find($ids[2]);
            if($comment)
            $comment->content = $request->comment;
            $comment->save();
        }

        return redirect()->route("admin.patient.file", $patient->id)->with('status' ,'Patient File has been updated Successfully!!!');
    }

    /**
     * Store file photos
     *
     * @param  Image $photo
     * @param  String $caption
     * @param  Int $id
     * @return void
     */
    private function store_photo($photo, $caption, $id){
        // store the picture (you must run this commant to view the pictures in the views `php artisan storage:link`)
        $filePath = $photo->store('/public/patients/files/' . $id);

        $photo = new image;

        $photo->image = $filePath;
        $photo->caption = $caption;
        $photo->patient_id = $id;
        $photo->admin_id = Auth::user()->id;

        $photo->save();
    }

    /**
     * Store file photos
     *
     * @param  Array $photos
     * @param  Array $captions
     * @param  Int $id
     * @return void
     */
    private function store_photos($photos, $captions, $id){
        for ($i = 0; $i < count($photos); $i++) {
            $this->store_photo($photos[$i], $captions[$i], $id);
        }
    }

     /**
     * Add new appointment data to patient file
     *
     * @param  Request $request
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, Patient $patient){
        $prescriptions = null;
        $comments = null;
        $photos = null;
        $captions = null;
        $pages = null;

        $this->validate($request, [
            'photo_1' => 'image',
            'photo_2' => 'image',
            'photo_3' => 'image',
            'photo_4' => 'image',
            'photo_5' => 'image',
            'photo_6' => 'image',
            'photo_7' => 'image',
            'photo_8' => 'image',
            'photo_9' => 'image',
            'photo_10' => 'image',
        ]);

        if ($request->photo_1 != "") {
            $photos[] = $request->photo_1;
            $captions[] = $request->photo_1_cap;
        }

        if ($request->photo_2 != "") {
            $photos[] = $request->photo_2;
            $captions[] = $request->photo_2_cap;
        }

        if ($request->photo_3 != "") {
            $photos[] = $request->photo_3;
            $captions[] = $request->photo_3_cap;
        }

        if ($request->photo_4 != "") {
            $photos[] = $request->photo_4;
            $captions[] = $request->photo_4_cap;
        }

        if ($request->photo_5 != "") {
            $photos[] = $request->photo_5;
            $captions[] = $request->photo_5_cap;
        }

        if ($request->photo_6 != "") {
            $photos[] = $request->photo_6;
            $captions[] = $request->photo_6_cap;
        }

        if ($request->photo_7 != "") {
            $photos[] = $request->photo_7;
            $captions[] = $request->photo_7_cap;
        }

        if ($request->photo_8 != "") {
            $photos[] = $request->photo_8;
            $captions[] = $request->photo_8_cap;
        }

        if ($request->photo_9 != "") {
            $photos[] = $request->photo_9;
            $captions[] = $request->photo_9_cap;
        }

        if ($request->photo_10 != "") {
            $photos[] = $request->photo_10;
            $captions[] = $request->photo_10_cap;
        }

        if ($photos != null) {
            $this->store_photos($photos, $captions, $patient->id);
        }

        $prescription = new prescription;
        if ($request->prescription != "")
        {
            $prescription->name = $request->prescription;
        }
        else 
            {$prescription->name = "Empty";}
            $prescription->patient_id = $patient->id;
            $prescription->admin_id = Auth::id();
            $prescription->save();
        $comment = new comment;
        if ($request->comment != "")
        {
            $comment->content = $request->comment;
        }
        else
           { $comment->content = "Empty";}
            $comment->patient_id = $patient->id;
            $comment->admin_id = Auth::id();
            $comment->save();
        if($request->prescription == "" && $request->comment == "" && $photos == null)
        {
            return back()->with('alarm','File is Empty !!!');
        }
        return redirect()->route("admin.patient.file", $patient->id)->with('status' ,'Patient File has been added Successfully!!!');
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

        return redirect()->route("admin.patient.file", $patient->id)->with('status' ,'Patient File has been deleted Successfully!!!');
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