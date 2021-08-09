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
                                        {{ Form::label('validity', 'Applications Open Till', ['class' => 'form-control-label']) }}
                                        <input type="text" value="$internship->validity" class="form-control" id="datetimepicker" name="validity">
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

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>

<script>

$('#datetimepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d',
    minDate: moment()
});

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

@endpush


