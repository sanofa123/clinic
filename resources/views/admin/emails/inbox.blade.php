@extends('admin.layouts.layout')

@section('title')
		Admin inbox
@endsection

@section('css')
	{{-- here goes the css of page --}}
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('/admin_styles/css/flat/blue.css') }}">
@endsection

@section('body')
	{{-- here goes content of pages --}}

<section class="content-header">
  <h1>
    Mailbox
    <small>{{ count(Auth::user()->unreadNotifications->where('type','App\Notifications\PatientEmailNotification')) }} new messages</small>
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
          <h3 class="box-title">Inbox</h3>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
            </button>
            <div class="btn-group">
              <form action="{{ route('admin.email.delete') }}" method="POST" id="deleteForm">
                @csrf
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-default btn-sm" title="Delete selected"><i class="far fa-trash-alt"></i></button>
              </form>
            </div>
            <form class="inline" method="post" action="{{ route('admin.emails.mark') }}">
              @csrf
              <button type="submit" class="btn btn-default btn-sm" title="Mark all as read"><i class="fa fa-check"></i></button>
            </form>
            <!-- /.pull-right -->
          </div>
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tbody>
                @foreach ($notifications as $notification)
                  <tr>
                    <td>
                      <input name="emails[]" form="deleteForm" value="{{ $notification->id }}" type="checkbox">
                    </td>
                    <td class="mailbox-name">
                      <a href="{{ route('admin.email.show', $notification->id) }}">
                        @if ($notification->read_at)
                          {{ $notification->sender->name }}
                        @else
                          <b>{{ $notification->sender->name }}</b>
                        @endif
                      </a></td>
                    <td class="mailbox-subject">
                      @if ($notification->read_at)
                        {{ $notification->data['subject'] }}
                      @else
                        <b>{{ $notification->data['subject'] }}</b>
                      @endif
                    </td>
                    <td class="mailbox-date">{{ $notification->created_at->diffForHumans() }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer no-padding">
          <div class="mailbox-controls">
            <div class="pull-right">
              {{ $notifications->links() }}
            </div>
              <!-- /.btn-group -->
            </div>
            <!-- /.pull-right -->
          </div>
        </div>
      </div>
    </div>
    <!-- /.col -->
</div>
  <!-- /.row -->
</section>

@endsection

@section('js')
	{{-- here goes js files --}}
  <!-- iCheck -->
<script src="{{ asset('admin_styles/js/icheck.min.js') }}"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });
  });
</script>
@endsection