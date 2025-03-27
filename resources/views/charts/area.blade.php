@extends('layouts.vertical', ['title' => 'Apex Area Chart'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Apex', 'title' => 'Apex Area Chart'])

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Basic Area Chart</h4>
                    <div dir="ltr">
                        <div id="basic-area" class="apex-charts" data-colors="#fa6767"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Spline Area</h4>
                    <div dir="ltr">
                        <div id="spline-area" class="apex-charts" data-colors="#727cf5,#6c757d"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Area Chart - Datetime X-axis</h4>
                    <div class="toolbar apex-toolbar">
                        <button id="one_month" class="btn btn-sm btn-light">1M</button>
                        <button id="six_months" class="btn btn-sm btn-light">6M</button>
                        <button id="one_year" class="btn btn-sm btn-light active">1Y</button>
                        <button id="ytd" class="btn btn-sm btn-light">YTD</button>
                        <button id="all" class="btn btn-sm btn-light">ALL</button>
                    </div>
                    <div dir="ltr">
                        <div id="area-chart-datetime" class="apex-charts" data-colors="#6c757d"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Area with Negative Values</h4>
                    <div dir="ltr">
                        <div id="area-chart-negative" class="apex-charts" data-colors="#0acf97,#ffbc00"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Selection - Github Style</h4>
                    <div dir="ltr">
                        <div id="area-chart-github" class="apex-charts" data-colors="#7BD39A"></div>
                        <div class="pt-2 pb-2">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img src="/images/users/avatar-2.jpg" class="avatar-xs rounded" alt="file-image">
                                </div>
                                <div class="col ps-0">
                                    <a href="javascript:void(0);" class="text-muted fw-bold">Coderthemes</a>
                                </div>
                            </div>
                        </div>
                        <div id="area-chart-github2" class="apex-charts" data-colors="#FF7F00"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Stacked Area</h4>
                    <div dir="ltr">
                        <div id="stacked-area" class="apex-charts" data-colors="#727cf5,#0acf97,#e3eaef"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Irregular TimeSeries</h4>
                    <div dir="ltr">
                        <div id="area-timeSeries" class="apex-charts" data-colors="#39afd1,#fa5c7c,#727cf5"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Water Meter Readings</h4>
                    <div dir="ltr">
                    var options = {
          series: [{
          name: 'Water Meter Reading',
          data: [{
              x: 'Dec 23 2017',
              y: null
            },
            {
              x: 'Dec 24 2017',
              y: 44
            },
            {
              x: 'Dec 25 2017',
              y: 31
            },
            {
              x: 'Dec 26 2017',
              y: 38
            },
            {
              x: 'Dec 27 2017',
              y: null
            },
            {
              x: 'Dec 28 2017',
              y: 32
            },
            {
              x: 'Dec 29 2017',
              y: 55
            },
            {
              x: 'Dec 30 2017',
              y: 51
            },
            {
              x: 'Dec 31 2017',
              y: 67
            },
            {
              x: 'Jan 01 2018',
              y: 22
            },
            {
              x: 'Jan 02 2018',
              y: 34
            },
            {
              x: 'Jan 03 2018',
              y: null
            },
            {
              x: 'Jan 04 2018',
              y: null
            },
            {
              x: 'Jan 05 2018',
              y: 11
            },
            {
              x: 'Jan 06 2018',
              y: 4
            },
            {
              x: 'Jan 07 2018',
              y: 15,
            },
            {
              x: 'Jan 08 2018',
              y: null
            },
            {
              x: 'Jan 09 2018',
              y: 9
            },
            {
              x: 'Jan 10 2018',
              y: 34
            },
            {
              x: 'Jan 11 2018',
              y: null
            },
            {
              x: 'Jan 12 2018',
              y: null
            },
            {
              x: 'Jan 13 2018',
              y: 13
            },
            {
              x: 'Jan 14 2018',
              y: null
            }
          ],
        }],
          chart: {
          type: 'area',
          height: 350,
          animations: {
            enabled: false
          },
          zoom: {
            enabled: false
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        fill: {
          opacity: 0.8,
          type: 'pattern',
          pattern: {
            style: ['verticalLines', 'horizontalLines'],
            width: 5,
            height: 6
          },
        },
        markers: {
          size: 5,
          hover: {
            size: 9
          }
        },
        title: {
          text: 'Water Balance Readings',
        },
        tooltip: {
          intersect: true,
          shared: false
        },
        theme: {
          palette: 'palette1'
        },
        xaxis: {
          type: 'datetime',
        },
        yaxis: {
          title: {
            text: 'Bytes Received'
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

@endsection

@section('scripts')
<script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
    <script src="https://apexcharts.com/samples/assets/series1000.js"></script>
    <script src="https://apexcharts.com/samples/assets/github-data.js"></script>
    <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
    @vite(['resources/js/pages/chart-apex-area.js'])
@endsection
