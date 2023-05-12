@include('user.layouts.header')
    <div class="page_title_section dashboard_title">

        <div class="page_header">
            <div class="container">
                <div class="row small">

                    <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7 d-flex align-items-end">
                        <h5 class="text-white static">My Account </h5>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li> <a href="#"> Home </a>&nbsp; / &nbsp; </li>
                                <li>My Account</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- inner header wrapper end -->
	@include('user.layouts.sidebar')
        <!-- Main section Start -->
        <div class="l-main pt-lg-5 mt-lg-5 mb-lg-5">         
            <div class="d-none d-lg-block">
                <br><br><br>
            </div>
            <div class="plan_investment_wrapper float_left my-lg-2">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                        <div class="sv_heading_wraper">

                            <h4 class="text-light">Account Security</h4>

                        </div>

                    </div>
                    <div class="col-12">
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="sv_heading_wraper heading_center mb-3">

                                    <h5 class="text-light">change password</h5>
        
                                </div>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-12 col-md-8 page-content p-5 mb-5">
                                <div align="center">
                                    
                                        <div class="change_pass_field float_left">	
                                            <form class="page-form security-form">				 
                                                <div class="change_field">
                                                    <label>Current  password :</label>
                                                    <input type="password" name="password" placeholder="**********">
                                                </div>
                                                <div class="change_field">
                                                    <label>new  password :</label>
                                                    <input type="password" name="password" placeholder="**********">
                                                </div>
                                                <div class="change_field">
                                                    <label>confirm new  password :</label>
                                                    <input type="password" name="password" placeholder="**********">
                                                </div>
                                                <div>
                                                    <button class="btn btn-warning w-100 input-rounded" type="submit">
                                                        <span class="form-loading d-none px-5">
                                                            <i class="fa fa-sync fa-spin"></i>
                                                        </span>
                                                        <span class='submit-text'>
                                                            Change Password
                                                        </span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                   
                                </div>
                            </div>
                            <div class="col-2"></div>
                        </div>
                        
                    </div>
                </div>

            </div>
            
            @include('user.layouts.footer')
         </div>
       <!--  footer  wrapper end -->      
    <!-- main box wrapper End-->
    @include('user.layouts.general-scripts')
    <script src="{{ asset('dash/plugins/lobibox/js/lobibox.js') }}"></script>
    <script src="{{ asset('dash/js/fn.js') }}"></script>
    <script src="{{ asset('dash/js/security.js') }}"></script>
    <!--main js file end-->
</body>

</html>