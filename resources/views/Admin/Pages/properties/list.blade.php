@extends('Admin.Pages.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Properties</h3>
                </div>
                @include('Admin.Pages.layouts.alert')
                <div class="row">
                    <div class="col-md-6">
                        <a href="javascript:void(0)" class="btn btn-danger btn-min-width mb-1" id="bulk-delete">Delete</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('properties.create') }}" class="btn btn-success btn-min-width mb-1">Add
                            property</a>
                    </div>
                </div>
{{--                <div class="row">--}}
{{--                    <div class="form-group col-md-4 mb-2">--}}
{{--                        --}}{{-- <label for="property_type">Property Type</label> --}}
{{--                        <select id="property_type" name="property_type_id" class="form-control select2">--}}
{{--                            <option value="">All Property Type</option>--}}
{{--                            @foreach ($types as $type)--}}
{{--                                <option value="{{ $type->id }}">--}}
{{--                                    {{ $type->description }}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <div id="propertyTypeerrorTxt"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="card-content collapse show">
                    <div class="card">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <form id="checkbox-form" action="{{ route('properties.bulkDelete') }}" method="POST">
                                    @csrf
                                    <div class="table-responsive">
                                        <table class="table table-bordered propertyTable" width="100%">
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
                                                    <th>Area</th>
                                                    <th>Type</th>
                                                    <th>Address</th>
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
        var table = '';
        $(function() {
            table = $('.propertyTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,

                order: [1],
                ajax: {
                    url: "{{ route('properties.index') }}",
                    type: "GET",
                    data: function(d) {
                        d.property_type = $('#property_type').val();
                    },
                },
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'square_foot',
                        name: 'square_foot',
                    },
                    {
                        data: 'property_type',
                        name: 'property_type.description',
                    },
                    {
                        data: 'address',
                        name: 'address',
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

        $('#property_type').change(function() {
            table.draw();
        });

        $(".properties").on("click", function() {
            $('.propertyTable').DataTable().state.clear();
        });
    </script>
@endpush
