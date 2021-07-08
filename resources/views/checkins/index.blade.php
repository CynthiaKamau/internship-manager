@extends('layouts.app')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

@push('pg_btn')
@can('create-checkins')
    <a href="{{ route('checkins.create') }}" class="btn btn-sm btn-neutral">Create New checkins</a>
@endcan
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">All Checkins</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Student</th>
                                <th>Supervisor</th>
                                <th>Facility</th>
                                <th>Location</th>
                                <th>Approved</th>
                                <th>Created at</th>
                                <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>        

            </div>
        </div>
    </div>
@endsection
@push('scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

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

        $(function() {
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('checkins.index') !!}',
                columns: [
                { data: 'id', name: 'id' },
                { data: 'student', name: 'student' },
                { data: 'supervisor', name: 'supervisor' },
                { data: 'facility', name: 'facility'},
                { data: 'location', name: 'location' },
                { data: 'approved', name: 'approved'},
                { data: 'created_at', name: 'created_at' },
                {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });    
  
    </script>  
    
  ​
@endpush
