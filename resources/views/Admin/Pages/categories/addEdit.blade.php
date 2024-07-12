@extends('Admin.Pages.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            @include('Admin.Pages.layouts.alert')
            @php
                $faction = $action == 'ADD' ? route('categories.store') : route('categories.update', $category->id);
            @endphp
            <form class="form" method="post" action="{{ $faction }}" id="categoryForm">
                @csrf
                @if ($action == 'ADD')
                    @method('POST')
                @else
                    @method('PUT')
                @endif
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        @if ($action == 'ADD')
                            <h3 class="content-header-title mb-0 d-inline-block">Add category</h3>
                        @else
                            <h3 class="content-header-title mb-0 d-inline-block">Edit category</h3>
                        @endif
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <a href="{{ route('categories.index') }}" class="btn btn-warning float-right"><i
                                class="ft-x"></i>
                            Cancel</a>
                        <button type="submit" class="btn btn-primary mr-1 float-right">
                            <i class="la la-check-square-o"></i> Save
                        </button>
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
                                                <h4 class="form-section"><i class="ft-plus"></i>category
                                                    Information</h4>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="title">Title <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="title" class="form-control"
                                                            placeholder="Title" name="title"
                                                            value="{{ old('title') ? old('title') : $category->title ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="a4a_sort">#Sorting</label>
                                                        <input type="number" id="a4a_sort" class="form-control"
                                                            placeholder="#Sorting" name="a4a_sort"
                                                            value="{{ old('a4a_sort') ? old('a4a_sort') : $category->a4a_sort ?? '' }}">
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
                                <a href="{{ route('categories.index') }}" class="btn btn-warning "><i class="ft-x"></i>
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
            $("#categoryForm").validate({
                rules: {
                    "title": {
                        required: true,
                    },
                },
                messages: {
                    "title": {
                        required: 'Please enter title'
                    },
                },
            });
        });
    </script>
@endpush
