<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

   @include('Include.head')
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('Layout.navbar')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
@include('Layout.sidebar')
    

    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
   <h1>test</h1>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
 
    <!-- END: Footer-->


   
</body>
<!-- END: Body-->

</html>


      <!-- <fieldset>
            <legend>Demographics</legend>

            <div class="panel panel-default">

              <div class="panel-body">

                <div id="education_fields">

                </div>
                <div class="col-sm-3 nopadding">
                  <label for="">MILE 1</label>
                  <div class="form-group">
                    <input type="number" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="MILE 1">
                  </div>
                </div>
                <div class="col-sm-3 nopadding">
                  <label for="">MILE 2</label>
                  <div class="form-group">
                    <input type="number" class="form-control" id="Major" name="Major[]" value="" placeholder="MILE 2">
                  </div>
                </div>
                <div class="col-sm-3 nopadding">
                  <label for="">MILE 3</label>
                  <div class="form-group">
                    <input type="number" class="form-control" id="Degree" name="Degree[]" value="" placeholder="MILE 3">
                  </div>
                </div>

                <div class="col-sm-3 nopadding">
                  <div class="form-group">
                    <label for="">CATEGORY :</label>
                    <div class="input-group">
                      <select class="form-control" id="educationDate" name="educationDate[]">             
                        @foreach($categories as $key => $categories)
                        <option value="{{$categories->name}}" >{{$categories->name}} </option>
                        @endforeach 
                      </select>
                      <div class="input-group-btn">
                        <button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="clear"></div>

              </div> 
            </div>
          </fieldset>
        -->


        <!-- dynamic -->
<!-- 
<script type="text/javascript">
  var room = 1;
function education_fields() {
 
    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group removeclass"+room);
  var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="MILE 1"></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <input type="number" class="form-control" id="Major" name="Major[]" value="" placeholder="MILE 2"></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <input type="" class="form-control" id="Degree" name="Degree[]" value="" placeholder="MILE 3"></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"> <select class="form-control" id="educationDate" name="educationDate[]"><option value="">CATEGORY</option> <option value="2015">2015</option>< </select><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';
    
    objTo.appendChild(divtest)
}
   function remove_education_fields(rid) {
     $('.removeclass'+rid).remove();
   }
</script>
-->



 <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <!-- line chart section start -->
        <form action="{{ route('properties_creat')}}" method="post" enctype="multipart/form-data"> 
          @csrf          
          <fieldset>
            <legend>Properties Information</legend>
            <div class='row'>
              <div class='col-sm-12'>
                <div class='form-group'>
                  <label for="user_login">Properties Title :</label>
                  <input class="form-control" id="user_login" name="properties_title" required="true" size="30" type="text" />
                </div>
              </div>
            </div>
            <div class='row'>
              <div class='col-sm-6'>
                <div class='form-group'>
                  <label for="">Properties Address :</label>
                  <textarea name="properties_address"  rows="2" class="form-control"></textarea>
                </div>
              </div>
              <div class='col-sm-6'>
                <div class='form-group'>
                  <label >Properties Area :</label>
                  <input class="form-control"  name="properties_area" size="30" type="text" />
                </div>
              </div>
              <div class='col-sm-6'>
                <div class='form-group'>
                  <label for="">Properties Description :</label>
                  <textarea name="properties_description" id="shortDescription1" rows="2" class="form-control"></textarea>

                </div>
              </div>
              <div class='col-sm-6'>
                <div class='form-group'>
                  <label >Properties Agent :</label>                   
                  <select class="js-example-basic-single form-control" multiple="multiple" name="properties_agent[]"size="10">
                    @foreach($agent as $key => $agent)
                    <option value="{{$agent->agent_name}}" >{{$agent->agent_name}} </option>
                    @endforeach        
                  </select>
                </div>
              </div>
              <div class='col-sm-6'>
                <div class='form-group'>
                  <label for="">Properties Brochure :</label>

                  <input type="file" id="test" name="properties_brochure" accept="application/pdf,doc"/>
                </div>
              </div>
              <div class='col-sm-6'>
                <div class='form-group'>
                  <label for="">Properties Site Plan :</label>
                  <!-- <input class="form-control" id="user_password_confirmation" name="user[password_confirmation]" size="30" type="password" /> -->
                  <input type="file"  name="properties_siteplan" accept=".pdf,.doc"/>
                </div>
              </div>


              <div class='col-sm-6'>
                <div class='form-group'>
                  <label for="user_password_confirmation">Properties Geo Location :</label>
                  <input class="form-control" name="properties_siteplan" size="30" type="password" accept="application/pdf,doc"/>

                </div>
              </div>
            </div>
          </fieldset>


        <fieldset>
          <legend>Gallery Image</legend>
          <div class='row'>
            <div class='col-sm-12'>
              <div class='form-group'>
                <label for="user_locale">Image </label>
                <input type="file" id="multiple_files" name="properties_image[]" multiple />
              </div>
            </div>
          </div>
        </fieldset> 
        <button type="Submit" class="btn btn-success btn-min-width mr-1 mb-1">Submit</button>
      </form>
      <!-- // line chart section end -->
    </div>
   </div>
 </div>

