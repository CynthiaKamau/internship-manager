@extends('layouts.app')
@push('pg_btn')
    @can('update-internships')
        <a class="btn btn-info btn-sm m-1" data-toggle="tooltip" data-placement="top" title="Edit internship details" href="{{route('internships.edit',$internship)}}">
            <i class="fa fa-edit" aria-hidden="true"></i> Edit Internsip
        </a>
    @endcan
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            Title
                        </div>
                        <div class="col-sm-8">
                            <strong>{{ $internship->title }}</strong>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            Responsibilities
                        </div>
                        <div class="col-sm-8">
                            <strong>{{ $internship->responsibilities }}</strong>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            Qualifications
                        </div>
                        <div class="col-sm-8">
                            <strong>{!! $internship->qualifications !!}</strong>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            Duration
                        </div>
                        <div class="col-sm-8">
                            <strong>{!! $internship->duration !!}</strong>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            Application Deadline
                        </div>
                        <div class="col-sm-8">
                            <strong>{!! $internship->validity !!}</strong>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            Created By
                        </div>
                        <div class="col-sm-8">
                            <strong>{{ $internship->user->first_name }}</strong>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            Status
                        </div>
                        <div class="col-sm-8">
                            {{ $internship->status ? 'Active' : 'Disabled'}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
