<div class="col-md-3">
    <a href="{{ route('admin.patient.email') }}" class="btn btn-primary btn-block margin-bottom">Compose</a>

    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Folders</h3>

        <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
          <li class="{{ App\Navigation::setActive('admin.inbox') }}"><a href="{{ route('admin.inbox') }}"><i class="fa fa-inbox"></i> Inbox
            @if (count(Auth::user()->unreadNotifications->where('type','App\Notifications\PatientEmailNotification')))
              <span class="label label-primary pull-right">{{ count(Auth::user()->unreadNotifications) }}</span></a></li>
            @endif
          <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
  </div>