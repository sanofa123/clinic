@extends('admin.layouts.layout')

@section('title')
		Read Email
@endsection

@section('css')
	{{-- here goes the css of page --}}
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
          <h3 class="box-title">Read Mail</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="mailbox-read-info">
            <h3>{{ $email->data['subject'] }}</h3>
            <h5>From: {{ $email->sender->email }}
              <span class="mailbox-read-time pull-right">{{ $email->created_at->toDayDateTimeString() }}</span></h5>
          </div>
          <!-- /.mailbox-read-info -->
          <div class="mailbox-controls with-border text-center">
            <div class="btn-group">
              <form action="{{ route('admin.email.delete') }}" method="POST" class="inline">
                @csrf
                {{ method_field('DELETE') }}
                <input type="hidden" name="emails[]" value="{{ $email->id }}">
                <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                <i class="far fa-trash-alt"></i></button>
              </form>
              <a href="{{ route('admin.patient.email', $email->sender->id) }}" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                <i class="fa fa-reply"></i></a>
            </div>
          </div>
          <!-- /.mailbox-controls -->
          <div class="mailbox-read-message">
            {!! htmlspecialchars_decode($email->data['message']) !!}
          </div>
          <!-- /.mailbox-read-message -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="pull-right">
            <a href="{{ route('admin.patient.email', $email->sender->id) }}" class="btn btn-default"><i class="fa fa-reply"></i> Reply</a>
          </div>
            <form action="{{ route('admin.email.delete') }}" method="POST" class="inline">
              @csrf
              {{ method_field('DELETE') }}
              <input type="hidden" name="emails[]" value="{{ $email->id }}">
              <button type="submit" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
            </form>
        </div>
        <!-- /.box-footer -->
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
@endsection