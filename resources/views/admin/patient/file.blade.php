@extends('admin.layouts.layout')

@section('title')
	Patient File
@endsection

@section('css')
	<link href="https://fonts.googleapis.com/css?family=Economica:400,700&amp;subset=latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('/admin_styles/css/file.css') }}">
@endsection

@section('body')

    @if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif

    @if ($pages != null)
        <div class="container">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Choose an appointment to edit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="page-number-form" action="{{ route('admin.patient.updatefile', $patient->id) }}" method="POST">
                                @csrf
                                <select class="form-control" name="pageNumber">
                                    @for ($i = 0; $i < count($pages); $i++)
                                    <?php $page = $pages[$i]; ?>
                                        <option>{{ date('M d, Y', strtotime($page[5])) }}</option>
                                    @endfor
                                </select>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="$('.page-number-form').submit();">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn file-button print-button" style="top: 60%;">
                <a class="ml-auto mr-auto" target="_blank" href="{{ route('admin.patient.printfile', $patient->id) }}"><i class="fa fa-print"></i> Print</a>
            </div>
            <a class="ml-auto mr-auto" href="{{ route('admin.patient.addfile', $patient->id) }}">
            <div class="btn btn-success file-button" style="top: 70%;">
                <i class="fa fa-plus"></i> Add
            </div>
            </a>
            <a class="ml-auto mr-auto" data-toggle="modal" data-target="#exampleModal" href="#">
            <div class="btn btn-primary file-button" style="top: 80%;">
                <i class="fa fa-edit"></i> Update
            </div>
            </a>
            <a onclick=
                    "event.preventDefault();
                    if(confirm('Are you sure you want to delete this file?')) {
                        $('.delete-form').submit();
                    }"
                    class="ml-auto mr-auto"
                    href="#">
            <div class="btn btn-danger file-button" style="top: 90%;">
                <i class="fa fa-trash"></i> Delete
            </div>
            </a>
            <form class="delete-form" action="{{ route('admin.patient.deletefile', $patient->id) }}" method="POST">
                @csrf
                {{ method_field('DELETE') }}
            </form>
        </div>
    
        <div class="book">
            <?php $num_pages = 0; $num_figues = 0; ?>

            @foreach ($pages as $page)
                <?php
                    $prescriptions = $page[0];
                    $images = $page[1];
                    $comments = $page[2];
                    $doctor_name = $page[3];
                    $doctor_email = $page[4];
                    $date = date('M d, Y',strtotime(substr($page[5], 0, 10)));
                ?>
                @if ($num_pages != 0)
                            </div>
                            <footer class="foot">
                                <img src="{{ asset('/user_styles/images/bar2.png') }}">
                                <br><br>
                                <p>{{ $num_pages++ }}</p>
                            </footer>
                        </div>    
                    </div>
                @endif
                <div class='page'>
                    <div class='subpage'>
                        <header class="head"></header>
                        <div class='content'>
                @if ($num_pages == 0)
                    <h1 style="font-family: 'Economica', sans-serif; font-weight: bold; font-size: 30pt; margin: 0px; padding: 0px">{{ $patient->name }}</h1>
                    <?php $num_pages++; $num_lines = 25; ?>
                @else
                    <?php $num_lines = 27; ?>
                @endif
                <h2 style="font-family: 'Economica', sans-serif; font-size: 14pt; color: #666666;">Doctor: DR. {{ strtoupper($doctor_name) }}</h2>
                <h2 style="font-family: 'Economica', sans-serif; font-size: 14pt; color: #199ebc">{{ $doctor_email }}</h2>
                <img src="{{ asset('/user_styles/images/bar1.png') }}">
                <h1 style="font-family: 'Open Sans', sans-serif; font-weight: bold; font-size: 16pt;">{{ $date }}</h1>

                @if (count($prescriptions) > 0)
                    <h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold;">Prescriptions</h2>

                    @foreach($prescriptions as $prescription)
                        @if (strpos($prescription, '<h1>') !== false || strpos($prescription, '<h2>') !== false || strpos($prescription, '<h3>') !== false)
                            @if($num_lines >= 2)
                                {!! $prescription !!}
                                <?php $num_lines = $num_lines - 2 ?>
                            @else
                                        </div>
                                        <footer class="foot">
                                            <img src="{{ asset('/user_styles/images/bar2.png') }}">
                                            <br><br>
                                            <p>{{ $num_pages++ }}</p>
                                        </footer>
                                    </div>    
                                </div>
                                <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                                <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
                                {!! $prescription !!}
                                <?php $num_lines = 29; ?>
                            @endif
                        @else
                            @if($num_lines >= 1)
                                {!! $prescription !!}
                                <?php $num_lines--; ?>
                            @else
                                        </div>
                                        <footer class="foot">
                                            <img src="{{ asset('/user_styles/images/bar2.png') }}">
                                            <br><br>
                                            <p>{{ $num_pages++ }}</p>
                                        </footer>
                                    </div>    
                                </div>
                                <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                                <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
                                {!! $prescription !!}
                                <?php $num_lines = 30; ?>
                            @endif
                        @endif
                    @endforeach
                @endif

                @if ($images != null)
                    @if ($num_lines >= 2)
                        <h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold;">Photos</h2>
                    @else
                                </div>
                                <footer class="foot">
                                    <img src="{{ asset('/user_styles/images/bar2.png') }}">
                                    <br><br>
                                    <p>{{ $num_pages++ }}</p>
                                </footer>
                            </div>    
                        </div>
                        <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                        <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
                        <h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold;">Photos</h2>
                        <?php $num_lines = 29; ?>
                    @endif

                    @foreach($images as $image)
                        @if (($image->height + 25) > 907)
                                    </div>
                                    <footer class="foot">
                                        <img src="{{ asset('/user_styles/images/bar2.png') }}">
                                        <br><br>
                                        <p>{{ $num_pages++ }}</p>
                                    </footer>
                                </div>    
                            </div>
                            <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                            <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>

                            @if ($image->width >= 718)
                                <img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='height: {{$image->height}}px; width: 100%;' >
                            @else
                                <img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='height: {{$image->height}}px; width: {{$image->width}}px;' >
                            @endif

                            @if ($image->caption != "")
                                <p><strong>Figue {{ ++$num_figues . ": " . $image->caption }}</strong></p>
                            @else
                                <p><strong>Figue {{ ++$num_figues }}</strong></p>
                            @endif
                                    </div>
                                    <footer class="foot">
                                        <img src="{{ asset('/user_styles/images/bar2.png') }}">
                                        <br><br>
                                        <p>{{ $num_pages++ }}</p>
                                    </footer>
                                </div>    
                            </div>
                            <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                            <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
                            <?php $num_lines = 31; ?>
                        @elseif (($image->height + 25) > 24 * $num_lines)
                                    </div>
                                    <footer class="foot">
                                        <img src="{{ asset('/user_styles/images/bar2.png') }}">
                                        <br><br>
                                        <p>{{ $num_pages++ }}</p>
                                    </footer>
                                </div>    
                            </div>
                            <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                            <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>

                            @if ($image->width >= 718)
                                <img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='height: {{$image->height}}px; width: 100%;' >
                            @else
                                <img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='height: {{$image->height}}px; width: {{$image->width}}px;' >
                            @endif

                            @if ($image->caption != "")
                                <p><strong>Figue {{ ++$num_figues . ": " . $image->caption }}</strong></p>
                            @else
                                <p><strong>Figue {{ ++$num_figues }}</strong></p>
                            @endif

                            <?php $num_lines = 31 - ceil(($image->height + 25) / 24.0); ?>
                        @else
                            @if ($image->width >= 718)
                                <img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='height: {{$image->height}}px; width: 100%;' >
                            @else
                                <img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='height: {{$image->height}}px; width: {{$image->width}}px;' >
                            @endif

                            @if ($image->caption != "")
                                <p><strong>Figue {{ ++$num_figues . ": " . $image->caption }}</strong></p>
                            @else
                                <p><strong>Figue {{ ++$num_figues }}</strong></p>
                            @endif

                            <?php $num_lines = $num_lines - ceil(($image->height + 25) / 24.0) ?>
                        @endif
                    @endforeach
                @endif
                
                @if (count($comments) > 0)
                    @if ($num_lines >= 2)
                        <h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold;">Notes</h2>
                    @else
                                </div>
                                <footer class="foot">
                                    <img src="{{ asset('/user_styles/images/bar2.png') }}">
                                    <br><br>
                                    <p>{{ $num_pages }}</p>
                                </footer>
                            </div>    
                        </div>
                        <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                        <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
                        <h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold;">Notes</h2>
                        <?php $num_lines = 29; $num_pages++ ?>
                    @endif

                    @foreach($comments as $comment)
                        @if (strpos($comment, '<h1>') !== false || strpos($comment, '<h2>') !== false || strpos($comment, '<h3>') !== false)
                            @if($num_lines >= 2)
                                {!! $comment !!}
                                <?php $num_lines = $num_lines - 2; ?>
                            @else
                                        </div>
                                        <footer calss="foot">
                                            <img src="{{ asset('/user_styles/images/bar2.png') }}">
                                            <br><br>
                                            <p>{{ $num_pages++ }}</p>
                                        </footer>
                                    </div>    
                                </div>
                                <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                                <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
                                {!! $comment !!}
                                <?php $num_lines = 29; $num_pages++; ?>
                            @endif
                        @else
                            @if($num_lines >= 1)
                                {!! $comment !!}
                                <?php $num_lines--; ?>
                            @else
                                        </div>
                                        <footer calss="foot">
                                            <img src="{{ asset('/user_styles/images/bar2.png') }}">
                                            <br><br>
                                            <p>{{ $num_pages++ }}</p>
                                        </footer>
                                    </div>    
                                </div>
                                <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                                <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
                                {!! $comment !!}
                                <?php $num_lines = 30; $num_pages++; ?>
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach
                    </div>
                    <footer calss="foot">
                        <img src="{{ asset('/user_styles/images/bar2.png') }}">
                        <br><br>
                        <p>{{ $num_pages++ }}</p>
                    </footer>
                </div>    
            </div>
        </div>
    @else
        <div class="container">
            <img src="{{ asset('/admin_styles/images/file-icon.png') }}" style="position: fixed; left: 38%;" height = "500">
            <strong style="font-family: 'Economica', sans-serif; font-weight: bold; font-size: 40pt; color: #b9c0dc; position: fixed; top: 80%; left: 47%;">No File Created Yet</strong>
            <a class="ml-auto mr-auto " href="{{ route('admin.patient.addfile', $patient->id) }}">
            <div class="btn btn-success file-button" style=" top: 80%; left: 90%; padding-right:5px;">
                <i class="fa fa-plus" ></i> Create 
            </div>
            </a>
        </div>
    @endif
@endsection

@section('js')

@endsection