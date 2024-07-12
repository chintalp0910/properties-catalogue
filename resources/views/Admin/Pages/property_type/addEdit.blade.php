@extends('Admin.Pages.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            @include('Admin.Pages.layouts.alert')
            @php
                $faction = $action == 'ADD' ? route('property-type.store') : route('property-type.update', $type->id);
            @endphp
            <form class="form" method="post" action="{{ $faction }}" id="propertyTypeForm">
                @csrf
                @if ($action == 'ADD')
                    @method('POST')
                @else
                    @method('PUT')
                @endif
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        @if ($action == 'ADD')
                            <h3 class="content-header-title mb-0 d-inline-block">Add Property Type</h3>
                        @else
                            <h3 class="content-header-title mb-0 d-inline-block">Edit Property Type</h3>
                        @endif
                    </div>
                </div>
                <div class="content-body">
                    <section id="horizontal-form-layouts">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-content collpase show">
                                        <div class="card-body">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-align-left"></i>
                                                    Property Type Information</h4>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="description">Description <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="description" class="form-control"
                                                            placeholder="Description" name="description"
                                                            value="{{ old('description') ? old('description') : $type->description ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary mr-1"><i class="la la-check-square-o"></i>
                                    Save</button>
                                <a href="{{ route('property-type.index') }}" class="btn btn-warning "><i
                                        class="ft-x"></i>
                                    Cancel</a>
                            </div>
                        </div>
                </div>
            </form>
        </div>
        </section>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#propertyTypeForm").validate({
                rules: {
                    "description": {
                        required: true,
                    },
                },
                messages: {
                    "description": {
                        required: 'Please enter description'
                    },
                },
            });
        });
    </script>
@endpush
