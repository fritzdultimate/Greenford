@include('admin.layouts.header')
    <div class="page_title_section dashboard_title">
        <div class="page_header">
            <div class="container">
                <div class="row small">

                    <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7 d-flex align-items-end">
                        <h5 class="text-white static">Suspended Members</h5>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li> <a href="#"> Admin </a>&nbsp; / &nbsp; </li>
                                <li>Suspended Members</li>
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
                            <h3>Site Suspended Members</h3>
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
                                                            <th class="width_table1">username</th>
                                                            <th class="width_table1">is admin</th>
                                                            <th class="width_table1">email</th>
                                                            <th class="width_table1">firstname</th>
                                                            <th class="width_table1">middlename</th>
                                                            <th class="width_table1">lastname</th>
                                                            <th class="width_table1">invested</th>
                                                            <th class="width_table1">current invested</th>
                                                            <th class="width_table1">deposit balance</th>
                                                            <th class="width_table1">referral bonus</th>
                                                            <th class="width_table1">total withdrawn</th>
                                                            <th class="width_table1">Reg Date</th>
                                                            <th class="width_table1">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($users as $user)
                                                        <tr class="background_white">

                                                            <td>
                                                                <div class="media cs-media">

                                                                    <div class="media-body">
                                                                        <h5>{{ $user['name'] }}</h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="media cs-media">

                                                                    <div class="media-body">
                                                                        <h5>{{ $user['is_admin'] ? 'True' : 'False'}}</h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="media cs-media">

                                                                    <div class="media-body">
                                                                        <h5>{{ $user['email'] }}</h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="media cs-media">

                                                                    <div class="media-body">
                                                                        <h5>{{ $user['firstname'] }}</h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="media cs-media">

                                                                    <div class="media-body">
                                                                        <h5>{{ $user['middlename'] }}</h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="media cs-media">

                                                                    <div class="media-body">
                                                                        <h5>{{ $user['lastname'] }}</h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="media cs-media">

                                                                    <div class="media-body">
                                                                        <h5>{{ $user['invested'] ? 'True' : 'False'}}</h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="pretty p-svg p-curve">${{ $user['currently_invested'] }}</div>                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="pretty p-svg p-curve">${{ $user['deposit_balance'] }}</div>                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="pretty p-svg p-curve">${{ $user['referral_bonus'] }}</div>                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="pretty p-svg p-curve">${{ $user['total_withdrawn'] }}</div>                                                                </div>
                                                            </td>
                                                            
                                                            <td>
                                                                <div class="pretty p-svg p-curve">{{ $user['created_at'] }}</div>
                                                            </td>

                                                            <td>
                                                                <nav class="navbar navbar-expand">
                                                                    <ul class="navbar-nav">
                                                                        <li class="nav-item dropdown">
                                                                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu">
                                                                                <a data-action="toggleSuspend" data-to="unsuspend" data-id="{{ $user['id'] }}" class="action-link dropdown-item text-capitalize" href="#">unsuspend User</a>                                                                                
                                                                                <a data-action="delete" data-id="{{ $user['id'] }}" class="action-link dropdown-item text-capitalize" href="#">Delete</a>
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
            <script src="{{ asset('dash/js/admin.members.js') }}"></script>
</body>

</html>