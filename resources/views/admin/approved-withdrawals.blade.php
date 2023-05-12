@include('admin.layouts.header')
    <div class="page_title_section dashboard_title">
        <div class="page_header">
            <div class="container">
                <div class="row small">

                    <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7 d-flex align-items-end">
                        <h5 class="text-white static">Approved Withdrawals</h5>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li> <a href="#"> Admin </a>&nbsp; / &nbsp; </li>
                                <li>Approved Withdrawals</li>
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
                <br><br><br>
            </div>
            <div class="deposit_list_wrapper float_left">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                        <div class="sv_heading_wraper">
                            <h3>approved withdrawals</h3>
                        </div>
                    </div>
                </div>
                <div class="crm_customer_table_main_wrapper withdrawal_tables float_left">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                            <div class="tab-content">
                                <div id="home" class="tab-pane active">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="table-responsive">
                                                <table class="record-table table datatables cs-table crm_customer_table_inner_Wrapper">
                                                    <thead>
                                                        <tr>
                                                            <th class="width_table1">user</th>
                                                            <th class="width_table1">wallet</th>
                                                            <th class="width_table1">wallet Address</th>
                                                            <th class="width_table1">memo Token</th>
                                                            <th class="width_table1">amount</th>
                                                            <th class="width_table1">status</th>
                                                            <th class="width_table1">date</th>
                                                            <th class="width_table1">action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($withdrawals as $withdrawal)
                                                        <tr class="background_white">

                                                            <td>
                                                                <div class="media cs-media">

                                                                    <div class="media-body">
                                                                        <h5>{{ $withdrawal->user->name }}</h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="media cs-media">

                                                                    <div class="media-body">
                                                                        <h5>{{ $withdrawal->user_wallet->admin_wallet->currency }}</h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="pretty p-svg p-curve">{{ $withdrawal->user_wallet->currency_address }} </div>                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="media cs-media">
                                                                    <div class="media-body">
                                                                        <h5>{{ $withdrawal->user_wallet->has_memo ? $withdrawal->user_wallet->memo_token ?? 'Empty' : 'No memo' }}</h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="pretty p-svg p-curve">${{ $withdrawal['amount'] }}</div>
                                                            </td>
                                                            <td>
                                                                <div class="pretty p-svg p-curve deposit_active">{{ $withdrawal['status'] }}</div>
                                                            </td>
                                                            <td>
                                                                <div class="pretty p-svg p-curve">{{ $withdrawal['created_at'] }}</div>
                                                            </td>

                                                            <td>
                                                                <nav class="navbar navbar-expand">
                                                                    <ul class="navbar-nav">
                                                                        <!-- Dropdown -->
                                                                        <li class="nav-item dropdown">
                                                                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu">
                                                                                <a data-action="delete" data-id="{{ $withdrawal['id'] }}" class="action-link dropdown-item" href="#">Delete</a>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </nav>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            <script src="{{ asset('dash/js/admin.withdrawals.js') }}"></script>
</body>

</html>