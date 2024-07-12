 <section id="form-repeater">
  <div class="">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title" id="repeat-form">Category Forms</h4>                 
        </div>
        <div class="card-content collapse show">
          <div class="card-body">
            <div class="repeater-default">
              <?php $selected = explode(",", $Properties[0]->category);?>
              <?php  $cat_arr = json_decode($Properties[0]->category);  $array = (array) $cat_arr;   ?>
              <div data-repeater-list="category">       
                <div  data-repeater-item="" class="row">
                  <div class="form-group mb-1 col-sm-12 col-md-2">
                    <label for="profession">Category</label>
                    <br>


                    <select class="form-control" id="profession" name="category" >

                      @foreach($categories as $key => $categories)
                      <option value="{{$categories->name}}" <?php foreach ($array as $cat) {?>
                       @if($categories['name'] == $cat) {{ 'selected' }} @endif <?php  }?>  >{{$categories->name}} </option>
                       @endforeach  
                     </select> 
                   </div>
                   <div class="form-group mb-1 col-sm-12 col-md-2">
                    <label for="pass">MILE 1</label>
                    <br>                                       
                    <?php  $mile1 = json_decode($Properties[0]->mile_1);  $array = (array) $mile1;   ?>
                    <input type="number" class="form-control" id="mile1" placeholder="MILE 1" name="mile_1" value="{{$array['0']}}">
                  </div>
                  <div class="form-group mb-1 col-sm-12 col-md-2">
                    <label for="bio" class="cursor-pointer">MILE 2</label>
                    <br>
                    <?php  $mile2 = json_decode($Properties[0]->mile_2);  $array2 = (array) $mile2;   ?>
                    <input type="number" class="form-control" id="mile2" placeholder="{{$array2['0']}} " name="mile_2" value="{{$array2['0']}}">
                  </div>
                  <div class="skin skin-flat form-group mb-1 col-sm-12 col-md-2"> 
                    <label for="tel-input">MILE 3</label>
                    <br>
                    <?php  $mile3 = json_decode($Properties[0]->mile_3);  $array3 = (array) $mile3;   ?>
                    <input type="number" class="form-control" id="mile3" placeholder="MILE 3" name="mile_3" value="{{$array3['0']}}">
                  </div>

                  <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                    <button type="button" class="btn btn-danger" data-repeater-delete=""> <i class="ft-x"></i>
                    Delete</button>
                  </div>
                  <hr>
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




     <?php $selected = explode(",", $Properties[0]->category); ?>
                                  <?php  $cat_arr = json_decode(json_encode($Properties[0]->category),true);

                                    $array = (array) $cat_arr;  
                                        echo"<pre>";
                                  print_r($cat_arr );
                                 // exit;
                           /*        @if (count($array)>0)                    
                     @foreach ($array as $img)
                          <h1>
                            {{$img['mile_3']}}

                          </h1>
                     @endforeach
                     @endif*/
                                   ?>












<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

@include('Admin/Include.head')

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

  <!-- BEGIN: Header-->
  @include('Admin/Include.header')
  <!-- END: Header-->

  <!-- BEGIN: Main Menu-->
  @include('Admin/Include.sidebar')
  <!-- END: Main Menu-->
  <div class="content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
       <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title" id="row-separator-colored-controls">Property Info</h4>
              <div class="heading-elements"></div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body">
                @if(isset($Properties))
                <form class="form form-horizontal row-separator" action="{{ route('properties_update')}}" method="post" enctype="multipart/form-data">
                 @csrf 
                 <input type="hidden" name="id" id="id" value="{{$Properties[0]->id}}" >     
                 <div class="form-body">
                  <h4 class="form-section"><i class="la la-eye"></i> About Properties</h4>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row mx-auto">
                        <label class="col-md-3 label-control" for="userinput1">Properties Title:</label>
                        <div class="col-md-9">
                          <input type="text" id="properties_title" class="form-control border-primary" placeholder="Properties Title" name="properties_title" value="{{$Properties[0]->properties_title}}">
                          @if($errors->has('properties_title'))
                          <div class="error alert-danger">{{$errors->first('properties_title')}}</div>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row mx-auto">
                        <label class="col-md-3 label-control" for="userinput2">Properties Area:</label>
                        <div class="col-md-9">
                          <input type="test" id="properties_area" class="form-control border-primary" placeholder="Properties Area" name="properties_area" value="{{ $Properties[0]->properties_area }}">
                          @if($errors->has('properties_area'))
                          <div class="error alert-danger">{{ $errors->first('properties_area') }}</div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row mx-auto">
                        <label class="col-md-3 label-control" for="userinput1">Properties Address:</label>
                        <div class="col-md-9">
                          <textarea id="properties_address" rows="3" class="form-control border-primary" name="properties_address" placeholder="Properties Address">{{ $Properties[0]->properties_address }}</textarea>
                          @if($errors->has('properties_address'))
                          <div class="error alert-danger">{{ $errors->first('properties_address') }}</div>
                          @endif
                        </div>                                                          
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row mx-auto">
                        <label class="col-md-3 label-control" for="userinput1">Properties Location :</label>
                        <div class="col-md-9">
                          <input type="text" id="properties_location" class="form-control border-primary" placeholder="Properties Title" name="properties_location" value="{{$Properties[0]->properties_location}}">
                          @if($errors->has('properties_location'))
                          <div class="error alert-danger">{{ $errors->first('properties_location') }}</div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                   <div class="col-md-12">
                    <div class="form-group row mx-auto">
                      <label class="col-md-6 label-control" for="userinput2">Properties Description:</label>
                      <div class="col-md-12">                                                                      
                        <textarea class=" form-control tinymce border-primary" rows="2" name="properties_description" id="properties_description"  >
                          {{ $Properties[0]->properties_description }}  </textarea>
                          @if($errors->has('properties_description'))
                          <div class="error alert-danger">{{ $errors->first('properties_description') }}</div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row mx-auto">
                      <label class="col-md-3 label-control" for="userinput2">Properties Agent:</label>
                      <div class="col-md-9">                                                       
                        <select class="select2 form-control border-primary" multiple="multiple" name="properties_agent[]" required="">
                          <?php $selected = explode(",", $Properties[0]->properties_agent); ?>
                          <?php  $agent_arr = json_decode($Properties[0]->properties_agent);  $array = (array) $agent_arr;   ?>
                          @foreach($agent as $key => $agent)
                          <option value="{{$agent->agent_name}}" <?php foreach ($array as $cat) {?>
                            @if($agent['agent_name'] == $cat) {{ 'selected' }} @endif <?php  }?> >{{$agent->agent_name}}</option>
                            @endforeach        
                          </select>
                          @if($errors->has('properties_agent'))
                          <div class="error alert-danger">{{ $errors->first('properties_agent') }}</div>
                          @endif
                        </div>
                      </div>
                    </div>



                    <section id="form-repeater">
                      <div class="">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-header">
                              <h4 class="card-title" id="repeat-form">Category Forms</h4>                 
                            </div>
                            <div class="card-content collapse show">
                              <div class="card-body">
                                <div class="repeater-default">
                                  <?php $selected = explode(",", $Properties[0]->category);                           
                                  ?>
                                  <?php  $cat_arr = json_decode($Properties[0]->category);  $array = (array) $cat_arr;   ?>
                                  <div data-repeater-list="category">       
                                    <div  data-repeater-item="" class="row">
                                      <div class="form-group mb-1 col-sm-12 col-md-2">
                                        <label for="profession">Category</label>
                                        <br>

                                        
                                        <select class="form-control" id="profession" name="category" >

                                          @foreach($categories as $key => $categories)
                                          <option value="{{$categories->name}}" <?php foreach ($array as $cat) {?>
                                           @if($categories['name'] == $cat) {{ 'selected' }} @endif <?php  }?>  >{{$categories->name}} </option>
                                           @endforeach  
                                         </select> 
                                       </div>
                                       <div class="form-group mb-1 col-sm-12 col-md-2">
                                        <label for="pass">MILE 1</label>
                                        <br>                                       
                                        <input type="number" class="form-control" id="mile1" placeholder="MILE 1" name="mile_1" value="">
                                      </div>
                                      <div class="form-group mb-1 col-sm-12 col-md-2">
                                        <label for="bio" class="cursor-pointer">MILE 2</label>
                                        <br>
                                        <input type="number" class="form-control" id="mile2" placeholder="MILE 2" name="mile_2" value="">
                                      </div>
                                      <div class="skin skin-flat form-group mb-1 col-sm-12 col-md-2"> 
                                        <label for="tel-input">MILE 3</label>
                                        <br>                                     
                                        <input type="number" class="form-control" id="mile3" placeholder="MILE 3" name="mile_3" value="">
                                      </div>

                                      <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                        <button type="button" class="btn btn-danger" data-repeater-delete=""> <i class="ft-x"></i>
                                        Delete</button>
                                      </div>

                                      <hr>
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
                    <h4 class="form-section"><i class="la la-envelope"></i> Document </h4>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row mx-auto last">
                          <label class="col-md-3 label-control" for="userinput8">Properties Brochure :</label>
                          <div class="col-md-9">
                            <input type="file" id="myPdf" name="properties_brochure" accept=".pdf,.doc" / ><br> 

                            <?php $data =  str_replace('"',"",$Properties[0]->properties_brochure); 
                            $path = asset('public/file/'.$data); 
                            ?>
                            <iframe src="{{$path}}" width="50%" height="200px"></iframe>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row mx-auto last">
                          <label class="col-md-3 label-control" for="userinput8">Properties Site Plan :</label>
                          <div class="col-md-9">
                           <input type="file"  name="properties_siteplan" accept=".pdf,.doc"/  > 
                           <?php $data =  str_replace('"',"",$Properties[0]->properties_siteplan); 
                           $path = asset('public/file/'.$data); 
                           ?>
                           <iframe src="{{$path}}" width="50%" height="200px"></iframe>  
                         </div>
                       </div>
                     </div>
                   </div>
                   <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row mx-auto ">
                        <label class="col-md-0 label-control" for="userinput8">Gallery Image:</label>
                        <div class="col-md-9">
                         <input type="file" id="multiple_files" name="properties_image[]" multiple />   <br>
                         <div class="col-md-6">
                          <?php  $pro_image = json_decode($Properties[0]->properties_image);  ?>                               
                          <?php  $array = (array) $pro_image;
                          foreach ($array as $images)  {   ?>
                            <div class="preview_img"> 
                              <button type="button" class="remove-image btn-danger"  data-img_name="{{$images}}" data-id="{{$Properties[0]->id}}" >Remove</button>
                              <img src="{{asset('public/images/'.$images)}}" width="200" height="200"class="img-thumbnail" alt="Responsive image"> 
                              <input type="hidden" name="gallery_images[]" value = "{{$images}}">
                            </div>
                          <?php   }    ?> 
                        </div> 
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3">                   
                 @if (count($Properties[0]->images)>0)
                 <p>Images:</p>
                 @foreach ($Properties[0]-->images as $img)
                 <form action="/deleteimage/{{ $img->id }}" method="post">
                   <button class="btn text-danger">X</button>
                   @csrf
                   @method('delete')
                 </form>
                 <img src="/images/{{ $img->image }}" class="img-responsive" style="max-height: 100px; max-width: 100px;" alt="" srcset="">
                 @endforeach
                 @endif
               </div>





               <div class="form-actions text-right">
                <button type="button" class="btn btn-warning mr-1">
                  <i class="la la-remove"></i> Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                  <i class="la la-check"></i> Save
                </button>
              </div>
            </form>
            @else 
            <form class="form form-horizontal row-separator  " action="{{ route('properties_creat')}}" method="post" enctype="multipart/form-data">
             @csrf 
             <div class="form-body">
               <h4 class="form-section"><i class="la la-eye"></i> About Properties</h4>
               <div class="row">
                <div class="col-md-6">
                  <div class="form-group row mx-auto">
                    <label class="col-md-3 label-control" for="userinput1">Properties Title: </label>
                    <div class="col-md-9"> 
                      <input type="text" id="properties_title" class="form-control border-primary" placeholder="Properties Title" name="properties_title" required="">  @if($errors->has('properties_title'))
                      <div class="error alert-danger">{{ $errors->first('properties_title') }}</div>
                      @endif     
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row mx-auto">
                    <label class="col-md-3 label-control" for="userinput2">Properties Area:</label>
                    <div class="col-md-9">
                      <input type="test" id="properties_area" class="form-control border-primary" placeholder="Properties Area" name="properties_area" required="">
                      @if($errors->has('properties_area'))
                      <div class="error alert-danger">{{ $errors->first('properties_area') }}</div>
                      @endif   
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row mx-auto">
                    <label class="col-md-3 label-control" for="userinput1">Properties Address:</label>
                    <div class="col-md-9">
                      <textarea id="properties_address" rows="3" class="form-control border-primary" name="properties_address" placeholder="Properties Address" required> </textarea>
                      @if($errors->has('properties_address'))
                      <div class="error alert-danger">{{ $errors->first('properties_address') }}</div>
                      @endif  
                    </div>                                                          
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row mx-auto">
                    <label class="col-md-3 label-control" for="userinput1">Properties Location :</label>
                    <div class="col-md-9">
                      <input type="text" id="properties_location" class="form-control border-primary" placeholder="Properties Title" name="properties_location">
                      @if($errors->has('properties_location'))
                      <div class="error alert-danger">{{ $errors->first('properties_location') }}</div>
                      @endif
                    </div>
                  </div>
                </div>    
                <div class="col-12"> 
                  <div class="form-group row mx-auto">
                    <label class="col-md-6 label-control" >Properties Description:</label>
                    <div class="col-md-12" >                                                       
                     <textarea class=" form-control tinymce border-primary" rows="2" name="properties_description" id="properties_description" required="" >
                     </textarea>
                     @if($errors->has('properties_description'))
                     <div class="error alert-danger">{{ $errors->first('properties_description') }}</div>
                     @endif
                   </div>
                 </div>
               </div>
               <div class="col-md-6">
                <div class="form-group row mx-auto">
                  <label class="col-md-3 label-control" for="userinput2">Properties Agent:</label>
                  <div class="col-md-9">                                                       
                    <select class="select2 form-control" multiple="multiple" name="properties_agent[]" required>
                      @foreach($agent as $key => $agent)
                      <option value="{{$agent->agent_name}}" >{{$agent->agent_name}} </option>
                      @endforeach  
                    </select>  
                    @if($errors->has('properties_agent'))
                    <div class="error alert-danger">{{ $errors->first('properties_agent') }}</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <section id="form-repeater">
              <div class="">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title" id="repeat-form">Category Forms</h4>                 
                    </div>
                    <div class="card-content collapse show">
                      <div class="card-body">
                        <div class="repeater-default">
                          <div data-repeater-list="category">       
                            <div  data-repeater-item="" class="row">

                              <div class="form-group mb-1 col-sm-12 col-md-2">
                                <label for="profession">Category</label>
                                <br>
                                <select class="form-control" id="profession" name="category" required>
                                  @foreach($categories as $key => $categories)
                                  <option value="{{$categories->name}}" >{{$categories->name}} </option>
                                  @endforeach  
                                </select> 
                                @if($errors->has('category'))
                                <div class="error alert-danger">{{ $errors->first('category') }}</div>
                                @endif
                              </div>
                              <div class="form-group mb-1 col-sm-12 col-md-2">
                                <label for="pass">MILE 1</label>
                                <br>
                                <input type="number" class="form-control" id="mile1" placeholder="MILE 1" name="mile_1">
                              </div>
                              <div class="form-group mb-1 col-sm-12 col-md-2">
                                <label for="bio" class="cursor-pointer">MILE 2</label>
                                <br>
                                <input type="number" class="form-control" id="mile2" placeholder="MILE 2" name="mile_2">
                              </div>
                              <div class="skin skin-flat form-group mb-1 col-sm-12 col-md-2"> 
                                <label for="tel-input">MILE 3</label>
                                <br>
                                <input type="number" class="form-control" id="mile3" placeholder="MILE 3" name="mile_3">
                              </div>

                              <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                <button type="button" class="btn btn-danger" data-repeater-delete=""> <i class="ft-x"></i>
                                Delete</button>
                              </div>

                              <hr>
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

            <h4 class="form-section"><i class="la la-envelope"></i> Document </h4>                    
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row mx-auto first">
                  <label class="col-md-3 label-control" for="userinput8">Properties Brochure:</label>
                  <div class="col-md-9">
                    <input type="file" id="myPdf" name="properties_brochure" accept=".pdf,.doc" / required><br> 
                    @if($errors->has('properties_brochure'))
                    <div class="error alert-danger">{{ $errors->first('properties_brochure') }}</div>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row mx-auto last">
                  <label class="col-md-3 label-control" for="userinput8">Properties Site Plan:</label>
                  <div class="col-md-9">
                   <input type="file"  name="properties_siteplan" accept=".pdf,.doc"/ required>
                   @if($errors->has('properties_siteplan'))
                   <div class="error alert-danger">{{ $errors->first('properties_siteplan') }}</div>
                   @endif                         
                 </div>
               </div>
             </div>
           </div>

           <h4 class="form-section"><i class="la la-envelope"></i> Gallery </h4>
           <div class="row">
            <div class="col-md-12">
              <div class="form-group row mx-auto ">
                <label class="col-md-0 label-control" for="userinput8"> Image:</label>
                <div class="col-md-9">
                  <input type="file" id="multiple_files" name ="properties_image[]" multiple / required>
                           <!-- <div class="col-lg-6 col-12">
                                    <figure class="effect-oscar test" >
                                        <img src="../../../app-assets/images/gallery/9.jpg" alt="img09" />
                                        <figcaption >
                                            <h2>Warm <span>Oscar</span></h2>
                                            <p>Oscar is a decent man. He used to clean porches with pleasure.</p>
                                            <a href="#">View more</a>
                                        </figcaption>
                                    </figure>
                                  </div> -->

                                  @if($errors->has('properties_image'))
                                  <div class="error alert-danger">{{ $errors->first('properties_image') }}</div>
                                  @endif   
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <div class="form-actions text-right">
                          <button type="button" class="btn btn-warning mr-1">
                            <i class="la la-remove"></i> Cancel
                          </button>
                          <button type="submit" class="btn btn-primary">
                            <i class="la la-check"></i> Save
                          </button>
                        </div>
                        @endif 


                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- END: Content-->

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        @include('Admin/Include.footer')
      </body>
      <!-- image script -->
      <script>
        $(document).ready(function() {
          if (window.File && window.FileList && window.FileReader) {
            $("#multiple_files").on("change", function(e) {
              var multiple_files = e.target.files,
              filesLength = multiple_files.length;
              for (var i = 0; i < filesLength; i++) {
                var f = multiple_files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                  var file = e.target;
                  $("<span class=\"pip\">" +
                    "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                    "<br/><span class=\"img-delete\">Remove</span>" +
                    "</span>").insertAfter("#multiple_files");
                  $(".img-delete").click(function(){
                    $(this).parent(".pip").remove();
                  });
                });
                fileReader.readAsDataURL(f);
              }
            });
          } else {
            alert("|Sorry, | Your browser doesn't support to File API")
          }
        });
      </script>

      <script type="text/javascript">
       $(document).on("click",".remove-image",function() {

        var $this = $(this);
        var id = $(this).data("id");
        var img_name = $(this).data('img_name');   
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
              url: "{{ url('/remove_image') }}", 
              type: 'POST',
              dataType: "JSON",
              data: {
                "id": id,
                "img_name" :img_name,              
                "_token": token,
              },
              success: function ()
              {

                $this.parent('.preview_img').hide();

           /*Swal.fire({
            type: "success",
            title: 'Deleted!',
            text: 'Your file has been deleted.',
            confirmButtonClass: 'btn btn-success',
          })*/
            //location.reload();
          }
        });    
          }
        })
      });
    </script>

    </html>




                                   