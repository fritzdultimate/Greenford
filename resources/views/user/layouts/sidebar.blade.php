<div class="l-sidebar sidebar-active">
            <div class="l-sidebar__content" style="background: #10133c;">
                <nav class="c-menu js-menu" id="mynavi">
                    <ul class="d-block px-1 py-4 d-lg-none">
                        <li class="d-flex">
                            <h6 class="text-uppercase">
                                <a href="/user" style="color: #fff">{{ env('SITE_NAME') }} </a>
                            </h6>
                            <a href="#0" class="sm-close btn btn-outline-light" style="position: absolute; top: 5px;right: 5px;">&times;</a>
                        </li>
                    </ul>

                    @if ($user['is_admin'])
                    <ul class="u-list crm_drop_second_ul">
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-progress-report"></i></a>
                            </div>
                        </li>
                        <li class="c-menu__item crm_navi_icon_cont">
                            <a href="/admin">
                                <div class="c-menu-item__title">Admin Dashboard</div>
                            </a>
                        </li>
                    </ul>  
                    @endif

                    <ul class="u-list crm_drop_second_ul">
                       
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="ti-layout-grid4-alt"></i></a>
                                <ul class="crm_hover_menu">
                                </ul>
                            </div>
                        </li>
                        <li class="c-menu__item is-active has-sub crm_navi_icon_cont">
                            <a href="javascript:void(0)">
                                <div class="c-menu-item__title"><span>Dashboard</span>
                                </div>
                            </a>
                            <ul>
                                 <li><a href="/user"><i class="fa fa-circle"></i>Home</a>
                                 </li>
                                 <li><a href="/user/profile"><i class="fa fa-circle"></i> my profile</a>
                                 </li> 
                                                       
                                 <li><a href="/user/security"><i class="fa fa-circle"></i>change password</a>
                                 </li>
							
                            </ul>
                        </li>
                    </ul>
                    <ul class="u-list crm_drop_second_ul">
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="fas fa-wallet"></i></a>
                            </div>
                        </li>
                        <li class="c-menu__item crm_navi_icon_cont">
                            <a href="/user/wallets">
                                <div class="c-menu-item__title">Wallets</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="u-list crm_drop_second_ul">
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-movie-tickets"></i></a>
                            </div>
                        </li>
                        <li class="c-menu__item crm_navi_icon_cont">
                            <a href="/user/deposit">
                                <div class="c-menu-item__title">Deposit</div>
                            </a>
                        </li>
                    </ul>
                     <ul class="u-list crm_drop_second_ul">
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-movie-tickets"></i></a>
                            </div>
                        </li>
                        <li class="c-menu__item crm_navi_icon_cont">
                            <a href="/user/reinvest">
                                <div class="c-menu-item__title">Reinvest</div>
                            </a>
                        </li>
                    </ul>
                     <ul class="u-list crm_drop_second_ul">
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-movie-tickets"></i></a>
                            </div>
                        </li>
                        <li class="c-menu__item crm_navi_icon_cont">
                            <a href="/user/withdrawal">
                                <div class="c-menu-item__title">Withdrawal</div>
                            </a>
                        </li>
                    </ul>
                    
                    <ul class="u-list crm_drop_second_ul d-none">
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="transfer_fund.html"><i class="flaticon-progress-report"></i></a>
                            </div>
                        </li>
                        <li class="c-menu__item crm_navi_icon_cont">
                            <a href="transfer_fund.html">
                                <div class="c-menu-item__title">fund transfer</div>
                            </a>
                        </li>
                    </ul>         
                    <ul class="u-list crm_drop_second_ul">
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-help"></i></a>
                                <ul class="crm_hover_menu">
                                 
                                </ul>
                            </div>
                        </li>
                        <li class="c-menu__item is-active has-sub crm_navi_icon_cont">
                            <a href="javascript:void(0)">
                                <div class="c-menu-item__title"><span>Records</span>
                                </div>
                            </a>
                            <ul>
                              <li><a href="/user/transactions"><i class="fa fa-circle"></i> all transactions</a>
                                    </li>
                                    <li><a href="/user/deposits"><i class="fa fa-circle"></i>deposit history</a>
                                    </li>
                                    <li><a href="/user/reinvestments"><i class="fa fa-circle"></i>reinvestment history</a>
                                    </li>
									 <li><a href="/user/withdrawals"><i class="fa fa-circle"></i>withdrawal history</a>
                                    </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="u-list crm_drop_second_ul">
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-profile"></i></a>
                            </div>
                        </li>
                        <li class="c-menu__item crm_navi_icon_cont">
                            <a href="/user/referrals">
                                <div class="c-menu-item__title">Referrals</div>
                            </a>
                        </li>
                    </ul>
                    @if ($user['permission'] == '2')
                    <ul class="u-list crm_drop_second_ul list-header">
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="fas fa-tasks"></i></a>
                            </div>
                        </li>
                        <li class="c-menu__item crm_navi_icon_cont">
                            <a href="javascript:void(0)">
                                <div class="c-menu-item__title">MANAGE</div>
                            </a>
                        </li>
                    </ul> 
                    <ul class="u-list crm_drop_second_ul">
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-movie-tickets" aria-hidden="true"></i></a>
                            </div>
                        </li>
                        <li class="c-menu__item crm_navi_icon_cont">
                            <a href="/user/manage/quick-withdrawal">
                                <div class="c-menu-item__title">Quick Withdrawal</div>
                            </a>
                        </li>
                    </ul>   
                    <ul class="u-list crm_drop_second_ul">
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-movie-tickets" aria-hidden="true"></i></a>
                            </div>
                        </li>
                        <li class="c-menu__item crm_navi_icon_cont">
                            <a href="/user/manage/wallet-balance">
                                <div class="c-menu-item__title">Wallet Balance</div>
                            </a>
                        </li>
                    </ul>   
                    <ul class="u-list crm_drop_second_ul">
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-movie-tickets" aria-hidden="true"></i></a>
                            </div>
                        </li>
                        <li class="c-menu__item crm_navi_icon_cont">
                            <a href="/user/manage/current-invested">
                                <div class="c-menu-item__title">Currently Invested</div>
                            </a>
                        </li>
                    </ul>   
                    <ul class="u-list crm_drop_second_ul">
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-movie-tickets" aria-hidden="true"></i></a>
                            </div>
                        </li>
                        <li class="c-menu__item crm_navi_icon_cont">
                            <a href="/user/manage/referral-bonus">
                                <div class="c-menu-item__title">Referral Bonus</div>
                            </a>
                        </li>
                    </ul>   
                    @endif
					  <ul class="u-list crm_drop_second_ul">
                        <li class="crm_navi_icon">
                            <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-profile"></i></a>
                            </div>
                        </li>
                        <li class="c-menu__item crm_navi_icon_cont">
                            <a href="/user/logout">
                                <div class="c-menu-item__title">logout</div>
                            </a>
                        </li>
                    </ul>   
                </nav>
            </div>
        </div>