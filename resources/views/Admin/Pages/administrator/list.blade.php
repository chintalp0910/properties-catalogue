@extends('Admin.Pages.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Administrator</h3>
                </div>
                @include('Admin.Pages.layouts.alert')
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('administrator.create') }}" class="btn btn-success btn-min-width mb-1">Add
                            Administrator</a>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered administratorTable" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">#ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th width="14%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(function() {
            var table = $('.administratorTable').DataTable({
                processing: true,
                // serverSide: true,
                order: [1],
                paginate: true,
                ajax: "{{ route('administrator.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endpush
