@extends('layouts.app')

@section('content')   

    <div class="row">
        <div class="col-md-12">
            <form role="form" method="post" action="#" id="dataFilter">
                {{ csrf_field() }}
                <div class="card d-flex flex-row mb-5">

                    <div class="col-xl-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label class="col-form-label"><b>Select County</b></label>
                            <select class="selectpicker form-control" data-width="100%" id="county" name="county[]" data-live-search="true" multiple>
                                @if(Auth::user()->role_id != '1')
                                    <option selected value="{{Auth::user()->profile->facility->subcounty->county->id}}" > {{ ucwords(Auth::user()->profile->facility->subcounty->county->name) }}</option>
                                @else
                                    @foreach($counties as $county)
                                        <option value="{{ $county->id}}" > {{$county->name}}</option>
                                    @endforeach
                                @endif

                            </select>    
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label class="col-form-label"><b>Select Sub County</b></label>
                            <select class="form-control selectpicker" data-width="100%" id="sub_county" name="sub_county[]"  data-live-search="true" multiple>
                                @if(Auth::user()->role_id != '1')
                                    <option selected value="{{Auth::user()->profile->facility->subcounty->id}}" > {{ ucwords(Auth::user()->profile->facility->subcounty->name) }}</option>
                                @endif
                            </select>    
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label class="col-form-label"><b>Select Facility</b></label>
                            <select class="selectpicker form-control" data-width="100%" id="facility" name="facility" data-live-search="true" multiple>
                                @if(Auth::user()->role_id != '1')
                                    <option selected value="{{Auth::user()->profile->facility->id}}" > {{ ucwords(Auth::user()->profile->facility->name) }}</option>
                                @endif
                            </select>    
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-2 col-sm-2">
                        <div class="form-group">
                            <label for="daterange" class="col-form-label"><b>Select Date Range</b></label>
                            <input class="form-control" id="daterange" type="text" name="daterange" />
                        </div>
                    </div>

                    <div class="col-xl-1 col-md-1 col-sm-1">

                        <div class="form-group">
                            <label for="daterange" class="col-form-label "></label>
                            <button type="submit" class="btn btn-warning"><b>Filter Results </b></button>
                        </div>
                    </div> 
                </div>    

            </form>      

            </div>    
        </div>
    </div> 

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Users</h5>
                            <span class="h2 font-weight-bold mb-0" id="everyone"></span>
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
                            <span class="h2 font-weight-bold mb-0" id="new_users"></span>
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
                            <span class="h2 font-weight-bold mb-0" id="practitioners"></span>
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
                            <span class="h2 font-weight-bold mb-0" id="students"></span>
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
                <h3 class="mb-0">Users</h3>
                </div>
                <div class="col text-right">
                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                </div>
            </div>
            </div>
            <div class="table-responsive">
            <!-- Projects table -->
            <div id="container"> </div>
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

    <div class="row">
        <div class="col" id="map"></div>
        <div class="col" id="countyBreakdown">

        </div>
    </div>

    {{-- ============= --}}

    <div id="dashboard_overlay">
        <img style="  position:absolute;
        background-size: cover;
        width: 100%;
        length: 100%;
        top:0;
        left:0;
        right:0;
        bottom:0;
        margin:auto;" src="{{url('/assets/img/brand/loader.gif')}}" alt="loader" />

    </div>

@endsection
@push('scripts')

  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


  <script src="https://code.highcharts.com/maps/highmaps.js"></script>
  <script src="https://code.highcharts.com/maps/modules/data.js"></script>
  <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/maps/modules/offline-exporting.js"></script>
  <script src="https://code.highcharts.com/modules/bullet.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>

  <script type="text/javascript">

    function charts(data, data1) {


        var cat = [];

        data1.forEach(function(item) {

          cat.push(item.monthyear);

        });

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

        Highcharts.chart('container', {
            chart: {
              type: 'column'
            },
            title: {
                text: 'New User Growth, 2021'
            },
            subtitle: {
                text: 'User Monthly Registration Series '
            },
            xAxis: {
                categories: cat
            },
            yAxis: {
                title: {
                    text: 'Number of New Users'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'New Users',
                data: data1
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

    }

    $(function() {
        $('#daterange').daterangepicker({
            "minYear": 2021,
            "autoApply": true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            },
            "startDate": "01/07/2021",
            "endDate": moment().format('MM/DD/YYYY'),
            "opens": "left"
        }, function(start, end, label) {});
    });

    $('#county').change(function () {

        $('#sub_county').empty();

        var s = $(this).val();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '/sub_counties',
            data: {
                "county_id" : s
            },
            dataType: "json",
            success: function (data) {
                var select = document.getElementById("sub_county"),
                    opt = document.createElement("option");

                    opt.value = "";
                    opt.textContent = "Select Sub County";
                    select.appendChild(opt);
                for (var i = 0; i < data.length; i++) {
                    
                var select = document.getElementById("sub_county"),
                    opt = document.createElement("option");

                    opt.value = data[i].id;
                    opt.textContent = data[i].name;
                    select.appendChild(opt);
                }

            }

        })

    })

    $('#sub_county').change(function () {

        $('facility').empty();

        var f = $(this).val();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '/facilities',
            data: {
                "sub_county": f
            },
            dataType: "json",
            success: function (data) {

                var select = document.getElementById("facility"),
                        opt = document.createElement("option");

                    opt.value = "";
                    opt.textContent = "Select Facility";
                    select.appendChild(opt);

                for (var i = 0; i < data.length; i++) {
                    var select = document.getElementById("facility"),
                        opt = document.createElement("option");

                    opt.value = data[i].id;
                    opt.textContent = data[i].name;
                    select.appendChild(opt);
                }
            }

        })
    })

    $.ajax({
        type: 'GET',
        url: "{{ route('data') }}",
        success: function(data) {
            charts(data.users, data.g_users);
            maps(data.county_numbers);
            countyBreakdown(data.county_breakdown);
            // $('#county').empty();
            // $('#sub_county').empty();
            // $.each(data.counties, function(number, county) {
            //     $("#counties").append($('<option>').text(county.name).attr('value',
            //         county.id));
            // });
            // // $.each(data.counties, function(number, county) {
            // //     $("#counties").append($('<option>').text(county.name).attr('value',
            // //         county.id));
            // // });
            // $("#county").selectpicker('refresh');
            // $("#sub_county").selectpicker('refresh');
            $("#everyone").html(data.everyone);
            $("#students").html(data.students);
            $("#practitioners").html(data.practitioners);
            $("#new_users").html(data.new_users);
            $("#dashboard_overlay").hide();

        }
    });

    $('#dataFilter').on('submit', function(e) {
        e.preventDefault();
        $("#dashboard_overlay").show();
        let county = $('#county').val();
        let sub_county = $('#sub_county').val();
        let facility = $('#facility').val();
        let daterange = $('#daterange').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: 'POST',
                data: {
                    "county": county,
                    "sub_county": sub_county,
                    "facility": facility,
                    "daterange": daterange
                },
                url: "{{ route('filtered_data') }}",
                success: function(data) {
                    charts(data.users, data.g_users);
                    maps(data.county_numbers);
                    countyBreakdown(data.pulled_data);
                    // $('#county').empty();
                    // $('#sub_county').empty();
                    // $.each(data.all_units, function(number, unit) {
                    //     $("#units").append($('<option>').text(unit.name).attr(
                    //         'value',
                    //         unit.id));
                    // });
                    // $.each(data.counties, function(number, county) {
                    //     $("#counties").append($('<option>').text(county.name).attr('value',
                    //         county.id));
                    // });
                    // $("#county").selectpicker('refresh');
                    // $("#sub_county").selectpicker('refresh');
                    $("#everyone").html(data.everyone);
                    $("#students").html(data.students);
                    $("#practitioners").html(data.practitioners);
                    $("#new_users").html(data.new_users);
                    $("#dashboard_overlay").hide();
                }
            });
    });

    //Maps Chart
    async function maps(data) {
        let geojson = await fetchJSON('kenyan-counties.geojson');
        // Initiate the chart
        Highcharts.mapChart('map', {
            chart: {
                map: geojson,
                height: 600
            },
            title: {
                text: 'Users by County'
            },
            legend: {
                layout: 'horizontal',
                borderWidth: 0,
                backgroundColor: 'rgba(255,255,255,0.85)',
                floating: true,
                verticalAlign: 'top',
                y: 25
            },
            exporting: {
                sourceWidth: 600,
                sourceHeight: 500
            },
            mapNavigation: {
                enabled: true
            },
            colorAxis: {
                min: 1,
                type: 'logarithmic',
                minColor: '#EEEEFF',
                maxColor: '#000022',
                stops: [
                    [0, '#EFEFFF'],
                    [0.67, '#4444FF'],
                    [1, '#000022']
                ]
            },
            series: [{
                data: data,
                keys: ['facilities', 'results'],
                joinBy: 'county_id',
                name: 'Users by County',
                states: {
                    hover: {
                        color: '#004D1A'
                    }
                },
                dataLabels: {
                    enabled: false,
                    format: '{point.properties.COUNTY}'
                },
                tooltip: {
                    pointFormat: 'County: {point.properties.COUNTY}<br> Users: {point.users} <br> Facilities: {point.facilities}'
                }
            }]
        });
    }

    function countyBreakdown(data) {
        let counties = [];
        let all_users = [];
        let roles = [];
        for (let i = 0; i < data.length; i++) {
            counties.push(data[i].name);
            all_users.push(data[i].all_users);
            roles.push(data[i].roles);
        }
        Highcharts.chart('countyBreakdown', {
            chart: {
                type: 'bar',
                height: 600
            },
            title: {
                text: 'Users by County'
            },
            xAxis: {
                categories: counties,
                crosshair: true
            },
            yAxis: [{
                title: {
                    text: 'Users'
                },
            }],
            legend: {
                shadow: false
            },
            tooltip: {
                shared: true
            },
            plotOptions: {
                column: {
                    grouping: false,
                    shadow: false,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'All Users',
                color: 'rgba(248,161,63,1)',
                data: all_users,
                pointPadding: 0.3,
                pointPlacement: 0.2
            }, {
                name: 'Users By Role',
                color: 'rgba(186,60,61,.9)',
                data: roles,
                pointPadding: 0.4,
                pointPlacement: 0.2
            }]
        });
    }

    function fetchJSON(url) {
        return fetch(url)
            .then(function(response) {
                return response.json();
            });
    }

  </script>

@endpush
