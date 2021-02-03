@extends('admin.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Admin home
@endsection

@section('css')
	{{-- here goes the css of page --}}
@endsection

@section('body')
	{{-- here goes content of pages --}}
	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif

  <section class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Today's Reservations
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">

        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            @foreach ($reservations as $reservation)
            <li class="time-label">
                  <span class="bg-blue">
                   {{ $reservation['date'] }}
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i>
                   {{ $reservation['time'] }}
                   </span>

                <h3 class="timeline-header"><a href="#">{{ $reservation['patient'] }}</a></h3>

                <div class="timeline-body">
                  Doctor : {{ $reservation['doctor'] }}
                  <br/>
                   <br/>
                  Clinic : {{ $reservation['clinic'] }}
                  <br/>
                    <br/>
           
                    <a href="#" class="bg-green btn-xs">
                  Confirmed by {{ $reservation['nurse'] }}
                   </a>
                </div>
                <div style="margin: 10px">
                    @if($reservation['attend']==1)
                     <a href="#" class="bg-green btn-xs"
                     >
                       Attended
                     </a>
                     @else
                     <a href="#" class="bg-yellow btn-xs"
                     >
                       ...
                     </a>
                     @endif
                </div>
                <div class="timeline-footer">
                </div>
              </div>
            </li>
            @endforeach
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
</section>




@endsection

@section('js')
	{{-- here goes js files --}}
@endsection