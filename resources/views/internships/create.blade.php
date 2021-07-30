@extends('layouts.app')
@push('pg_btn')
    <a href="{{route('internships.index')}}" class="btn btn-sm btn-neutral">All Facility Internships</a>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    {!! Form::open(['route' => 'internships.store']) !!}
                    <h6 class="heading-small text-muted mb-4">Internship Information</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('title', 'Title', ['class' => 'form-control-label']) }}
                                        {{ Form::text('title', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('qualifications', 'Qualifications', ['class' => 'form-control-label']) }}
                                        {{ Form::text('qualifications', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('responsibilities', 'Responsibilities', ['class' => 'form-control-label']) }}
                                        {{ Form::text('responsibilities', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('duration', 'Duration', ['class' => 'form-control-label']) }}
                                        {{ Form::text('duration', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Select Facility</label>
                                        <select class="selectpicker form-control" data-width="100%" id="facility_id" name="facility_id" data-actions-box="true" data-live-search="true">
                                            @foreach($facilities as $facility)
                                                <option value="{{ $facility->id}}" > {{$facility->name}}</option>
                                            @endforeach
                                        </select>    
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="status" value="1" class="custom-control-input" id="status">
                                        {{ Form::label('status', 'Status', ['class' => 'custom-control-label']) }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    {{ Form::submit('Submit', ['class'=> 'mt-5 btn btn-primary']) }}
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
