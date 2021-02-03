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
    <form method="POST" action="{{ route('admin.patient.updatefile', $patient->id) }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $date }}" name="date">
        <input type="hidden" value="{{ $ids[0] }}" name="prescriptions_id">
        <input type="hidden" value="{{ implode(" ",$ids[1]) }}" name="photos_ids">
        <input type="hidden" value="{{ $ids[2] }}" name="comments_id">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Prescriptions Section</h3>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body pad">
                <textarea class="prescription" name="prescription" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">@if($page[0]){{ $page[0]->name }}@endif</textarea>
            </div>
            
        </div>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Photos Section</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body pad photos">
                @if($page[1])
                <?php $numImages = 10 - count($page[1]); $index = 0; ?>
                @else
                <?php $numImages = 10; $index = 0; ?>
                @endif
                @if($page[1])
                {{-- @foreach ($page[1] as $photo)
                    <div style="margin-bottom: 20px;">
                        <input type="file" id="photo_{{ ++$index }}" class="upload-photo" style="display: none" name="photo_{{ $index }}" value="{{ Storage::disk('local')->url($photo->image) }}" />
                        <label for="photo_{{ $index }}" class="btn btn-primary">Upload Photo</label>
                        <input type="text" style="margin-top: 10px;" class="form-control cap-input" name="photo_{{ $index }}_cap" placeholder="photo {{ $index }} caption" value="{{ $photo->caption }}" />
                    </div>
                @endforeach --}}
                @endif

                @for ($i = 0; $i < 10; $i++)
                    <div style="margin-bottom: 20px;">
                        <input type="file" id="photo_{{ ++$index }}" class="upload-photo" style="display: none" name="photo_{{ $index }}" />
                        <label for="photo_{{ $index }}" class="btn btn-primary">Upload Photo</label>
                        <input type="text" style="margin-top: 10px;" class="form-control cap-input" name="photo_{{ $index }}_cap" placeholder="photo {{ $index }} caption" disabled/>
                    </div>
                @endfor
                
            </div>
        </div>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Comments Section</h3>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body pad">
                <textarea class="comments" name="comment" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">@if($page[2]){{ $page[2]->content }}@endif</textarea>
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