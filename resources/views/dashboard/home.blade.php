@extends('dashboard.layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $submissionCount }}</h3>

                    <p>Total Pengajuan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-table"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $vehicleCount }}</h3>

                    <p>Total Kendaraan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-car"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Total Pengajuan Per bulanya</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script src="{{ asset('/') }}plugins/chart.js/Chart.min.js"></script>
    <script>
        $(function() {
            var areaChartData = {
                labels  : [@foreach ($charts as $chart) '{{ $chart->Month }}', @endforeach ],
                datasets: [
                    {
                        label               : 'Total Pengajuan',
                        backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [@foreach ($charts as $chart) '{{ $chart->count}}', @endforeach ],
                    },
                ]
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

        })
    </script>
@endpush
