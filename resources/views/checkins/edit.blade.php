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
                                <div class="col-sm-3">
                                    Student
                                </div>
                                <div class="col-sm-8">
                                    <label>{{ $checkin->user->first_name }} {{ $checkin->user->last_name }} </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    Supervisor
                                </div>
                                <div class="col-sm-8">
                                    <label> @if(!empty($checkin->supervisor )) {{ $checkin->supervisor->first_name }} {{ $checkin->supervisor->last_name }} @else None @endif </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    Email
                                </div>
                                <div class="col-sm-8">
                                    <label>{{ $checkin->user->email }}</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    Facility
                                </div>
                                <div class="col-sm-8">
                                    <label>{{ $checkin->user->profile->facility->name }}</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    Department
                                </div>
                                <div class="col-sm-8">
                                    <label>@if(!empty($checkin->user->profile->department)) {{$checkin->user->profile->department->name}} @else None @endif </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    Checkin Location
                                </div>
                                <div class="col-sm-8">
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
                                        <input type="checkbox" name="approved" id="approved" value="1" {{ $checkin->approved ? 'checked' : ''}} class="custom-control-input">
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
