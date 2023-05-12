@include('admin.layouts.header')
    <div class="page_title_section dashboard_title">

        <div class="page_header">
            <div class="container">
                <div class="row small">

                    <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7 d-flex align-items-end">
                        <h5 class="text-white static">Quick Withdrawal</h5>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li> <a href="#"> Admin </a>&nbsp; / &nbsp; </li>
                                <li>Quick Withdrawal</li>
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

                            <h4 class="text-light">Quick Withdrawal</h4>

                        </div>

                    </div>
                    <div class="col-12">
                        
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-12 col-md-8 page-content p-5 mb-5">
                                <div align="center">
                                        <div class="change_pass_field float_left">	
                                            <form class="page-form withdrawal-form">	
                                                <div class="form-group change_field">
                                                    <label>User</label>
                                                        <input type="text" name="name" placeholder="Name">
                                                </div>
                                                <div class="form-group change_field">
                                                    <label>Email</label>
                                                        <input type="email" name="email" placeholder="Email">
                                                </div>
                                                <div class="form-group change_field">
                                                    <label>Amount</label>
                                                    <input type="text" name="amount" placeholder="Amount">
                                                </div>
                                                <div class="form-group change_field">
                                                    <label>Wallet Address</label>
                                                    <input type="text" name="wallet_address" placeholder="Wallet Address">
                                                </div>
                                                <div class="form-group change_field">
                                                    <label>Transaction Batch</label>
                                                    <input type="text" name="transaction_batch" placeholder="Transaction Batch">
                                                </div>
                                                <div class="form-group change_field">
                                                    <label>Withdrawal Date</label>
                                                    <input type="datetime-local" name="date" id="withdrawal_date">
                                                </div>
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
                            <div class="col-2"></div>
                        </div>
                        
                    </div>
                </div>

            </div>
            
            @include('admin.layouts.footer')
         </div>
       <!--  footer  wrapper end -->      
    <!-- main box wrapper End-->
    @include('admin.layouts.general-scripts')
    
    <script src="{{ asset('dash/plugins/lobibox/js/lobibox.js') }}"></script>
    <script src="{{ asset('dash/plugins/blockUi/jquery.blockUi.js') }}"></script>
    <script src="{{ asset('dash/js/fn.js') }}"></script>
    <script src="{{ asset('dash/js/admin.quick-withdrawal.js?a=3') }}"></script>
    <!--main js file end-->
</body>

</html>