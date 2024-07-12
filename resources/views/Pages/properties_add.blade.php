<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

@include('Include.head')
<style>
  input[type="file"] {
    display: block;
  }
  .imageThumb {
    max-height: 75px;
    border: 2px solid;
    padding: 1px;
    cursor: pointer;
  }
  .pip {
    display: inline-block;
    margin: 10px 10px 0 0;
  }
  .img-delete {
    display: block;
    background: #444;
    border: 1px solid black;
    color: white;
    text-align: center;
    cursor: pointer;
  }
  .img-delete:hover {
    background: white;
    color: black;
  }
</style>

<!-- END: Head-->
<style type="text/css">
  #pdfViewer {
    max-height: 175px;
    
    padding: 2px;
    cursor: pointer;
  }
</style>
<!-- BEGIN: Body-->
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
                 <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="row-separator-colored-controls">User Profile</h4>
                                    
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                          <!--   <li><a data-action="collapse"><i class="ft-minus"></i></a></li>                                         
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        
                                        <form class="form form-horizontal row-separator" action="{{ route('properties_creat')}}" method="post" enctype="multipart/form-data">
                                           @csrf 
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-eye"></i> About Properties</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row mx-auto">
                                                            <label class="col-md-3 label-control" for="userinput1">Properties Title:</label>
                                                            <div class="col-md-9">
                                                                <input type="text" id="properties_title" class="form-control border-primary" placeholder="Properties Title" name="properties_title">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row mx-auto">
                                                            <label class="col-md-3 label-control" for="userinput2">Properties Area:</label>
                                                            <div class="col-md-9">
                                                                <input type="text" id="properties_area" class="form-control border-primary" placeholder="Properties Area" name="properties_area">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row mx-auto">
                                                            <label class="col-md-3 label-control" for="userinput1">Properties Address:</label>
                                                            <div class="col-md-9">
                                                                <textarea id="properties_address" rows="3" class="form-control border-primary" name="properties_address" placeholder="Properties Address"></textarea>
                                                            </div>                                                          
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row mx-auto">
                                                            <label class="col-md-3 label-control" for="userinput2">Properties Description:</label>
                                                            <div class="col-md-9">                                                       
                                                                <textarea id="properties_description" rows="3" class="form-control border-primary" name="properties_description" placeholder="Properties Description"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group row mx-auto">
                                                            <label class="col-md-3 label-control" for="userinput2">Properties Agent:</label>
                                                            <div class="col-md-9">                                                       
                                                                <select class="js-example-basic-single form-control border-primary" multiple="multiple" name="properties_agent[]"size="10">
                                                                @foreach($agent as $key => $agent)
                                                                <option value="{{$agent->agent_name}}" >{{$agent->agent_name}} </option>
                                                                @endforeach        
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                </div>

                                                <h4 class="form-section"><i class="la la-envelope"></i> Document </h4>
                                                 <!-- <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group row mx-auto">
                                                            <label class="col-md-3 label-control" for="userinput5">Email</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control border-primary" type="text" placeholder="properties_agent" id="properties_agent">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mx-auto last">
                                                            <label class="col-md-3 label-control">Contact Number</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control border-primary" type="tel" placeholder="Contact Number" id="userinput7">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row mx-auto last">
                                                            <label class="col-md-3 label-control" for="userinput8">Bio</label>
                                                            <div class="col-md-9">
                                                                <textarea id="userinput8" rows="6" class="form-control border-primary" name="bio" placeholder="Bio"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                   <div class="row">
                                                      <div class="col-md-6">
                                                        <div class="form-group row mx-auto last">
                                                            <label class="col-md-3 label-control" for="userinput8">Properties Brochure :</label>
                                                            <div class="col-md-9">
                                                                <!-- <input type="file" id="myPdf" /><br>
                                                                <canvas id="pdfViewer"></canvas> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group row mx-auto last">
                                                            <label class="col-md-3 label-control" for="userinput8">Properties Site Plan :</label>
                                                            <div class="col-md-9">
                                                               <!-- <input type="file"  name="properties_siteplan" accept=".pdf,.doc"/> -->
                                                               <!-- <input type="file" id="pdf-upload" />
                                                               <canvas class="page" size="A4" layout="landscape"></canvas> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                      <div class="col-md-12">
                                                        <div class="form-group row mx-auto ">
                                                            <label class="col-md-0 label-control" for="userinput8">Gallery Image:</label>
                                                            <div class="col-md-9">
                                                               <!-- <input type="file"  name="properties_siteplan" accept=".pdf,.doc"/> -->
                                                              <input type="file" id="multiple_files" name="properties_image[]" multiple />
                                                            </div>
                                                        </div>
                                                    </div>
                                                     </div>
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

  @include('Include.footer')
  
</body>
        
        <!-- multiselect-->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
          $(document).ready(function() {
            $('.js-example-basic-single').select2();
          });
        </script>
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
<!-- pdf2 -->
<script src="//cdnjs.cloudflare.com/ajax/libs/pdf.js/1.8.349/pdf.min.js"></script>
<script type="text/javascript">
  document.querySelector("#pdf-upload").addEventListener("change", function(e) {
  var canvasElement = document.querySelector("canvas")
  var file = e.target.files[0]
  if (file.type != "application/pdf") {
    console.error(file.name, "is not a pdf file.")
    return
  }

  var fileReader = new FileReader();

  fileReader.onload = function() {
    var typedarray = new Uint8Array(this.result);

    PDFJS.getDocument(typedarray).then(function(pdf) {
      // you can now use *pdf* here
      console.log("the pdf has ", pdf.numPages, "page(s).")
      pdf.getPage(pdf.numPages).then(function(page) {
        // you can now use *page* here
        var viewport = page.getViewport(2.0);
        var canvas = document.querySelector("canvas")
        canvas.height = viewport.height;
        canvas.width = viewport.width;


        page.render({
          canvasContext: canvas.getContext('2d'),
          viewport: viewport
        });
      });

    });
  };

  fileReader.readAsArrayBuffer(file);
})
</script>
<!-- pdf1 -->
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script type="text/javascript">
  // Loaded via <script> tag, create shortcut to access PDF.js exports.
var pdfjsLib = window['pdfjs-dist/build/pdf'];
// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';

$("#myPdf").on("change", function(e){
  var file = e.target.files[0];

  if(file.type == "application/pdf"){
    var fileReader = new FileReader();  
    fileReader.onload = function() {
      var pdfData = new Uint8Array(this.result);
      // Using DocumentInitParameters object to load binary data.
      var loadingTask = pdfjsLib.getDocument({data: pdfData});
      loadingTask.promise.then(function(pdf) {
        console.log('PDF loaded');
        
        // Fetch the first page
        var pageNumber = 1;
        pdf.getPage(pageNumber).then(function(page) {
        console.log('Page loaded');
        
        var scale = 1.5;
        var viewport = page.getViewport({scale: scale});

        // Prepare canvas using PDF page dimensions
        var canvas = $("#pdfViewer")[0];
        var context = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        // Render PDF page into canvas context
        var renderContext = {
          canvasContext: context,
          viewport: viewport
        };
        var renderTask = page.render(renderContext);
        renderTask.promise.then(function () {
          console.log('Page rendered');
        });
        });
      }, function (reason) {
        // PDF loading error
        console.error(reason);
      });
    };
    fileReader.readAsArrayBuffer(file);
  }
});
</script>
</html>