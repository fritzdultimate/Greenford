<!-- Stats -->
<div class="section">
            <div class="row mt-2">
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">Account balance</div>
                        <div class="value text-success">$ {{ number_format($user_account->account_balance, 2, '.', ',') }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">Locked Fund</div>
                        <div class="value text-danger">$ {{ number_format($total_locked_fund, 2, '.', ',') }}</div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">Total Bills</div>
                        <div class="value">$ {{ number_format($user_account->total_bills, 2, '.', ',') }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">Savings</div>
                        <div class="value">$ {{ number_format($total_savings, 2, '.', ',') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Stats -->