@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Users</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $everyone }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $new_users}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Practitioners</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $practitioners }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Students</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $students }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-chart-bar-32"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ============= --}}


        <div class="row">
          <div class="col-xl-8">
            <div class="card">
              <div class="card-header border-0">
                <div class="row align-items-center">
                  <div class="col">
                    <h3 class="mb-0">Page visits</h3>
                  </div>
                  <div class="col text-right">
                    <a href="#!" class="btn btn-sm btn-primary">See all</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Page name</th>
                      <th scope="col">Visitors</th>
                      <th scope="col">Unique users</th>
                      <th scope="col">Bounce rate</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">
                        /dashboard/
                      </th>
                      <td>
                        4,569
                      </td>
                      <td>
                        340
                      </td>
                      <td>
                        <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">
                        /dashboard/index.html
                      </th>
                      <td>
                        3,985
                      </td>
                      <td>
                        319
                      </td>
                      <td>
                        <i class="fas fa-arrow-down text-warning mr-3"></i> 46,53%
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">
                        /dashboard/charts.html
                      </th>
                      <td>
                        3,513
                      </td>
                      <td>
                        294
                      </td>
                      <td>
                        <i class="fas fa-arrow-down text-warning mr-3"></i> 36,49%
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">
                        /dashboard/tables.html
                      </th>
                      <td>
                        2,050
                      </td>
                      <td>
                        147
                      </td>
                      <td>
                        <i class="fas fa-arrow-up text-success mr-3"></i> 50,87%
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">
                        /dashboard/profile.html
                      </th>
                      <td>
                        1,795
                      </td>
                      <td>
                        190
                      </td>
                      <td>
                        <i class="fas fa-arrow-down text-danger mr-3"></i> 46,53%
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


          <div class="col-xl-4">
            <div class="card">
              <div class="card-header border-0">
                <div class="row align-items-center">
                  <div class="col">
                    <h3 class="mb-0">User Roles</h3>
                  </div>
                  <div class="col text-right">
                    <a href="#!" class="btn btn-sm btn-primary">See all</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <div id="chart"> </div>
              </div>
            </div>
          </div>
        </div>

@endsection
@push('scripts')

  <script src="https://code.highcharts.com/maps/highmaps.js"></script>
  <script src="https://code.highcharts.com/maps/modules/data.js"></script>
  <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/maps/modules/offline-exporting.js"></script>
  <script src="https://code.highcharts.com/modules/bullet.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>

  <script type="text/javascript">

    var data = <?php echo json_encode($users) ?>

    console.log(data);

    Highcharts.chart('chart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Users Per Role'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: true,
              format: '<b>{point.name}</b>: {point.percentage:.1f} %',
              connectorColor: 'silver'
          }
        }
    },
    series: [{
            name: 'AYA Users',
            data: data
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });

  </script>

@endpush
