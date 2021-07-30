@extends('layouts.app')
@push('pg_btn')
    <a href="{{route('students.index')}}" class="btn btn-sm btn-neutral">All Students</a>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    @can('update-students')
                    {!! Form::open(['route' => ['students.update', $student], 'method'=>'put']) !!}
                    @endcan
                    <h6 class="heading-small text-muted mb-4">Student Information</h6>
                       
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label> <strong> Student Name : </strong> </label>
                                        <label> {{$student->student->first_name}} {{$student->student->last_name}}  </label>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label> <strong> Facility : </strong> </label>
                                        <label> {{$student->student->profile->facility->name}} </label>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label> <strong> Department : </strong> </label>
                                        <label> {{$student->student->profile->department->name}} </label>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Select Supervisor</label>
                                        <select class="selectpicker form-control" data-width="100%" id="supervisor_id" name="supervisor_id" data-actions-box="true">
                                            @foreach($users as $user)
                                                <option value="{{ $user->id}}" {{ $user->id == $student->supervisor_id ? 'selected' : ''}} > {{$user->first_name}} {{$user->last_name}}</option>
                                            @endforeach
                                        </select>    
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                @can('update-students')
                                <div class="col-md-12">
                                    {{ Form::submit('Submit', ['class'=> 'mt-5 btn btn-primary']) }}
                                </div>
                                @endcan
                            </div>
                        </div>
                    @can('update-students')
                    {!! Form::close() !!}
                    @endcan
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
