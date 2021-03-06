@extends('layouts.app')
@push('pg_btn')
@can('create-department')
    <a href="{{ route('facility_department.create', $profile ?? '') }}" class="btn btn-sm btn-neutral">Create New Facility Department</a>
@endcan
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">All Departments</h3>
                        </div>
                        <div class="col-lg-4">
                    {!! Form::open(['route' => 'users.index', 'method'=>'get']) !!}
                        <div class="form-group mb-0">
                        {{ Form::text('search', request()->query('search'), ['class' => 'form-control form-control-sm', 'placeholder'=>'Search departments']) }}
                    </div>
                    {!! Form::close() !!}
                </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <div>
                            <table class="table table-hover align-items-center">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Facility</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach($facility_departments as $facility_department)
                                    <tr>
                                        <th scope="row">
                                            {{$facility_department->facility->name}}
                                        </th>
                                        <th scope="row">
                                            {{$facility_department->department->name}}
                                        </th>
                                        <td>
                                            @if($facility_department->department->status)
                                                <span class="badge badge-pill badge-lg badge-success">Active</span>
                                            @else
                                                <span class="badge badge-pill badge-lg badge-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{$facility_department->department->created_at}}
                                        </td>
                                        <td class="text-center">
                                            @can('destroy-department')
                                            {!! Form::open(['route' => ['facility_department.destroy', $facility_department],'method' => 'delete',  'class'=>'d-inline-block dform']) !!}
                                            @endcan

                                            @can('update-department')
                                            <a class="btn btn-info btn-sm m-1" data-toggle="tooltip" data-placement="top" title="Edit department details" href="{{route('facility_department.edit',$facility_department)}}">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                            @endcan
                                            @can('destroy-department')
                                                <button type="submit" class="btn delete btn-danger btn-sm m-1" data-toggle="tooltip" data-placement="top" title="Delete department" href="">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot >
                                <tr>
                                    <td colspan="6">
                                        {{$facility_departments->links()}}
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
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
