@extends('admin.layouts.layout')

@section('title') Statistics @endsection

@section('css')
	{{-- here goes the css of page --}}
@endsection

@section('body')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Number Of Patients By Joining Date</h3>
        </div>

        <div class="box-body">
            <div class="chart">
                <canvas id="areaChart" style="height:400px"></canvas>
            </div>
        </div>
    </div>

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Number Of Workers In Every Position</h3>
        </div>

        <div class="box-body">
            <canvas id="pieChart" style="height:400px"></canvas>
        </div>
    </div>

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Clinics Statistics</h3>
        </div>

        <div class="box-body">
            <div class="chart">
                <canvas id="barChart" style="height:600px"></canvas>
            </div>
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Material Statistics</h3>
        </div>

        <div class="box-body">
            <div class="chart">
                <canvas id="lineChart" style="height:400px"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('js')
	<script src="{{ asset('admin_styles/js/Chart.min.js') }}"></script>

    <script>
    $(function () {
            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var areaChart = new Chart(areaChartCanvas);
            var areaChartData = {
                labels: [
                    @for ($i = 0; $i < count($patients); $i++)
                        @if ($i != count($patients) - 1)
                            {!! "'" . date('M d, Y', strtotime($patients[$i]->created_at)) . "', " !!}
                        @else
                            {!! "'" . date('M d, Y', strtotime($patients[$i]->created_at)) . "'" !!}
                        @endif
                    @endfor
                ],
                datasets: [
                    {
                        label: "Number Of Patients",
                        fillColor: "rgba(210, 214, 222, 1)",
                        strokeColor: "rgba(210, 214, 222, 1)",
                        pointColor: "rgba(210, 214, 222, 1)",
                        pointStrokeColor: "#c1c7d1",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [
                            @for ($i = 0; $i < count($patients); $i++)
                                @if ($i != count($patients) - 1)
                                    {!! "'" . $patients[$i]->total . "', " !!}
                                @else
                                    {!! "'" . $patients[$i]->total . "'" !!}
                                @endif
                            @endfor
                        ]
                    }
                ]
            };
            var areaChartOptions = {
                //Boolean - If we should show the scale at all
                showScale: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: false,
                //String - Colour of the grid lines
                scaleGridLineColor: "rgba(0,0,0,.05)",
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - Whether the line is curved between points
                bezierCurve: true,
                //Number - Tension of the bezier curve between points
                bezierCurveTension: 0.3,
                //Boolean - Whether to show a dot for each point
                pointDot: false,
                //Number - Radius of each point dot in pixels
                pointDotRadius: 4,
                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth: 1,
                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius: 20,
                //Boolean - Whether to show a stroke for datasets
                datasetStroke: true,
                //Number - Pixel width of dataset stroke
                datasetStrokeWidth: 2,
                //Boolean - Whether to fill the dataset with a color
                datasetFill: true,
                //String - A legend template
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: true,
                //Boolean - whether to make the chart responsive to window resizing
                responsive: true
            };
            //Create the line chart
            areaChart.Line(areaChartData, areaChartOptions);
            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas);
            var PieData = [
                {
                    value: {!! $nurses->count() !!},
                    color: {!! "'#" . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . "'" !!},
                    highlight: {!! "'#" . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . "'" !!},
                    label: 'nurses',
                },
                @for ($i = 0; $i < count($workers); $i++)
                    {
                    value: {!! $workers[$i]->total !!},
                    color: {!! "'#" . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . "'" !!},
                    highlight: {!! "'#" . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . "'" !!},
                    label: {!! "'" . $workers[$i]->position . "'" !!}
                    @if ($i != count($workers) - 1)
                        },
                    @else
                        }
                    @endif
                @endfor
            ];
            var pieOptions = {
                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke: true,
                //String - The colour of each segment stroke
                segmentStrokeColor: "#fff",
                //Number - The width of each segment stroke
                segmentStrokeWidth: 2,
                //Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout: 50, // This is 0 for Pie charts
                //Number - Amount of animation steps
                animationSteps: 100,
                //String - Animation easing effect
                animationEasing: "easeOutBounce",
                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate: true,
                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale: false,
                //Boolean - whether to make the chart responsive to window resizing
                responsive: true,
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: true,
                //String - A legend template
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions);
            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var barChartData = {
                labels: [
                    @foreach ($clinics as $clinic)
                        '{{ $clinic->name }}',
                    @endforeach
                ],
                datasets: [
                    {
                        label: "Reservations",
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: [
                            @foreach ($clinics as $clinic)
                                '{{ $clinic->reservations() }}',
                            @endforeach
                        ]
                    },
                    {
                        label: "Workers",
                        fillColor: "rgba(210, 214, 222, 1)",
                        strokeColor: "rgba(210, 214, 222, 1)",
                        pointColor: "rgba(210, 214, 222, 1)",
                        pointStrokeColor: "#c1c7d1",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [
                            @foreach ($clinics as $clinic)
                                '{{ $clinic->workers() }}',
                            @endforeach
                        ]
                    },
                    {
                        label: "nurses",
                        fillColor: "yellow",
                        strokeColor: "yellow",
                        pointColor: "yellow",
                        pointStrokeColor: "#e6e600",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#cccc00",
                        data: [
                            @foreach ($clinics as $clinic)
                                '{{ $clinic->nurses() }}',
                            @endforeach
                        ]
                    },
                    {
                        label: "materials",
                        fillColor: "red",
                        strokeColor: "red",
                        pointColor: "red",
                        pointStrokeColor: "#ff4d4d",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#cc0000",
                        data: [
                            @foreach ($clinics as $clinic)
                                '{{ $clinic->materials() }}',
                            @endforeach
                        ]
                    }  
                ]
            };
            barChartData.datasets[1].fillColor = "#00a65a";
            barChartData.datasets[1].strokeColor = "#00a65a";
            barChartData.datasets[1].pointColor = "#00a65a";
            var barChartOptions = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - If there is a stroke on each bar
            barShowStroke: true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth: 2,
            //Number - Spacing between each of the X value sets
            barValueSpacing: 5,
            //Number - Spacing between data sets within X values
            barDatasetSpacing: 1,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to make the chart responsive
            responsive: true,
            maintainAspectRatio: true
            };
            barChartOptions.datasetFill = false;
            barChart.Bar(barChartData, barChartOptions);
            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas);
            var lineChartOptions = areaChartOptions;
            var lineChartData = {
                labels: [
                    @foreach ($categories as $category)
                        '{{ $category->name }}',
                    @endforeach
                ],
                datasets: [
                    {
                        label: "Materials",
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: [
                            @foreach ($categories as $category)
                                '{{ $category->materials() }}',
                            @endforeach
                        ]
                    }
                ]
            };
            lineChartOptions.datasetFill = false;
            lineChart.Line(lineChartData, lineChartOptions);
        });
    </script>
@endsection