<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
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
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0"> Property Detail</h3>
                    <div class="row breadcrumbs-top">
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-6 col-12">
                    <div class="btn-group">
                        <a class="btn btn-round btn-info mb-1" href="{{url('properties_list')}}"> <i class="icon-cog3"> </i> Back </a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="product-detail">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-5 mb-1 mb-md-0 ">
                                        <div class="align-items-center">
                                            <img class="img-fluid" src="{{asset('app-assets/images/gallery/39.png')}}" alt="Card image cap">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="title-area clearfix">
                                            <h2 class="product-title float-left"> Property Title</h2>
                                        </div>
                                        <div class="price-reviews clearfix">
                                            <span class="price-box">
                                                <span class="price h4">2500 sq ft</span>                                              
                                            </span>
                                        </div>
                                        <!-- Product Information -->
                                        <div class="product-info">
                                          <p>Just as our community of aviation enthusiasts is diverse, so are our home styles. From cape cod to farmhouse, you’ll truly see a little bit of everything on the grounds of Big South Fork Airpark. The unifying factor, however, is the high quality of each home.
                                          With beautiful old trees growing throughout the acreage, you’ll enjoy the perks of a brand new home with the feeling of an established community.</p>
                                      </div>
                                      <!-- Product Information Ends-->
                                      <div class="row">
                                        <!-- Amenities -->
                                        <div class="col-sm-8">
                                            <i class="la la-beer font-large-1 mr-1" data-toggle="tooltip" data-placement="top" data-original-title="Beer"></i>
                                            <i class="la la-wifi font-large-1 mr-1" data-toggle="tooltip" data-placement="top" data-original-title="Wifi"></i>
                                            <i class="la la-tv font-large-1 mr-1" data-toggle="tooltip" data-placement="top" data-original-title="Television"></i>
                                            <i class="la la-glass font-large-1 mr-1" data-toggle="tooltip" data-placement="top" data-original-title="Complimentary Drinks"></i>
                                            <i class="la la-car font-large-1 mr-1" data-toggle="tooltip" data-placement="top" data-original-title="Cab"></i>
                                        </div>
                                        <!-- Amenities -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="product-tabs nav nav-tabs nav-underline no-hover-bg">
                                <li class="nav-item">
                                    <a class="nav-link active" id="description" data-toggle="tab" aria-controls="desc" href="#desc" aria-expanded="true">Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="review" data-toggle="tab" aria-controls="ratings" href="#ratings" aria-expanded="false">Document</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="comments" data-toggle="tab" aria-controls="comment" href="#comment" aria-expanded="false">Image</a>
                                </li>
                            </ul>
                            <div class="product-content tab-content px-1 pt-1">
                                <div role="tabpanel" class="tab-pane active" id="desc" aria-expanded="true" aria-labelledby="description">
                                    <h2 class="my-1"> Property Details</h2>
                                    <p>Just as our community of aviation enthusiasts is diverse, so are our home styles. From cape cod to farmhouse, you’ll truly see a little bit of everything on the grounds of Big South Fork Airpark. The unifying factor, however, is the high quality of each home.
                                    With beautiful old trees growing throughout the acreage, you’ll enjoy the perks of a brand new home with the feeling of an established community.</p>
                                    <br>
                                    <h4>Address : </h4>
                                    <ul>
                                      <li> Airpark Way Oneida, TN 37841</li>                                           
                                  </ul>
                                  <h4>Property Agents : </h4>
                                  <ul>
                                    <li> John phillip</li>
                                    <li> Josh ponting</li>                                           
                                </ul>
                                <h4>Property map Location : </h4>
                                <ul>
                                    <li>2263 Airport Rd, Oneida, TN 37841</li>                                           
                                </ul>
                            </div>
                            <div class="tab-pane" id="ratings" aria-labelledby="review">
                                <h2 class="my-1">Propert Siteplan & Brochure</h2>
                                <div class="media-list media-bordered">
                                    <div class="media">
                                      test
                                  </div>   
                              </div>                               
                          </div>
                          <div class="tab-pane" id="comment" aria-labelledby="comments">
                            <h2 class="my-1"> Property Gallery</h2>
                            <div class="media-list media-bordered">                                       

                               <section id="image-gallery" class="card">

                                  <div class="card-content collapse show ">

                                    <div class="card-body  my-gallery" itemscope itemtype="http://schema.org/ImageGallery">                       
                                      <div class="row">
                                        <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                          <a href="{{asset('app-assets/images/gallery/9.jpg')}}" itemprop="contentUrl" data-size="480x360">
                                            <img class="img-thumbnail img-fluid" src="{{asset('app-assets/images/gallery/9.jpg')}}" itemprop="thumbnail" alt="Image description" />
                                        </a>
                                    </figure>
                                    <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                      <a href="{{asset('app-assets/images/gallery/10.jpg')}}" itemprop="contentUrl" data-size="480x360">
                                        <img class="img-thumbnail img-fluid" src="{{asset('app-assets/images/gallery/10.jpg')}}" itemprop="thumbnail" alt="Image description" />
                                    </a>
                                </figure> 
                                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                  <a href="{{asset('app-assets/images/gallery/9.jpg')}}" itemprop="contentUrl" data-size="480x360">
                                    <img class="img-thumbnail img-fluid" src="{{asset('app-assets/images/gallery/9.jpg')}}" itemprop="thumbnail" alt="Image description" />
                                </a>
                            </figure>
                            <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                              <a href="{{asset('app-assets/images/gallery/10.jpg')}}" itemprop="contentUrl" data-size="480x360">
                                <img class="img-thumbnail img-fluid" src="{{asset('app-assets/images/gallery/10.jpg')}}" itemprop="thumbnail" alt="Image description" />
                            </a>
                        </figure>                                               
                    </div>
                </div>
                <!--/ Image grid -->

            </div>
            <!--/ PhotoSwipe -->
        </section>
    </div>
</div>
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
<!-- END: Page JS-->
</body>
<!-- END: Body-->
@include('Admin/Include.footer')
</html>