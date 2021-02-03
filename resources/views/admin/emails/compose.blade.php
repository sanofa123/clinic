@extends('admin.layouts.layout')

@section('title')
		Email patient
@endsection

@section('css')
	{{-- here goes the css of page --}}
  <link rel="stylesheet" href="{{ asset('/admin_styles/css/bootstrap3-wysihtml5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/admin_styles/css/jquery-ui.min.css') }}">
@endsection

@section('body')
	{{-- here goes content of pages --}}

<section class="content-header">
  <h1>
    Mailbox
    <small>{{ count(Auth::user()->unreadNotifications) }} new messages</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    @include('admin.emails.layout')
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Compose New Message</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
          @endforeach
          <form  method="post" action="{{ route('admin.patient.email') }}">
            @csrf
            <div class="form-group">
              <input type="email" id="emails" class="form-control" value="{{ isset($patient->email) ? $patient->email : old('email') }}" name="email" placeholder="To:" required autofocus>
            </div>
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Subject:" value="{{ old('subject') }}" name="subject" required>
            </div>
                  
            <textarea name="message" class="textarea" placeholder="Write message here..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{{ old('message') }}</textarea>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="pull-right">
              <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
            </div>
            <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </div>
</div>
  <!-- /.row -->
</section>

@endsection

@section('js')
	{{-- here goes js files --}}
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('/admin_styles/js/bootstrap3-wysihtml5.all.min.js') }}"></script>
  <script src="{{ asset('/admin_styles/js/jquery-ui.min.js') }}"></script>
  <script>
    $(function () {
      //bootstrap WYSIHTML5 - text editor
      $(".textarea").wysihtml5();
      $( "#emails" ).autocomplete({
        source: "{{ url('/admin/patient/search') }}"
      });
    });
  </script>
@endsection