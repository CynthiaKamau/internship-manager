@extends('layouts.app')
@push('pg_btn')
@can('create-checkins')
    <a href="{{ route('checkins.create') }}" class="btn btn-sm btn-neutral">Create New checkins</a>
@endcan
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">All Checkins</h3>
                        </div>
                        <div class="col-lg-4">
                    {!! Form::open(['route' => 'users.index', 'method'=>'get']) !!}
                        <div class="form-group mb-0">
                        {{ Form::text('search', request()->query('search'), ['class' => 'form-control form-control-sm', 'placeholder'=>'Search checkins']) }}
                    </div>
                    {!! Form::close() !!}
                </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <div>
                            <table class="table table-hover align-items-center">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Supervisor</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach($checkins as $checkin)
                                    <tr>
                                        <th scope="row">
                                            {{$checkin->user->first_name}} {{$checkin->user->last_name}}
                                        </th>
                                        <td>
                                        {{$checkin->lat}}
                                        <div id="latlng" value="54.9882,-1.5747"></div>
                                        <div id="test"></div>
                                        </td>
                                        <td>
                                            {{$checkin->supervisor->first_name}} {{$checkin->supervisor->last_name}}
                                        </td>
                                        <td>
                                            @if($checkin->approved_by == 1)
                                                <span class="badge badge-pill badge-lg badge-success">Approved</span>
                                            @else
                                                <span class="badge badge-pill badge-lg badge-danger">Not Approved</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{$checkin->created_at}}
                                        </td>
                                        <td class="text-center">
                                            @can('destroy-checkins')
                                            {!! Form::open(['route' => ['checkins.destroy', $checkin],'method' => 'delete',  'class'=>'d-inline-block dform']) !!}
                                            @endcan

                                            @can('update-checkins')
                                            <a class="btn btn-info btn-sm m-1" data-toggle="tooltip" data-placement="top" title="Edit checkins details" href="{{route('checkins.edit',$checkin ?? '')}}">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                            @endcan
                                            @can('destroy-checkins')
                                                <button type="submit" class="btn delete btn-danger btn-sm m-1" data-toggle="tooltip" data-placement="top" title="Delete checkins" href="">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot >
                                <tr>
                                    <td colspan="6">
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <script>
        jQuery(document).ready(function(){
            $('.delete').on('click', function(e){
                e.preventDefault();
                let that = jQuery(this);
                jQuery.confirm({
                    icon: 'fas fa-wind-warning',
                    closeIcon: true,
                    title: 'Are you sure!',
                    content: 'You can not undo this action.!',
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                        confirm: function () {
                            that.parent('form').submit();
                            //$.alert('Confirmed!');
                        },
                        cancel: function () {
                            //$.alert('Canceled!');
                        }
                    }
                });
            })
        })

        var geocoder;
        initialize();
        codeLatLng();
        function initialize() {

            geocoder = new google.maps.Geocoder();
        }

        function codeLatLng() {

            var input = document.getElementById("latlng").getAttribute('value');
            console.log(input);
            var latlngStr = input.split(",", 2);
            var lat = parseFloat(latlngStr[0]);
            var lng = parseFloat(latlngStr[1]);
            var latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({
            'latLng': latlng
            }, function(results, status) {

                document.getElementById("test").innerHTML = '' + (results[4].formatted_address); + ''
            });
        }
        
    </script>    ​
@endpush
