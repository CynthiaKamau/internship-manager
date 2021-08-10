@extends('layouts.app')
@push('pg_btn')
    @can('update-post')
        <a class="btn btn-info btn-sm m-1" data-toggle="tooltip" data-placement="top" title="Edit post details" href="{{route('post.edit',$post)}}">
            <i class="fa fa-edit" aria-hidden="true"></i> Edit Resource
        </a>
    @endcan
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-1">
                            Title
                        </div>
                        <div class="col-sm-3">
                            {{ $post->post_title }}
                            
                        </div>
                        <div class="col-sm-4">
                            @if ($post->featured_image)
                                <a href="{{ asset('storage/'.$post->featured_image) }}" target="_blank">
                                    <img width="250" height="250" class="img-fluid" src="{{ $post->featured_image }}" alt="">
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            Category
                        </div>
                        <div class="col-sm-3">
                            {{ $post->category->category_name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            Created By
                        </div>
                        <div class="col-sm-3">
                            {{ $post->user->name }}
                        </div>
                    </div>

                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-1">
                            Body
                        </div>
                        <div class="col-sm-3">
                            {!! $post->post_body !!}
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-1">
                            Status
                        </div>
                        <div class="col-sm-3">
                            {{ $post->status ? 'Active' : 'Disabled'}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
