@extends('layouts.app')
@push('pg_btn')
    <a href="{{route('checkins.index')}}" class="btn btn-sm btn-neutral">All Checkins</a>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">checkins information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-sm-1">
                                    Student
                                </div>
                                <div class="col-sm-3">
                                    <label>{{ $checkin->user->first_name }} {{ $checkin->user->last_name }} </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-1">
                                    Supervisor
                                </div>
                                <div class="col-sm-3">
                                    <label>{{ $checkin->supervisor->first_name }} {{ $checkin->supervisor->last_name }}</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-1">
                                    Email
                                </div>
                                <div class="col-sm-3">
                                    <label>{{ $checkin->user->email }}</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-1">
                                    Facility
                                </div>
                                <div class="col-sm-3">
                                    <label>{{ $checkin->user->profile->facility->name }}</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-1">
                                    Department
                                </div>
                                <div class="col-sm-3">
                                    <label>{{ $checkin->user->profile->department }}</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-1">
                                    Checkin Location
                                </div>
                                <div class="col-sm-3">
                                    <label>{{ $checkin->lat}}</label>
                                </div>
                            </div>

                        </div>


                        @can('update-checkins')
                        {!! Form::open(['route' => ['checkins.update', $checkin], 'method'=>'put']) !!}

                        <hr class="my-4" />
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        {!! Form::hidden('approved', 0) !!}
                                        <input type="checkbox" name="approved" value="1" {{ $checkin->approved ? 'checked' : ''}} class="custom-control-input" id="approved">
                                        {{ Form::label('approved', 'Approve', ['class' => 'custom-control-label']) }}
                                    </div>
                                </div>
                                @can('update-checkins')
                                <div class="col-md-12">
                                    {{ Form::submit('Submit', ['class'=> 'mt-5 btn btn-primary']) }}
                                </div>
                                @endcan
                            </div>
                        </div>

                        @endcan

                    @can('update-checkins')
                    {!! Form::close() !!}
                    @endcan
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
