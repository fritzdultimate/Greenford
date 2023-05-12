@include('admin.layouts.header')
    <div class="page_title_section dashboard_title">
        <div class="page_header">
            <div class="container">
                <div class="row small">

                    <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7 d-flex align-items-end">
                        <h5 class="text-white static">Dashboard</h5>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li> <a href="#"> Admin </a>&nbsp; / &nbsp; </li>
                                <li>Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- inner header wrapper end -->
	@include('admin.layouts.sidebar')
         <div class="l-main pt-lg-5 mt-lg-5">             
            <div class="d-none d-lg-block">
                <br><br>
            </div>
            <div class="account_wrapper pt-lg-5 mt-lg-5 float_left">
                <div class="account_overlay"></div>
                <!-- <br><br> -->
               
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                        <div class="sv_heading_wraper">

                            <h3>Admin Dashboard</h3>

                        </div>
                      
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="investment_box_wrapper user-account-info-box float_left d-flex flex-column justify-content-center align-items-center">
                                <div class="investment_icon_wrapper float_left">
                                    <i class="fa fa-users"></i>
                                    <h5 class="font-weight-bold text-ligh">Total Member</h5>
                                </div>
                                <div class="invest_details float_left">
                                    <table class="invest_table">
                                        <tbody>
                                            <tr>
                                                <td class="invest_td1"> 
                                                    <h5 class="text-info">{{$total_users}} </h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="investment_box_wrapper user-account-info-box float_left d-flex flex-column justify-content-center align-items-center">
                                <div class="investment_icon_wrapper float_left">
                                    <i class="far fa-money-bill-alt"></i>
                                    <h5 class="font-weight-bold text-ligh">Currently Invested</h5>
                                </div>
                                <div class="invest_details float_left">
                                    <table class="invest_table">
                                        <tbody>
                                            <tr>
                                                <td class="invest_td1"> 
                                                    <h5 class="text-info"> ${{ $currently_invested }}</h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="investment_box_wrapper user-account-info-box float_left d-flex flex-column justify-content-center align-items-center">
                                <div class="investment_icon_wrapper float_left">
                                    <i class="far fa-money-bill-alt"></i>
                                    <h5 class="font-weight-bold text-ligh">Total Deposited</h5>
                                </div>
                                <div class="invest_details float_left">
                                    <table class="invest_table">
                                        <tbody>
                                            <tr>
                                                <td class="invest_td1"> 
                                                    <h5 class="text-info">${{ $total_deposited }} </h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="investment_box_wrapper user-account-info-box float_left d-flex flex-column justify-content-center align-items-center">
                                <div class="investment_icon_wrapper float_left">
                                    <i class="fas fa-chart-line    "></i>
                                    <h5 class="font-weight-bold text-ligh">Pending Deposit</h5>
                                </div>
                                <div class="invest_details float_left">
                                    <table class="invest_table">
                                        <tbody>
                                            <tr>
                                                <td class="invest_td1"> 
                                                    <h5 class="text-info"> {{ $pending_deposits }} </h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="investment_box_wrapper user-account-info-box float_left d-flex flex-column justify-content-center align-items-center">
                                <div class="investment_icon_wrapper float_left">
                                    <i class="far fa-money-bill-alt"></i>
                                    <h5 class="font-weight-bold text-ligh">Total Withdrawn</h5>
                                </div>
                                <div class="invest_details float_left">
                                    <table class="invest_table">
                                        <tbody>
                                            <tr>
                                                <td class="invest_td1"> 
                                                    <h5 class="text-info"> ${{ $total_withdrawn }} </h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="investment_box_wrapper user-account-info-box float_left d-flex flex-column justify-content-center align-items-center">
                                <div class="investment_icon_wrapper float_left">
                                    <i class="fas fa-chart-bar    "></i>
                                    <h5 class="font-weight-bold text-ligh">Pending Withdrawal</h5>
                                </div>
                                <div class="invest_details float_left">
                                    <table class="invest_table">
                                        <tbody>
                                            <tr>
                                                <td class="invest_td1"> 
                                                    <h5 class="text-info"> {{$pending_withdrawals}} </h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="investment_box_wrapper user-account-info-box float_left d-flex flex-column justify-content-center align-items-center">
                                <div class="investment_icon_wrapper float_left">
                                    <i class="fas fa-chart-pie"></i>
                                    <h5 class="font-weight-bold text-ligh">Running Investments</h5>
                                </div>
                                <div class="invest_details float_left">
                                    <table class="invest_table">
                                        <tbody>
                                            <tr>
                                                <td class="invest_td1"> 
                                                    <h5 class="text-info"> {{ $running_investments }}</h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="investment_box_wrapper user-account-info-box float_left d-flex flex-column justify-content-center align-items-center">
                                <div class="investment_icon_wrapper float_left">
                                   <i class="fas fa-money-bill-wave-alt"></i>
                                    <h5 class="font-weight-bold text-ligh">Total Paid</h5>
                                </div>
                                <div class="invest_details float_left">
                                    <table class="invest_table">
                                        <tbody>
                                            <tr>
                                                <td class="invest_td1"> 
                                                    <h5 class="text-info">${{ $total_paid }}</h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="last_transaction_wrapper float_left">

                <div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                        <div class="sv_heading_wraper">

                            <h3>NEWSLETTER</h3>

                        </div>
                    </div>
                    <div class="col-12">
                        
                        <div class="page-content h-100">
                            <div align="right">
                                <button class="btn btn-info btn-rounded toggleSelectBtn">select all users</button>
                            </div>
                            <form class="page-form news-form" action="">
                                @csrf
                                <div class="form-group icon_form comments_form">
                                    <label for="users">Users</label>
                                    <!--<div class="payment_gateway_wrapper w-100">-->
                                        <select multiple class="form-control plain select-plan w-100" name="receivers[]">
                                                @foreach($users as $user)
                                                    <option data-balance="{{ $user['deposit_balance'] }}" value="{{ $user['email'] }}">{{ $user['name'] }}</option>
                                                @endforeach
                                            </select> 
                                        
                                    <!--</div>-->
                                </div>
                                <div class="form-group icon_form comments_form">
                                    <label for="subject">Subject</label>
                                    <input required type="text" class="form-control require" name="subject" placeholder="Enter Subject">
                                </div>
                                <div class="form-group icon_form comments_form">
                                            <label for="message">Content</label>
                                            <textarea id="message" name="message" rows="10" style="width:100%"></textarea>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-dark rounded-btn w-100">
                                        <span class="form-loading d-none px-5">
                                            <i class="fa fa-sync fa-spin"></i>
                                        </span>
                                        <span class='submit-text'>
                                            Send NewsLetter
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
            @include('admin.layouts.footer')
         </div>
            @include('user.layouts.general-scripts')
            <script src="{{ asset('dash/plugins/lobibox/js/lobibox.js') }}"></script>
            <script src="{{ asset('dash/plugins/blockUi/jquery.blockUi.js') }}"></script>
            <script src="{{ asset('dash/js/fn.js') }}"></script>
            <script src="{{ asset('dash/js/admin.index.js?n=13') }}"></script>
</body>

</html>