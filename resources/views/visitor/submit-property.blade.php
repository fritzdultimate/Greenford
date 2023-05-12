@include('visitor.layouts.header')
    <div id="apus-main-content">
        <section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb  show-title">
            <div class="container">
                <div class="wrapper-breads">
                    <div class="wrapper-breads-inner">
                        <div class="breadscrumb-inner clearfix">
                            <h2 class="bread-title">Submit Property</h2>
                        </div>
                        <ol class="breadcrumb">
                            <li>
                                <a href="/">Home</a>
                            </li> 
                            <li>
                                <span class="active">Property</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section id="main-container" class="container inner">
            <div class="row row-page">
                <div id="main-content" class="main-page col-12 p-0">
                    <div id="main" class="site-main clearfix" role="main">
                        <div data-elementor-type="wp-page" data-elementor-id="1378" class="elementor elementor-1378">
                            <section class="elementor-section elementor-top-section elementor-element elementor-element-646e0249 elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="646e0249" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;}">
                                <div class="elementor-container elementor-column-gap-extended">

                                    <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-e49b43a" data-id="e49b43a" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-9ab82be elementor-widget elementor-widget-shortcode" data-id="9ab82be" data-element_type="widget" data-widget_type="shortcode.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-shortcode">
                                                        <div class="register-form-wrapper">
                                                            <div class="form-login-register-inner">
                                                                <h2 class="title-small">Submit Property</h2>
                                                                <form name="registerForm" method="post" class="form-theme" enctype="multipart/form-data" action="{{ route('property.submit') }}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label>Property Name</label>
                                                                        <input type="text" class="form-control" name="property_name" id="register-username">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Property Location</label>
                                                                        <input type="text" class="form-control" name="location" id="register-email">
                                                                    </div>

                                                                    
                                                                    <div class="form-group">
                                                                        <label>Purpose</label>
                                                                        <select class="form-control" name="status">
                                                                            <option value="">Select Purpose</option>
                                                                            <option value="sale">For Sale</option>
                                                                            <option value="rent">For rent</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Size (sqft)</label>
                                                                        <input type="number" class="form-control" name="size" id="confirmpassword">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Beds</label>
                                                                        <input type="number" class="form-control" name="beds" id="confirmpassword">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Baths</label>
                                                                        <input type="number" class="form-control" name="baths" id="confirmpassword">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Year Built</label>
                                                                        <input type="number" class="form-control" name="year_built" id="confirmpassword">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Garages</label>
                                                                        <input type="number" class="form-control" name="garages" id="confirmpassword">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Lot Area (sqft)</label>
                                                                        <input type="number" class="form-control" name="lot_area" id="confirmpassword">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Type</label>
                                                                        <input type="text" class="form-control" name="type" id="confirmpassword">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Overview (description)</label>
                                                                        <textarea id="comment" class="form-control" name="description" cols="45" rows="5" aria-required="true" required></textarea>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Home Area (sqft)</label>
                                                                        <input type="number" class="form-control" name="home_area" id="confirmpassword">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Lot dimention</label>
                                                                        <input type="text" class="form-control" name="lot_dimension" id="confirmpassword">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Rooms</label>
                                                                        <input type="number" class="form-control" name="rooms" id="confirmpassword">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>price ($)</label>
                                                                        <input type="number" class="form-control" name="price" id="confirmpassword">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Youtube Video url</label>
                                                                        <input type="text" class="form-control" name="youtube_video" id="confirmpassword">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Video Tour Link</label>
                                                                        <input type="text" class="form-control" name="video_tour" id="confirmpassword">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Property Pictures</label>
                                                                        <input type="file" class="form-control" name="picture_url[]" id="confirmpassword" required multiple>
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                    <div class="form-group m-0">
                                                                        <button type="submit" class="btn btn-theme btn-inverse w-100" name="submitRegister">
                                                                            SUBMIT<i class="flaticon-up-right-arrow next"></i>
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
                            </section>
                        </div>
                    </div><!-- .site-main -->
                </div><!-- .content-area -->
            </div>
        </section>
    </div><!-- .site-content -->

@include('visitor.layouts.footer')