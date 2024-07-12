<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

@include('Admin/Include.head')
<!-- END: Head-->

<!-- BEGIN: Body-->
<!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

  <!-- BEGIN: Header-->
  @include('Admin/Include.header')
  <!-- END: Header-->

  <!-- BEGIN: Main Menu-->
  @include('Admin/Include.sidebar')
  <!-- END: Main Menu-->

  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
     <div class="content-wrapper">
      <div class="content-body">              
        <a href="{{url('add_from')}}"class="btn btn-success btn-min-width mr-1 mb-1">Add Properties</a>
       <div class="card-content collapse show">
        <div class="table-responsive">   
          <table class="table table-bordered data-table">
            <thead class="bg-teal bg-lighten-4">
              <tr>
                <th>Title</th>
                <th>Address</th>
                <th>Area</th>
                <th>Description</th>
                <th>Image</th>
              <!-- <th>Brochure </th>
                <th>Siteplan </th> -->
                <th>Agent</th>
                <th>Action</th>          
              </tr>
            </thead>
            <tbody>    
              @foreach($listproperties as $key => $data)
              <?php  $pro_agent = json_decode($data->properties_agent);  ?>
              <?php  $desc_arr = json_decode($data->properties_description);  ?>
              <?php  $pro_image = json_decode($data->properties_image);  ?>
              <tr>
                <td>{{$data->properties_title}}</td>
                <td>{{$data->properties_address}}</td>
                <td>{{$data->properties_area}}</td>                        
                
                <td> <?php echo substr(strip_tags($data->properties_description),0,110) . "..."; ?></td>
                <td>
                 <?php  
                 $array = (array) $pro_image;
                 foreach ($array as $images)  {   ?>
                  <img src="{{asset('public/images/' . $images)}}" width="100" height="100"class="img-thumbnail" alt="Responsive image"> 
                      <?php   break; }    ?> 
                </td>
                <td>
                 <?php  
                 $agent_array = (array) $pro_agent;
                 foreach ($agent_array as $agent)  {   
                  echo   $agent.",";
                }    ?> 
              </td>
              <td class="center">
               <!--  <a href="{{URL::to('/delete_property/'.$data->id) }}"class="btn btn-danger" >Delete</a> -->
               <button type="button" class="btn btn-danger " id="confirm-delete"   data-id="{{ $data->id }}">Delete</button>
               <a href="{{URL::to('/edit_from/'.$data->id) }}"class="btn  btn-info">Edit</a>
               <a href="{{URL::to('/view_property/'.$data->id) }}"class="btn  btn-warning">View</a></td>
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

@include('Admin/Include.footer')

<!-- END: Page JS-->
<script type="text/javascript">
  $(function () {

    var table = $('.data-table').DataTable({
      processing: false,
      serverSide: false, 
      paging: true,
      orderable : false,
      sorting_asc : false,  

    });

  });
</script>

<script type="text/javascript">
   $(document).on("click","#confirm-delete",function() {
    var id = $(this).data("id");   
    var token = '{{ csrf_token()}}';
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
    }).then(function (result) {
      if (result.value) {          
        $.ajax(
        {
          url: "delete_property/"+id,
          type: 'DELETE',
          dataType: "JSON",
          data: {
            "id": id,
            "_method": 'DELETE',
            "_token": token,
          },
          success: function ()
          {
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


