<!-- App Bottom Menu -->
<div class="appBottomMenu">
        <a href="/user" class="item active">
            <div class="col">
                <ion-icon name="pie-chart-outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="/user/transactions" class="item">
            <div class="col">
                <ion-icon name="document-text-outline"></ion-icon>
                <strong>Transactions</strong>
            </div>
        </a>
        <a href="/user/savings" class="item">
            <div class="col">
                <ion-icon name="apps-outline"></ion-icon>
                <strong>Savings</strong>
            </div>
        </a>
        <a href="/user/cards" class="item">
            <div class="col">
                <ion-icon name="card-outline"></ion-icon>
                <strong>My Cards</strong>
            </div>
        </a>
        <a href="/user/settings" class="item">
            <div class="col">
                <ion-icon name="settings-outline"></ion-icon>
                <strong>Settings</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->

    <!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <!-- profile box -->
                    <div class="profileBox pt-2 pb-2">
                        <div class="image-wrapper">
                            <img src="{{ asset('app/img/sample/avatar/avatar1.jpg') }}" alt="image" class="imaged  w36">
                        </div>
                        <div class="in">
                            <strong>{{ $user->fullname }}</strong>
                            <div class="text-muted">{{ $user_account->account_number }}</div>
                        </div>
                        <a href="#" class="btn btn-link btn-icon sidebar-close" data-bs-dismiss="modal">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                    </div>
                    <!-- * profile box -->
                    <!-- balance -->
                    <div class="sidebar-balance">
                        <div class="listview-title">Balance</div>
                        <div class="in">
                            <h1 class="amount">$ {{ number_format($user_account->account_balance, 2) }}</h1>
                        </div>
                    </div>
                    <!-- * balance -->

                    <!-- action group -->
                    <div class="action-group">
                        <a href="#" class="action-button" data-bs-toggle="modal" data-bs-target="#withdrawActionSheet">
                            <div class="in">
                                <div class="iconbox">
                                    <ion-icon name="add-outline"></ion-icon>
                                </div>
                                Save
                            </div>
                        </a>
                        <a href="#" class="action-button" data-bs-toggle="modal" data-bs-target="#sendActionSheet">
                            <div class="in">
                                <div class="iconbox">
                                    <ion-icon name="arrow-down-outline"></ion-icon>
                                </div>
                                Transfer
                            </div>
                        </a>
                        <a href="#" class="action-button" data-bs-toggle="modal" data-bs-target="#exchangeActionSheet">
                            <div class="in">
                                <div class="iconbox">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>
                                Lock Fund
                            </div>
                        </a>
                        <a href="/user/cards" class="action-button">
                            <div class="in">
                                <div class="iconbox">
                                    <ion-icon name="card-outline"></ion-icon>
                                </div>
                                My Cards
                            </div>
                        </a>
                    </div>
                    <!-- * action group -->

                    <!-- others -->
                    <div class="listview-title mt-1">Others</div>
                    <ul class="listview flush transparent no-line image-listview">
                        <li>
                            <a href="/user/settings" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="settings-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Settings
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/user/support" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="chatbubble-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Support
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



    <!-- iOS Add to Home Action Sheet -->
    <div class="modal inset fade action-sheet ios-add-to-home" id="ios-add-to-home-screen" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add to Home Screen</h5>
                    <a href="#" class="close-button" data-bs-dismiss="modal">
                        <ion-icon name="close"></ion-icon>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content text-center">
                        <div class="mb-1"><img src="{{ asset('app/img/icon/192x192.png') }}" alt="image" class="imaged w64 mb-2">
                        </div>
                        <div>
                            Install <strong>Finapp</strong> on your iPhone's home screen.
                        </div>
                        <div>
                            Tap <ion-icon name="share-outline"></ion-icon> and Add to homescreen.
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-primary btn-block" data-bs-dismiss="modal">CLOSE</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- * iOS Add to Home Action Sheet -->


    <!-- Android Add to Home Action Sheet -->
    <div class="modal inset fade action-sheet android-add-to-home" id="android-add-to-home-screen" tabindex="-1"
        role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add to Home Screen</h5>
                    <a href="#" class="close-button" data-bs-dismiss="modal">
                        <ion-icon name="close"></ion-icon>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content text-center">
                        <div class="mb-1">
                            <img src="{{ asset('app/img/icon/192x192.png') }}" alt="image" class="imaged w64 mb-2">
                        </div>
                        <div>
                            Install <strong>Finapp</strong> on your Android's home screen.
                        </div>
                        <div>
                            Tap <ion-icon name="ellipsis-vertical"></ion-icon> and Add to homescreen.
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-primary btn-block" data-bs-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * Android Add to Home Action Sheet -->



    <div id="cookiesbox" class="offcanvas offcanvas-bottom cookies-box" tabindex="-1" data-bs-scroll="true"
        data-bs-backdrop="false">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">We use cookies</h5>
        </div>
        <div class="offcanvas-body">
            <div>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non lacinia quam. Nulla facilisi.
                <a href="#" class="text-secondary"><u>Learn more</u></a>
            </div>
            <div class="buttons">
                <a href="#" class="btn btn-primary btn-block" data-bs-dismiss="offcanvas">I understand</a>
            </div>
        </div>
    </div>

    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="{{ asset('app/js/lib/bootstrap.bundle.min.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="{{ asset('app/js/plugins/splide/splide.min.js') }}"></script>
    <!-- Base Js File -->
    <script src="{{ asset('app/js/base.js') }}" defer></script>

    <script>
        // Add to Home with 2 seconds delay.
        // AddtoHome("2000", "once");
    </script>

</body>
</html>