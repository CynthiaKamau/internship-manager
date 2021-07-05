@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    {!! Form::open(['route' => ['users.update', $user], 'method' => 'put','files' => true]) !!}
                    <h6 class="heading-small text-muted mb-4">Profile</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('first_name', 'First Name', ['class' => 'form-control-label']) }}
                                        {{ Form::text('first_name', $user->first_name, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('middle_name', 'Middle Name', ['class' => 'form-control-label']) }}
                                        {{ Form::text('middle_name', $user->middle_name, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('last_name', 'Last Name', ['class' => 'form-control-label']) }}
                                        {{ Form::text('last_name', $user->last_name, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('email', 'E-mail', ['class' => 'form-control-label']) }}
                                        {{ Form::email('email', $user->email, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('msisdn', 'Phone number', ['class' => 'form-control-label']) }}
                                        {{ Form::text('msisdn', $user->msisdn, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('nckid', 'NCK Number', ['class' => 'form-control-label']) }}
                                        {{ Form::text('nckid', $user->nckid, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>   

                            <div class="row">
                                <div class="col-md-6">
                                    <label> Select Role </label>
                                    <select class="selectpicker form-control" id="role_id" name="role_id" aria-label="Default select example">
                                        <option value="2">Practitioner</option>
                                        <option value="3">Student</option>
                                    </select>

                                    @error('role_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>  
                            </div>

                        <div>

                        <hr class="my-4" />
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    {{ Form::submit('Submit', ['class'=> 'mt-5 btn btn-primary lg']) }}
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}

                    {!! Form::open(['route' => ['profile.update', $user], 'files' => true]) !!}

                        <hr class="my-4" />
                        <!-- Address -->
                        <h6 class="heading-small text-muted mb-4">Personal information</h6>                    
                        <div class="pl-lg-4">

                            <div class="row">
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('index_number', 'Index Number', ['class' => 'form-control-label']) }}
                                        {{ Form::text('index_number', $user->profile->index_number , ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('profile_photo', 'Photo', ['class' => 'form-control-label d-block']) }}
                                        <div class="d-inline">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                  <a id="uploadFile" data-input="thumbnail" data-preview="holder" class="btn btn-secondary">
                                                    <i class="fa fa-picture-o"></i> Choose Logo
                                                  </a>
                                                </span>
                                                <input id="thumbnail" class="form-control d-none" type="text" name="profile_photo">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    @if ($user->profile_photo)
                                        <a href="{{ asset($user->profile_photo) }}" target="_blank">
                                            <img alt="Image placeholder"
                                            class="avatar avatar-xl  rounded-circle"
                                            data-toggle="tooltip" data-original-title="{{ $user->name }} Logo"
                                            src="{{ asset($user->profile_photo) }}">
                                        </a>
                                    @endif
                                </div> 

                            </div>    

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">                                
                                        <label>Select Date Of Birth</label>
                                        <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control" name="dob" id="dob" placeholder="Date Of Birth" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>

                                            @error('dob')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>    
                                    </div>
                                </div>    

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Gender</label>
                                        <select class="selectpicker form-control" aria-label="Default select example" id="gender" name="gender">
                                            <option value="MALE">Male</option>
                                            <option value="FEMALE">Female</option>
                                            <option value="TRANS-GENDER">Trans-Gender</option>
                                            <option value="OTHER">Other</option>
                                        </select>                                    
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div> 

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Citizenship</label>
                                        <select class="selectpicker form-control" width="100%" aria-label="Default select example" id="citizenship" name="citizenship">
                                            @foreach($countries as $country)
                                                <option value="{{$country->name}}" > {{$country->name}}</option>
                                            @endforeach
                                        </select> 
                                    </div>     
                                </div> 
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Facility</label>
                                        <select class="selectpicker form-control" aria-label="Default select example" id="facility_id" name="facility_id">
                                            @foreach($facilities as $facility)
                                                <option value="{{$facility->id}}" > {{$facility->name}}</option>
                                            @endforeach
                                        </select> 
                                    </div>     
                                </div>    
                            </div> 

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Department</label>
                                        <select class="selectpicker form-control" width="100%" aria-label="Default select example">
                                            @foreach($departments as $department)
                                                <option value="{{$department->department->id}}" > {{$department->department->name}}</option>
                                            @endforeach
                                        </select> 
                                    </div>     
                                </div> 
                            
                                <div class="col-md-6">
                                <div class="form-group">
                                        {{ Form::label('address', 'Address', ['class' => 'form-control-label']) }}
                                        {{ Form::text('address', $user->profile->address, ['class' => 'form-control']) }}
                                    </div>    
                                </div>    
                            </div>

                        </div>      
                        
                        <!-- <hr class="my-4" /> -->
                        <!-- Address -->
                        <!-- <h6 class="heading-small text-muted mb-4">Password information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('password', 'Password', ['class' => 'form-control-label']) }}
                                        {{ Form::password('password', ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('password_confirmation', 'Confirm password', ['class' => 'form-control-label']) }}
                                        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <hr class="my-4" />
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    {{ Form::submit('Submit', ['class'=> 'mt-5 btn btn-primary lg']) }}
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

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"> </script>
    <script type="text/javascript" src="{{ asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"> </script>
    <script type="text/javascript" src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"> </script>
    <script type="text/javascript" src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"> </script>
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        jQuery(document).ready(function(){
            jQuery('#uploadFile').filemanager('file');
        })
    </script>

    <script>

    $('.datepicker').datepicker({
        format: 'yyyy/mm/dd',
        startDate: '-3d'
    });

    </script>
