@extends('layouts.app')
@push('pg_btn')
    <a href="{{route('department.index')}}" class="btn btn-sm btn-neutral">All Departments</a>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    @can('update-department')
                    {!! Form::open(['route' => ['department.update', $department], 'method'=>'put']) !!}
                    @endcan
                    <h6 class="heading-small text-muted mb-4">department information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('name', 'Department Name', ['class' => 'form-control-label']) }}
                                        {{ Form::text('name', $department->name, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                            </div>

                        </div>


                        <hr class="my-4" />
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        {!! Form::hidden('status', 0) !!}
                                        <input type="checkbox" name="status" value="1" {{ $department->status ? 'checked' : ''}} class="custom-control-input" id="status">
                                        {{ Form::label('status', 'Status', ['class' => 'custom-control-label']) }}
                                    </div>
                                </div>
                                @can('update-user')
                                <div class="col-md-12">
                                    {{ Form::submit('Submit', ['class'=> 'mt-5 btn btn-primary']) }}
                                </div>
                                @endcan
                            </div>
                        </div>
                    @can('update-department')
                    {!! Form::close() !!}
                    @endcan
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
