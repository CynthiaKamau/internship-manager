@extends('layouts.app')
@push('pg_btn')
    <a href="{{route('internships.index')}}" class="btn btn-sm btn-neutral">All Facility Internships</a>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    @can('update-internships')
                    {!! Form::open(['route' => ['internships.update', $internship], 'method'=>'put']) !!}
                    @endcan
                    <h6 class="heading-small text-muted mb-4">Internship Information</h6>
                       
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('title', 'Title', ['class' => 'form-control-label']) }}
                                        {{ Form::text('title', $internship->title, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('qualifications', 'Qualifications', ['class' => 'form-control-label']) }}
                                        {{ Form::textarea('qualifications', $internship->qualifications, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('responsibilities', 'Responsibilities', ['class' => 'form-control-label']) }}
                                        {{ Form::textarea('responsibilities', $internship->responsibilities, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('duration', 'Duration', ['class' => 'form-control-label']) }}
                                        {{ Form::text('duration', $internship->duration, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Select Facility</label>
                                        <select class="form-control" data-width="100%" id="facility_id" name="facility_id" data-actions-box="true" data-live-search="true">
                                            @foreach($facilities as $facility)
                                                <option value="{{ $facility->id}}" {{ $facility->id == $internship->facility_id ? 'selected' : ''}} > {{$facility->name}}</option>
                                            @endforeach
                                        </select>    
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">                                
                                        <label>Application Valid Till :</label>
                                        <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control" name="validity" id="validity" value="{{$internship->validity}}" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="status" value="1" {{ $internship->status ? 'checked' : ''}}   class="custom-control-input" id="status">
                                        {{ Form::label('status', 'Status', ['class' => 'custom-control-label']) }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    {{ Form::submit('Submit', ['class'=> 'mt-5 btn btn-primary']) }}
                                </div>
                            </div>
                        </div>
                    @can('update-internships')
                    {!! Form::close() !!}
                    @endcan
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<script>

$('.datepicker').datepicker({
    startView: 2,
    minDate: new Date()
});

</script>

@endpush


