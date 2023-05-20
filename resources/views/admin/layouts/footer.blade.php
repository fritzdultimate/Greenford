

    <!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <!-- profile box -->
                    <div class="profileBox pt-2 pb-2">
                        <div class="image-wrapper">
                            <img src="{{$user_settings->profile_image_url ? asset($user_settings->profile_image_url) : asset('app_assets/img/sample/avatar/avatar1.png') }}" alt="image" class="imaged  w36">
                        </div>
                        <div class="in">
                            <strong>{{ $user->fullname }}</strong>
                            <div class="text-muted">Admin, welcome back.</div>
                        </div>
                        <a href="#" class="btn btn-link btn-icon sidebar-close" data-bs-dismiss="modal">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                    </div>
                    <!-- * profile box -->

                    <!-- others -->
                    <ul class="listview flush transparent no-line image-listview">
                        <li>
                            <a href="/admin/members" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="person-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Members
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/edit/transactions" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="create-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Edit Transactions
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/edit/cards" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="create-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Edit Cards
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/credit" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="arrow-up-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Credit Account
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/debit" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Debit Account
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/upgrade/kyc" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="settings-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    KYC
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/user/logout" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Log out
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- * others -->
                </div>
            </div>
        </div>
    </div>
    <!-- * App Sidebar -->


    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="{{ asset('app_assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="{{ asset('app_assets/js/plugins/splide/splide.min.js') }}"></script>
    <!-- Base Js File -->
    <script src="{{ asset('app_assets/js/base.js') }}" defer></script>

    <script>
        // Add to Home with 2 seconds delay.
        // AddtoHome("2000", "once");
    </script>

</body>
</html>