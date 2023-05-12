@include('admin.layouts.header')
    <div class="page_title_section dashboard_title">

        <div class="page_header">
            <div class="container">
                <div class="row small">

                    <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7 d-flex align-items-end">
                        <h5 class="text-white static">Meet Our Traders</h5>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li> <a href="#"> Admin </a>&nbsp; / &nbsp; </li>
                                <li>Meet Our Traders</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- inner header wrapper end -->
	@include('admin.layouts.sidebar')
        <!-- Main section Start -->
        <div class="l-main pt-lg-5 mt-lg-5 mb-lg-5">         
            <div class="d-none d-lg-block">
                <br><br><br>
            </div>
            <div class="plan_investment_wrapper float_left my-lg-2">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                        <div class="sv_heading_wraper">

                            <h4 class="text-light">Meet Our Traders</h4>

                        </div>

                    </div>
                    <div class="col-12">
                        
                        <div class="row">
                            <div class="col-12  p-5 mb-5">
                                <div align="center">
                                    <form class='page-form settings-form' action="our-traders">
                                        <textarea class="editable w-100" name="meet_our_traders">{{ $meet_our_traders }}</textarea>
                                        <div>
                                            <button class="btn btn-warning w-100 input-rounded" type="submit">
                                                <span class="form-loading d-none px-5">
                                                    <i class="fa fa-sync fa-spin"></i>
                                                </span>
                                                <span class='submit-text'>
                                                    submit
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>
            
            @include('admin.layouts.footer')
         </div>
       <!--  footer  wrapper end -->      
    <!-- main box wrapper End-->
    @include('admin.layouts.general-scripts')
    <script src="{{ asset('dash/jquery-te/jquery-te.min.js') }}"></script>
    <script src="{{ asset('dash/plugins/lobibox/js/lobibox.js') }}"></script>
    <script src="{{ asset('dash/plugins/blockUi/jquery.blockUi.js') }}"></script>
    <script src="{{ asset('dash/js/fn.js') }}"></script>
    <script src="{{ asset('dash/js/admin.settings.js') }}"></script>
    <script>
        $("textarea").jqte();
    </script>
    <!--main js file end-->
</body>

</html>