@extends('Admin.Pages.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Property Types</h3>
                </div>
                @include('Admin.Pages.layouts.alert')
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('property-type.create') }}" class="btn btn-success btn-min-width mb-1">Add
                            Property Type</a>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered propertyTypeTable" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">#ID</th>
                                                <th>Description</th>
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
            var table = $('.propertyTypeTable').DataTable({
                processing: true,
                // serverSide: true,
                order: [1],
                paginate: true,
                ajax: "{{ route('property-type.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'description',
                        name: 'description'
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
