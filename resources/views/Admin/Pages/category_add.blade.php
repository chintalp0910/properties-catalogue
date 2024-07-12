<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

@include('Admin/Include.head')
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

	<!-- BEGIN: Header-->
	@include('Admin/Include.sidebar')
	<!-- END: Header-->
	<!-- BEGIN: Main Menu-->
	@include('Admin/Include.header')
	<!-- END: Main Menu-->

	<!-- BEGIN: Content-->
	<div class="app-content content">
		<div class="content-overlay"></div>
		<div class="content-wrapper">

			<div class="content-body">
				<!-- line chart section start -->
				<button type="button" class="btn btn-info mr-1"> Add Category</button> <br><br>

				<table class="table table-bordered data-table">
					<thead class="bg-teal bg-lighten-4">
						<tr>
							<th>Id</th>
							<th>Name</th>              
							<th>Action</th>          
						</tr>
					</thead>
					<tbody>    
						@foreach($listproperties as $key => $data)           
						<tr>
							<td>{{$data->id}}</td>
							<td>{{$data->name}}</td>                               
							<td class="center">
								
								<button type="button" class="btn btn-danger " id="confirm-delete"   data-id="{{ $data->id }}">Delete</button>
								<a href="#{{URL::to('/edit_from/'.$data->id) }}"class="btn  btn-info">Edit</a>
								<!-- 	<a href="{{URL::to('/view_property/'.$data->id) }}"class="btn  btn-warning">View</a></td> -->
							</tr>
							@endforeach
						</tbody>
					</table>




				</div>
			</div>
		</div>
		<!-- END: Content-->
		<div class="sidenav-overlay"></div>
		<div class="drag-target"></div>
	</body>
	<!-- END: Body-->
	@include('Admin/Include.footer')


	<script type="text/javascript">
		$(function () {

			var table = $('.data-table').DataTable({
				processing: false,
				serverSide: false, 
				paging: true,      
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

	</html>