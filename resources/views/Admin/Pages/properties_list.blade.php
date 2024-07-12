<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
@include('Admin.Include.head')
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('Admin.Include.header')
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    @include('Admin.Include.sidebar')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <a href="{{ route('properties.create') }}" class="btn btn-success btn-min-width mr-1 mb-1">Add
                    Property</a>
                <div class="card-content collapse show">

                    <section id="ordering">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered default-ordering">
                                                    <thead>
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Area</th>
                                                            <th>Address</th>
                                                            <th>Front Image</th>
                                                            <th>Agent</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Real Estate</td>
                                                            <td> 2500 sq ft</td>
                                                            <td>Airpark Way Oneida, TN 37841</td>
                                                            <td> <img
                                                                    src="{{ asset('app-assets/images/gallery/39.png') }}"
                                                                    alt="Card image cap" height="50" width="100"></td>
                                                            <td> John phillip</td>
                                                            <td>
                                                                <a href="{{ route('properties.create') }}"
                                                                    class="btn  btn-info">Edit</a>
                                                                <a href="{{ route('properties.create') }}"
                                                                    class="btn  btn-warning">View</a>
                                                                <button type="button" class="btn btn-danger "
                                                                    id="confirm-delete">Delete</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>At a glance</td>
                                                            <td> 1500 sq ft</td>
                                                            <td>Ahmedabad, Mumbai, Gurgaon, Kochi</td>
                                                            <td> <img
                                                                    src="{{ asset('app-assets/images/gallery/39.png') }}"
                                                                    alt="Card image cap" height="50" width="100"></td>
                                                            <td> Bean Stock</td>
                                                            <td>
                                                                <a href="{{ route('properties.create') }}"
                                                                    class="btn  btn-info">Edit</a>
                                                                <a href="{{ route('properties.create') }}"
                                                                    class="btn  btn-warning">View</a>
                                                                <button type="button" class="btn btn-danger "
                                                                    id="confirm-delete">Delete</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('Admin/Include.footer')

    <!-- END: Page JS-->
    <script type="text/javascript">
        $(document).on("click", "#confirm-delete", function() {
            var id = $(this).data("id");
            var token = '{{ csrf_token() }}';
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm!',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "property_delete/" + id,
                        type: 'DELETE',
                        dataType: "JSON",
                        data: {
                            "id": id,
                            "_method": 'DELETE',
                            "_token": token,
                        },
                        success: function() {
                            Swal.fire({
                                type: "success",
                                title: 'Deleted!',
                                text: 'Your file has been deleted.',
                                confirmButtonClass: 'btn btn-success',
                            })
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
</body>
<!-- END: Body-->

</html>
