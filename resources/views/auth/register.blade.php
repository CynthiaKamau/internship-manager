@extends('layouts.auth')

@section('content')

    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <h1 class="text-white">Welcome To Aya!</h1>
                        <p class="text-lead text-white">Please fill below form to create new account.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <div class="container mt--9 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-10">
                <div class="card bg-secondary border border-soft">
                    <div class="card-header px-lg-5 bg-transparent">
                        <h3 class="text-muted text-center my-2">Sign Up</h3>
                    </div>

                    <div class="card-body px-lg-5 py-lg-5 pt-2">
                        <form method="POST" action="{{ route('signup') }}">
                            @csrf

                            <div class="form-group row">

                                <div class="col-md-4">
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" placeholder="Middle Name" name="middle_name" value="{{ old('middle_name') }}" autocomplete="middle_name" autofocus>

                                    @error('middle_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <input id="last_name" type="text" placeholder="Last Name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row">

                                <div class="col-md-6">
                                    <input id="msisdn" type="number" placeholder="Phone Number" class="form-control @error('msisdn') is-invalid @enderror" name="msisdn" value="{{ old('msisdn') }}" required autocomplete="msisdn">

                                    @error('msisdn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

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
                                    <input id="nckid" type="number" placeholder="NCK Number" class="form-control @error('nckid') is-invalid @enderror" name="nckid" value="{{ old('nckid') }}" required autocomplete="nckid">

                                    @error('nckid')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>    
                            </div>

                                <div class="form-group row">

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
                            
                                    <div class="col-md-6">
                                        <select class="selectpicker form-control" aria-label="Default select example">
                                            <option selected>Select Role</option>
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
                                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                    <a class="text-gray ml-3" href="{{ route('login') }}">
                                        Login
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="row mt-3">

                    <div class="col-6">

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

<script>

$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});

</script>
