@extends('admin.layouts.layout')

@section('title')
	Add Patient File
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/admin_styles/css/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('body')
    <div class="pt-3 pb-3">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger"><i class="fa fa-times fa-lg"></i> {{ $error }}</div>
        @endforeach
    </div>

    <form method="POST" action="{{ route('admin.patient.addfile', $patient->id) }}" enctype="multipart/form-data">
        @csrf

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Prescriptions Section</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
                <textarea class="prescription" name="prescription" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
        </div>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Photos Section</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body pad photos">
                <div style="margin-bottom: 20px;">
                    <input type="file" id="photo_1" class="upload-photo" style="display: none" name="photo_1"/>
                    <label for="photo_1" class="btn btn-primary">Upload Photo</label>
                    <input type="text" style="margin-top: 10px;" class="form-control cap-input" name="photo_1_cap" placeholder="photo 1 caption" disabled/>
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="file" id="photo_2" class="upload-photo" style="display: none" name="photo_2"/>
                    <label for="photo_2" class="btn btn-primary">Upload Photo</label>
                    <input type="text" style="margin-top: 10px;" class="form-control cap-input" name="photo_2_cap" placeholder="photo 2 caption" disabled/>
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="file" id="photo_3" class="upload-photo" style="display: none" name="photo_3"/>
                    <label for="photo_3" class="btn btn-primary">Upload Photo</label>
                    <input type="text" style="margin-top: 10px;" class="form-control cap-input" name="photo_3_cap" placeholder="photo 3 caption" disabled/>
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="file" id="photo_4" class="upload-photo" style="display: none" name="photo_4"/>
                    <label for="photo_4" class="btn btn-primary">Upload Photo</label>
                    <input type="text" style="margin-top: 10px;" class="form-control cap-input" name="photo_4_cap" placeholder="photo 4 caption" disabled/>
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="file" id="photo_5" class="upload-photo" style="display: none" name="photo_5"/>
                    <label for="photo_5" class="btn btn-primary">Upload Photo</label>
                    <input type="text" style="margin-top: 10px;" class="form-control cap-input" name="photo_5_cap" placeholder="photo 5 caption" disabled/>
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="file" id="photo_6" class="upload-photo" style="display: none" name="photo_6"/>
                    <label for="photo_6" class="btn btn-primary">Upload Photo</label>
                    <input type="text" style="margin-top: 10px;" class="form-control cap-input" name="photo_6_cap" placeholder="photo 6 caption" disabled/>
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="file" id="photo_7" class="upload-photo" style="display: none" name="photo_7"/>
                    <label for="photo_7" class="btn btn-primary">Upload Photo</label>
                    <input type="text" style="margin-top: 10px;" class="form-control cap-input" name="photo_7_cap" placeholder="photo 7 caption" disabled/>
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="file" id="photo_8" class="upload-photo" style="display: none" name="photo_8"/>
                    <label for="photo_8" class="btn btn-primary">Upload Photo</label>
                    <input type="text" style="margin-top: 10px;" class="form-control cap-input" name="photo_8_cap" placeholder="photo 8 caption" disabled/>
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="file" id="photo_9" class="upload-photo" style="display: none" name="photo_9"/>
                    <label for="photo_9" class="btn btn-primary">Upload Photo</label>
                    <input type="text" style="margin-top: 10px;" class="form-control cap-input" name="photo_9_cap" placeholder="photo 9 caption" disabled/>
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="file" id="photo_10" class="upload-photo" style="display: none" name="photo_10"/>
                    <label for="photo_10" class="btn btn-primary">Upload Photo</label>
                    <input type="text" style="margin-top: 10px;" class="form-control cap-input" name="photo_10_cap" placeholder="photo 10 caption" disabled/>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Comments Section</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
                <textarea class="comments" name="comment" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
        </div>
        {{ method_field('PATCH') }}
        <button type="submit" class="btn btn-primary btn-block mt-2 mb-4">Save</button>
    </form>
@endsection

@section('js')
	<script src="{{asset('/admin_styles/js/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script>
        $(function () {
            $(".prescription").wysihtml5();
            $(".comments").wysihtml5();
        });
        $('.upload-photo').on('change', function(event){
            var target = event.target || event.srcElement;
            if (target.value.length == 0) {
                $(this).next().next().prop('disabled', true);
            }
            else{
                $(this).next().next().prop('disabled', false);
            }
        });
    </script>
@endsection