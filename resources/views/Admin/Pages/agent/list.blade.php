@extends('Admin.Pages.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Agents</h3>
                </div>
                @include('Admin.Pages.layouts.alert')
                <div class="row">
                    <div class="col-md-6">
                        <a href="javascript:void(0)" class="btn btn-danger btn-min-width mb-1" id="bulk-delete">Delete</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('agents.create') }}" class="btn btn-success btn-min-width mb-1">Add Agent</a>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <form id="checkbox-form" action="{{ route('agents.bulkDelete') }}" method="POST">
                                    @csrf
                                    <div class="table-responsive">

                                        <table class="table table-bordered agentTable" width="100%">
                                            <thead>
                                                <tr>
                                                    <th width="1%" class="text-center">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input checkItem"
                                                                name="customCheck" id="checkAll">
                                                            <label class="custom-control-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
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
                                </form>
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
            var table = $('.agentTable').DataTable({
                processing: true,
                /*serverSide: true,*/
                order: [1],
                paginate: true,
                ajax: "{{ route('agents.index') }}",
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
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