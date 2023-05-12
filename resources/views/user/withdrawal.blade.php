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
         <div class="l-main pt-lg-5 my-lg-5">
            <div class="d-none d-lg-block">
                <br><br><br>
            </div>
            <div class="plan_investment_wrapper float_left my-lg-2" data-wallet="{{ $wallets->count() }}">
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="investment_box_wrapper user-account-info-box float_left d-flex flex-column justify-content-center align-items-center">
                                <div class="investment_icon_wrapper float_left">
                                    <i class="far fa-money-bill-alt"></i>
                                    <h5 class="text-whit font-weight-bold">Current Balance</h5>
                                </div>
                                <div class="invest_details float_left">
                                    <table class="invest_table">
                                        <tbody>
                                            <tr>
                                                <td class="invest_td1"> 
                                                    <h5 class="text-info">    ${{ $user['deposit_balance'] }} </h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-12">
                        <div class="investment_box_wrapper user-account-info-box float_left d-flex flex-column justify-content-center align-items-center">
                                <div class="investment_icon_wrapper float_left">
                                    <i class="far fa-money-bill-alt"></i>
                                    <h5 class="text-whit font-weight-bold">Total Withdrawal</h5>
                                </div>
                                <div class="invest_details float_left">
                                    <table class="invest_table">
                                        <tbody>
                                            <tr>
                                                <td class="invest_td1"> 
                                                    <h5 class="text-info">    ${{ $user['total_withdrawn'] }} </h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                        <div class="sv_heading_wraper">

                            <h3>Withdraw Earnings</h3>

                        </div>

                    </div>
                    <div class="col-12">
                        
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-12 col-md-8 page-content p-5 mb-5">
                                <form class="page-form withdrawal-form" action="">
                                    <div class="form-group icon_form comments_form">
                                        <input required type="number" class=" form-control require input-rounded" name="amount" placeholder="Enter Amount">
                                    </div>
                                    <div class="form-group icon_form comments_form">
                                        <div class="payment_gateway_wrapper w-100">
                                            <select required class="w-100 text-light" name="user_wallet_id">
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
                                                Make Withdrawal
                                            </span>
                                        </button>
                                    </div>
                                </form>
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
    <script src="{{ asset('dash/plugins/qrcode/qrcode.min.js') }}"></script>
    <script src="{{ asset('dash/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('dash/js/fn.js') }}"></script>
    <script src="{{ asset('dash/js/user.withdrawal.js') }}"></script>
</body>

</html>