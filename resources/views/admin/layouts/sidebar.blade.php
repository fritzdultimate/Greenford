<div class="l-sidebar sidebar-active">
    <div class="l-sidebar__content" style="background: #10133c;">
        <nav class="c-menu js-menu" id="mynavi">
            <ul class="d-block px-1 py-4 d-lg-none">
                <li class="d-flex">
                    <h6 class="text-uppercase">
                        <a href="/admin"> {{ env('SITE_NAME') }} </a>
                    </h6>
                    <a href="#0" class="sm-close btn btn-outline-light" style="position: absolute; top: 5px;right: 5px;">&times;</a>
                </li>
            </ul>
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="fas fa-tachometer-alt"></i></a>
                        <ul class="crm_hover_menu">
                        </ul>
                    </div>
                </li>
                <li class="c-menu__item is-active has-sub crm_navi_icon_cont">
                    <a href="javascript:void(0)">
                        <div class="c-menu-item__title"><span>USER</span>
                        </div>
                    </a>
                    <ul>
                            <li>
                                <a href="/user/"> <i class="fa fa-circle"></i>user dashboard</a>
                            </li>
                    </ul>
                </li>
            </ul>
            <ul class="u-list crm_drop_second_ul list-header">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-four-grid-layout-design-interface-symbol"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="javascript:void(0)">
                        <div class="c-menu-item__title">MAIN</div>
                    </a>
                </li>
            </ul>  
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="fa fa-home"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="/admin">
                        <div class="c-menu-item__title">Home</div>
                    </a>
                </li>
            </ul>  
          
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-movie-tickets"></i></a>
                        <ul class="crm_hover_menu">
                            
                        </ul>
                    </div>
                </li>
                <li class="c-menu__item is-active has-sub crm_navi_icon_cont">
                    <a href="javascript:void(0)">
                        <div class="c-menu-item__title"><span>Deposits</span>
                        </div>
                    </a>
                    <ul>
                         <li><a href="/admin/deposits/pending"><i class="fa fa-circle"></i>Pending deposits</a>
                         </li>
                         <li><a href="/admin/deposits/denied"><i class="fa fa-circle"></i>Denied deposits</a>
                         </li>                      
                         
                         <li><a href="/admin/deposits/approved"><i class="fa fa-circle"></i>Approved deposits</a>
                         </li>
                    
                    </ul>
                </li>
            </ul>
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-movie-tickets"></i></a>
                        <ul class="crm_hover_menu">
                        </ul>
                    </div>
                </li>
                <li class="c-menu__item is-active has-sub crm_navi_icon_cont">
                    <a href="javascript:void(0)">
                        <div class="c-menu-item__title"><span>Withdrawals</span>
                        </div>
                    </a>
                    <ul>
                        <li><a href="/admin/withdrawals/pending"><i class="fa fa-circle"></i>Pending Withdrawals</a>
                        </li>
                        <li><a href="/admin/withdrawals/denied"><i class="fa fa-circle"></i>Denied Withdrawals</a>
                        </li>                      
                        
                        <li><a href="/admin/withdrawals/approved"><i class="fa fa-circle"></i>Approved Withdrawals</a>
                        </li>
                           
                    </ul>
                </li>
            </ul>
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="fa fa-users"></i></a>
                        <ul class="crm_hover_menu">
                        </ul>
                    </div>
                </li>
                <li class="c-menu__item is-active has-sub crm_navi_icon_cont">
                    <a href="javascript:void(0)">
                        <div class="c-menu-item__title"><span>Members</span>
                        </div>
                    </a>
                    <ul>
                        <li><a href="/admin/members"><i class="fa fa-circle"></i>all members</a>
                        </li>
                        <li><a href="/admin/members/suspended"><i class="fa fa-circle"></i>suspended members</a>
                        </li>                      
                    </ul>
                </li>
            </ul>
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="far fa-wallet" aria-hidden="true"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="/admin/wallets">
                        <div class="c-menu-item__title">Wallets</div>
                    </a>
                </li>
            </ul>   
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="far fa-business-time" aria-hidden="true"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="/admin/plans/parent">
                        <div class="c-menu-item__title">Parent Plans</div>
                    </a>
                </li>
            </ul> 
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="far fa-business-time" aria-hidden="true"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="/admin/plans/child">
                        <div class="c-menu-item__title">Child Plans</div>
                    </a>
                </li>
            </ul>     
            <ul class="u-list crm_drop_second_ul list-header">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="fas fa-tasks"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="javascript:void(0)">
                        <div class="c-menu-item__title">ACTIONS</div>
                    </a>
                </li>
            </ul>
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="fas fa-tasks"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="/admin/reviews">
                        <div class="c-menu-item__title">Reviews</div>
                    </a>
                </li>
            </ul>
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-movie-tickets"></i></a>
                        <ul class="crm_hover_menu">
                        </ul>
                    </div>
                </li>
                <li class="c-menu__item is-active has-sub crm_navi_icon_cont">
                    <a href="javascript:void(0)">
                        <div class="c-menu-item__title"><span>Confirm Fund</span>
                        </div>
                    </a>
                    <ul>
                        <li><a href="/admin/fund/confirm-credit"><i class="fa fa-circle"></i>Credit</a>
                        </li>
                        <li><a href="/admin/fund/confirm-debit"><i class="fa fa-circle"></i>Debit</a>
                        </li>                      
                    </ul>
                </li>
            </ul>
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="flaticon-movie-tickets"></i></a>
                        <ul class="crm_hover_menu">
                        </ul>
                    </div>
                </li>
                <li class="c-menu__item is-active has-sub crm_navi_icon_cont">
                    <a href="javascript:void(0)">
                        <div class="c-menu-item__title"><span>Confirm CI</span>
                        </div>
                    </a>
                    <ul>
                        <li><a href="/admin/fund/ci/confirm-credit"><i class="fa fa-circle"></i>Credit</a>
                        </li>
                        <li><a href="/admin/fund/ci/confirm-debit"><i class="fa fa-circle"></i>Debit</a>
                        </li>                      
                    </ul>
                </li>
            </ul>
            
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
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="fas fa-exchange-alt"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="/admin/quick-withdrawal">
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
                    <a href="/admin/manage/wallet-balance">
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
                    <a href="/admin/manage/current-invested">
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
                    <a href="/admin/manage/referral-bonus">
                        <div class="c-menu-item__title">Referral Bonus</div>
                    </a>
                </li>
            </ul>   
            
            <ul class="u-list crm_drop_second_ul list-header">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="fas fa-tasks"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="javascript:void(0)">
                        <div class="c-menu-item__title">PAGES</div>
                    </a>
                </li>
            </ul>
            
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="far fa-copy"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="/admin/pages/faqs">
                        <div class="c-menu-item__title">FaQs</div>
                    </a>
                </li>
            </ul>
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="far fa-copy"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="/admin/pages/about">
                        <div class="c-menu-item__title">About Us</div>
                    </a>
                </li>
            </ul>
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="far fa-copy"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="/admin/pages/how-it-works">
                        <div class="c-menu-item__title">How It Works</div>
                    </a>
                </li>
            </ul> 
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="far fa-copy"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="/admin/pages/meet-our-traders">
                        <div class="c-menu-item__title">Meet Our Traders</div>
                    </a>
                </li>
            </ul>
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="far fa-copy"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="/admin/pages/terms">
                        <div class="c-menu-item__title">Terms & Conditions</div>
                    </a>
                </li>
            </ul>
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="far fa-copy"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="/admin/pages/privacy-policy">
                        <div class="c-menu-item__title">Privacy Policy</div>
                    </a>
                </li>
            </ul> 
            <ul class="u-list crm_drop_second_ul list-header">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="fas fa-tasks"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="javascript:void(0)">
                        <div class="c-menu-item__title">OTHERS</div>
                    </a>
                </li>
            </ul>
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="far fa-copy"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="/admin/files">
                        <div class="c-menu-item__title">Files</div>
                    </a>
                </li>
            </ul> 
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="javascript:void(0)"><i class="fas fa-cog"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="/admin/logout">
                        <div class="c-menu-item__title">logout</div>
                    </a>
                </li>
            </ul>   
        </nav>
    </div>
</div>