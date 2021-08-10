@extends('layouts.app')
@push('pg_btn')
@can('create-post')
    <a href="{{ route('post.create') }}" class="btn btn-sm btn-neutral">Create New Resource</a>
@endcan
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">All Resources</h3>
                        </div>
                        <div class="col-lg-4">
                            {!! Form::open(['route' => 'post.index', 'method'=>'get']) !!}
                            <div class="form-group mb-0">
                                {{ Form::text('search', request()->query('search'), ['class' => 'form-control form-control-sm', 'placeholder'=>'Search Resources']) }}
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <div class="row col-md-12 text-center">

                    @foreach($posts as $post)

                        <div class="card col-md-3 mb-3" >                        
                            @if ($post->featured_image)
                                <a href="{{ asset('storage/'.$post->featured_image) }}" target="_blank">
                                    <img width="250" height="250" class="img-fluid" src="{{$post->featured_image }}" alt="">
                                </a>
                            @endif

                            <div class="card-body"> 

                                <div class="card-title"> <strong>{{ $post->post_title }} </strong> </div>

                                <div class="card-title"> {{ $post->category->category_name }} </div>

                                <div class="card-title"> {{ $post->user->name }} </div>

                                <p class="card-text"> {!! $post->post_body !!} </p>

                                <p class="card-text"> {{ $post->status ? 'Active' : 'Disable'}} </p>

                                @can('destroy-post')
                                {!! Form::open(['route' => ['post.destroy', $post],'method' => 'delete',  'class'=>'d-inline-block dform']) !!}
                                @endcan
                                @can('view-post')
                                <a class="btn btn-primary btn-sm m-1" data-toggle="tooltip" data-placement="top" title="View and edit post details" href="{{route('post.show', $post)}}">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                @endcan
                                @can('update-post')
                                <a class="btn btn-info btn-sm m-1" data-toggle="tooltip" data-placement="top" title="Edit post details" href="{{route('post.edit',$post)}}">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                @endcan
                                @can('destroy-post')
                                    <button type="submit" class="btn delete btn-danger btn-sm m-1" data-toggle="tooltip" data-placement="top" title="Delete post" href="">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                {!! Form::close() !!}
                                @endcan

                            </div>
                                
                        </div>
                        
                    @endforeach
                                    
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        jQuery(document).ready(function(){
            $('.delete').on('click', function(e){
                e.preventDefault();
                let that = jQuery(this);
                jQuery.confirm({
                    icon: 'fas fa-wind-warning',
                    closeIcon: true,
                    title: 'Are you sure!',
                    content: 'You can not undo this action.!',
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                        confirm: function () {
                            that.parent('form').submit();
                            //$.alert('Confirmed!');
                        },
                        cancel: function () {
                            //$.alert('Canceled!');
                        }
                    }
                });
            })
        })

    </script>
@endpush
