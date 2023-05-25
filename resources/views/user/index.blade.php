@include('user.layouts.header')
    <!-- App Capsule -->
    <div id="appCapsule">

        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <div class="balance">
                    <div class="left">
                        <span class="title">Total Balance</span>
                        <h1 class="total">{{ get_currency_symbol($user_settings->currency) }} {{ currency_conversion($user_settings->currency, $total_locked_fund + $total_savings + $user_account->account_balance) }}</h1>
                    </div>
                    <div class="right">
                        <a href="#" class="button" data-bs-toggle="modal" data-bs-target="#depositActionSheet">
                            <ion-icon name="add-outline"></ion-icon>
                        </a>
                    </div>
                </div>
                <!-- * Balance -->
                <!-- Wallet Footer -->
                <div class="wallet-footer">
                    <div class="item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#withdrawActionSheet">
                            <div class="icon-wrapper bg-danger">
                                <ion-icon name="arrow-down-outline"></ion-icon>
                            </div>
                            <strong>Save</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#sendActionSheet">
                            <div class="icon-wrapper">
                                <ion-icon name="arrow-forward-outline"></ion-icon>
                            </div>
                            <strong>Transfer</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="/user/cards">
                            <div class="icon-wrapper bg-success">
                                <ion-icon name="card-outline"></ion-icon>
                            </div>
                            <strong>Cards</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exchangeActionSheet">
                            <div class="icon-wrapper bg-warning">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </div>
                            <strong>Lock Fund</strong>
                        </a>
                    </div>

                </div>
                <!-- * Wallet Footer -->
            </div>
        </div>
        <!-- Wallet Card -->

        @include('user.action-sheet')

        @include('user.stats')

        @include('user.transactions')

        @if($cards->count() > 0) 
            @include('user.cards')
        @endif

        @if($savings->count() > 0)
            @include('user.savings')
        @endif



        <!-- app footer -->
        <div class="appFooter">
            <div class="footer-title">
                Copyright © {{ env('SITE_NAME') }} {{ date('Y') }}. All Rights Reserved.
            </div>
        </div>
        <!-- * app footer -->

    </div>
    <!-- * App Capsule -->
@include('user.layouts.general-scripts')
<script src="{{ asset('dash/js/deposit.js?ref=2') }}"></script>
<script src="{{ asset('dash/js/savings.js?ref=2') }}"></script>
@include('user.layouts.footer')
