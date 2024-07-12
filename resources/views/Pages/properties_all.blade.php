<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

@include('Include.head')
<!-- END: Head-->

<!-- BEGIN: Body-->
   <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
   
    

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('Layout.navbar')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

    @include('Layout.sidebar')

    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">              
                <a href="{{url('properties_add')}}"class="btn btn-success btn-min-width mr-1 mb-1">Add Properties</a>
                <div class="card-content collapse show">
                    <div class="table-responsive">
                       
                       
                         
                        <table class="table table-bordered data-table">

                              <thead class="bg-teal bg-lighten-4">
                                <tr>
                                    <th>properties_title</th>
                                    <th>properties_address</th>
                                    <th>properties_area</th>
                                    <th>properties_description</th>
                                    <!-- <th>properties_image</th> -->
                                    <th>properties_brochure </th>
                                    <th>properties_siteplan </th>
                                    <th>properties_agent</th>
                                    <th>Action</th>          
                                </tr>
                            </thead>
                            <tbody>    
                                @foreach($listproperties as $key => $data)
                                <tr>
                                  <td>{{$data->properties_title}}</td>
                                  <td>{{$data->properties_address}}</td>
                                  <td>{{$data->properties_area}}</td>
                                  <td>{{$data->properties_description}}</td>
                                  <td>{{$data->properties_siteplan}}</td>
                                  <td>{{$data->properties_brochure}}</td>
                                <!--   <td>{{$data->properties_image}}</td> -->
                                  <td>{{$data->properties_image}}</td>
                                  <td class="center"><a href="{{URL::to('/delete_product/'.$data->id) }}"class="btn btn-xs btn-danger pull-right" >Delete</a>
                                   <a href="{{URL::to('/edit_product/'.$data->id) }}"class="btn btn-xs btn-info pull-right">Edit</a></td>
                               </tr>
                               @endforeach
                           </tbody>
                        </table>
                    </div>            
                </div>
            </div>
        </div>
    </div>


<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@include('Include.footer')

<!-- END: Page JS-->
<script type="text/javascript">
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: false,
        serverSide: false, 
         paging: true,      
  });
    });
</script>
</body>
<!-- END: Body-->

</html>


