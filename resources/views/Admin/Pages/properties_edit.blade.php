<!DOCTYPE html>
<html class="loading" lang="en" >

<!-- BEGIN: Head-->

@include('Admin/Include.head')
<!-- END: Head-->

<!-- BEGIN: Body-->

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
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Property Edit Forms</h3>
                     <a class="btn btn-round btn-info mb-1" href="{{url('properties_list')}}"> <i class="icon-cog3"> </i> Back </a>
                    <div class="row breadcrumbs-top d-inline-block">

                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="horizontal-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content collpase show">
                                    <div class="card-body">                                     
                                        <form class="form form-horizontal">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-eye"></i> Property Basic Info</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Title:</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput1" class="form-control border-" placeholder="Title Name" name="firstname"  value="Paramount Property">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Area:</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput2" class="form-control border-" placeholder="Area sfr" name="lastname"value="1200 sfr">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput3"> Agent Name :</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <select class="select2 form-control border-" multiple="multiple" name="properties_agent[]" >
                                                                    <option> paramount</option> 
                                                                    <option> paramount1</option>         
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4"> Location :</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput4" class="form-control border-" placeholder="Location" name="nickname"
                                                                value="U.K ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <section id="form-repeater">
                                                      <div class="">
                                                        <div class="col-sm-12 ">
                                                          <div class="card">
                                                            <div class="card-content collapse show">
                                                                <div class="card-body">
                                                                    <div class="repeater-default">
                                                                      <div data-repeater-list="category">       
                                                                        <div  data-repeater-item="" class="row">
                                                                          <div class="form-group  col-sm-12 col-md-2">
                                                                            <label for="profession">Category</label>
                                                                            <br>
                                                                            <select class="form-control" id="profession" name="category" >
                                                                              <option value=""> Personal</option>
                                                                              <option value=""> Aggent </option>
                                                                          </select> 
                                                                      </div>
                                                                      <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                        <label for="pass">MILE 1</label>
                                                                        <br>                                       
                                                                        <input type="number" class="form-control" id="mile1" placeholder="MILE 1" name="mile_1" value ="1000">
                                                                    </div>
                                                                    <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                        <label for="bio" class="cursor-pointer">MILE 2</label>
                                                                        <br>
                                                                        <input type="number" class="form-control" id="mile2" placeholder="MILE 2" name="mile_2" value ="2000">
                                                                    </div>
                                                                    <div class="skin skin-flat form-group mb-1 col-sm-12 col-md-2"> 
                                                                        <label for="tel-input">MILE 3</label>
                                                                        <br>                                     
                                                                        <input type="number" class="form-control" id="mile3" placeholder="MILE 3" name="mile_3" value ="3000">
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                                                        <button type="button" class="btn btn-danger" data-repeater-delete=""> <i class="ft-x"></i>
                                                                        Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group overflow-hidden">
                                                                <div class="col-12">
                                                                  <button type="button" data-repeater-create="" class="btn btn-primary">
                                                                    <i class="ft-plus"></i> Add
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <h4 class="form-section"><i class="ft-mail"></i> Document</h4>                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput3"> Brochure :</label>
                                    <div class="col-md-9 mx-auto">
                                       <input type="file" id="myPdf" name="properties_brochure" accept=".pdf,.doc" / ><br> 
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="userinput4"> Siteplan :</label>
                                <div class="col-md-9 mx-auto">
                                    <input type="file" id="myPdf" name="properties_brochure" accept=".pdf,.doc" / ><br> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">                        
                           <div class="card-header">
                               <label class="col-md-3 label-control" for="userinput4"> Gallery :</label>
                           </div>                   
                           <div class="card-content collapse show">
                            <div class="card-body">                                  
                                <div class="dropzone dropzone-area"  action="#" id="dpz-multiple-files" >
                                    <div class="dz-message" style="margin-top: -30px">Drop Files Here To Upload</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                                                 
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-md-0 label-control" for="userinput8">Description :</label>
                        <div class="col-md-12 mx-auto">
                            <textarea class=" form-control tinymce border-primary"  name="properties_description" id="properties_description"  > Realty have been developing residential, commercial and social club projects of over 64 lac sq. mtrs. (69 million sq. ft. approx) in Ahmedabad, Mumbai, .</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                <div class="form-actions text-right">
                                    <button type="button" class="btn btn-warning mr-1">
                                        <i class="ft-x"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
    <!-- // Basic form layout section end -->
</div>
</div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<!-- <script type="text/javascript">
    

    $(document).ready(function () {

        Dropzone.autoDiscover = false;
        $(".my-dp-zone").dropzone();
   })
</script> -->
@include('Admin/Include.footer')

</body>
<!-- END: Body-->

</html>