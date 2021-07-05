@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    {!! Form::open(['route' => ['profile.update', $user], 'files' => true]) !!}
                    <h6 class="heading-small text-muted mb-4">Profile</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('name', 'Name', ['class' => 'form-control-label']) }}
                                        {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('msisdn', 'Phone number', ['class' => 'form-control-label']) }}
                                        {{ Form::text('msisdn', $user->msisdn, ['class' => 'form-control']) }}
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
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6">
                                <label>Select Citizenship</label>
                                <select class="selectpicker form-control" data-width="100%" id="citizenship" name="citizenship" data-actions-box="true">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->name}}" > {{$country->name}}</option>
                                    @endforeach
                                </select>  
                                
                            </div> 
                        
                            <div class="col-md-6">
                                <label>Select Facility</label>
                                <select class="selectpicker form-control" data-width="100%" id="facility_id" name="facility_id" data-actions-box="true">
                                    @foreach($facilities as $facility)
                                        <option value="{{ $facility->id}}" > {{$facility->name}}</option>
                                    @endforeach
                                </select>  
                                
                            </div>    
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6">
                                <div class="input-group date col-md-6" data-provide="datepicker">
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

                                <div class="col-md-6">
                                    <select class="selectpicker form-control" aria-label="Default select example">
                                        <option selected>Select Gender</option>
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

                            <div class="col-md-6">
                            </div>
                        </div>    
                        
                        <hr class="my-4" />
                        <!-- Address -->
                        <h6 class="heading-small text-muted mb-4">Password information</h6>
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
                        </div>
                        <hr class="my-4" />
                        <div class="pl-lg-4">
                            <div class="row">
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

@push('scripts')
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        jQuery(document).ready(function(){
            jQuery('#uploadFile').filemanager('file');
        })
    </script>
@endpush
