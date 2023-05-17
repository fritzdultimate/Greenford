@include('admin.layouts.header')
    <!-- App Capsule -->
    <div id="appCapsule">
        <!-- Stats -->
        <div class="section">
            <div class="row mt-2">
                <div class="col-12 mt-2">
                    <div class="stat-box">
                        <div class="title">Total Users</div>
                        <div class="value text-success">{{ $total_users }}</div>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="stat-box">
                        <div class="title">Number of transactions performed</div>
                        <div class="value text-danger">{{ $count_transactions }}</div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 mt-2">
                    <div class="stat-box">
                        <div class="title">Sum Transactions</div>
                        <div class="value text-success">$ {{ number_format($total_transactions, 2, '.', ',') }}</div>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="stat-box">
                        <div class="title">Total Card Funds</div>
                        <div class="value text-success">$ {{ number_format($total_funded_cards, 2, '.', ',') }}</div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <div class="stat-box">
                        <div class="title">Total Savings Fund</div>
                        <div class="value text-info">$ {{ number_format($total_savings, 2, '.', ',') }}</div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <div class="stat-box">
                        <div class="title">Total Account Balance</div>
                        <div class="value text-success">$ {{ number_format($total_account_balance, 2, '.', ',') }}</div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <div class="stat-box">
                        <div class="title">Total Money Sent</div>
                        <div class="value text-danger">$ {{ number_format($total_sent_out, 2, '.', ',') }}</div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <div class="stat-box">
                        <div class="title">Total Money Received</div>
                        <div class="value text-success">$ {{ number_format($total_sent_in, 2, '.', ',') }}</div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <div class="stat-box">
                        <div class="title">Total Funds Locked</div>
                        <div class="value text-info">$ {{ number_format($total_locked_funds, 2, '.', ',') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Stats -->
    </div>
    <!-- * App Capsule -->
@include('admin.layouts.footer')