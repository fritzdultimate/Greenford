@include('user.layouts.header')
    <div class="page_title_section dashboard_title">

        <div class="page_header">
            <div class="container">
                <div class="row small">

                    <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7 d-flex align-items-end">
                        <h5 class="text-white static">Deposit </h5>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li> <a href="#"> Home </a>&nbsp; / &nbsp; </li>
                                <li>Deposit</li>
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
         <div class="l-main pt-lg-5 my-lg-5">
            <div class="d-none d-lg-block">
                <br><br><br>
            </div>
            <div class="plan_investment_wrapper float_left my-lg-2" data-wallet="{{ $wallets->count() }}">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                        <div class="sv_heading_wraper">

                            <h3>plan details</h3>

                        </div>

                    </div>
                    @foreach ($plans as $plan)
                    <div class="col-xl-3 col-md-6 col-lg-6 col-sm-6 col-12">
                        <div class="investment_box_wrapper sv_pricing_border float_left height_box">
                            <div class="investment_icon_circle parpal_color">
                                <i class="flaticon-movie-tickets"></i>
                            </div>
                            <div class="investment_border_wrapper"></div>
                            <div class="investment_content_wrapper">
                                <h1><a href="#">{{ $plan['name'] }} plan</a></h1>
                                <p>Min Amount: ${{ $plan['minimum_amount'] }}
                                    <br>Max Amount : ${{ $plan['maximum_amount'] }}

                                    <br> Up to {{ $plan['interest_rate'] }} % daily for {{ $plan['duration'] }} days
                                    <br> Principal Return
                                    <br> Compound Available</p>
                            </div>
                            <div class="about_btn plans_btn bg_btn_color">
                                <ul>
                                    <li>
                                        <a data-return="{{ $plan['interest_rate'] }}" 
                                        data-child_plan_id="{{ $plan['id'] }}" data-plan="{{ $plan['id'] }}" 
                                        data-min="{{ $plan['minimum_amount'] }}" data-max="{{ $plan['maximum_amount'] }}" class="deposit-btn" href="#">Deposit</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            <div class="modal fade" id="deposit-modal">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Deposit To Plan</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <div class="modal-body">
                        <form class="page-form deposit-form" action="">
                            <div class="form-group icon_form comments_form">
                                <div class="payment_gateway_wrapper w-100 plan-wrapper">
                                    <select required class="select-plan w-100" name="child_plan_id" id="select-plan">
                                        <option data-display="Select Plan">Select Plan</option>
                                        @foreach ($plans as $plan)
                                        <option data-return="{{ $plan['interest_rate'] }}" 
                                        data-child_plan_id="{{ $plan['id'] }}" data-plan="{{ $plan['id'] }}" 
                                        data-min="{{ $plan['minimum_amount'] }}" data-max="{{ $plan['maximum_amount'] }}" value="{{ $plan['id'] }}">{{ $plan['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group icon_form comments_form">
                                <input required type="number" class="form-control require" name="amount" placeholder="Enter Amount">
                            </div>
                            <div class="form-group icon_form comments_form">
                                <div class="payment_gateway_wrapper w-100">
                                    <select required class="w-100" name="user_wallet_id">
                                        <option data-display="Select Currency">Select Currency</option>
                                        @foreach ($wallets as $wallet)
                                        <option value="{{ $wallet['id'] }}" data-symbol="{{ $wallet->admin_wallet->currency_symbol }}">{{ $wallet->admin_wallet->currency }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-dark rounded-btn w-100">
                                    <span class="form-loading d-none px-5">
                                        <i class="fa fa-sync fa-spin"></i>
                                    </span>
                                    <span class='submit-text'>
                                        Make Deposit
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    
                  </div>
                </div>
            </div>

            <div class="modal fade" id="success-modal">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-uppercase"><b class="text-uppercase deposit-wallet"></b> DEPOSIT</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body font-weight-bold">
                            <div align="center"> Deposit exactly <b class="text-warning deposit-amount">$0.9999</b> <b class="text-uppercase deposit-wallet"></b></div>
                            <div align="center" class="py-2">
                                Scan Wallet Address
                            </div>
                            <div align="center">
                                <div class="d-inline-flex p-1 border wallet-qrcode"></div>
                            </div>
                            <div align="center" class="py-2">
                                or copy From Input
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" id="clip-input" class="clip-input form-control" value="wallet address">
                                <div class="input-group-append">
                                    <button data-clipboard-target="#clip-input" class="clipboard-btn btn btn-dark" type="submit">
                                        <i class="fa fa-clipboard"></i>
                                    </button>
                                </div>
                            </div>
                            <div class='memo-cont'>
                                <div align="center">
                                    Wallet memo
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="memo-input" class="memo-input form-control" value="wallet address">
                                    <div class="input-group-append">
                                        <button data-clipboard-target="#memo-input" class="clipboard-btn btn btn-dark" type="submit">
                                            <i class="fa fa-clipboard"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div align="center" class="text-success small border border-success mx-4 bg-light">
                                NB : Contact support immediately After Your Payment
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    <script src="{{ asset('dash/plugins/qrcode/qrcode.min.js') }}"></script>
    <script src="{{ asset('dash/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('dash/js/fn.js') }}"></script>
    <script src="{{ asset('dash/js/deposit.js') }}"></script>
</body>

</html>