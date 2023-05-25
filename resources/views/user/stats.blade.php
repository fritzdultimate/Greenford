<!-- Stats -->
<div class="section">
            <div class="row mt-2">
                <div class="col-12">
                    <div class="stat-box">
                        <div class="title">Account balance </div>
                        <div class="value text-success">{{ get_currency_symbol($user_settings->currency) }} {{ currency_conversion($user_settings->currency, number_format($user_account->account_balance, 2, '.', ',')) }}</div>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="stat-box">
                        <div class="title">Locked Fund</div>
                        <div class="value text-danger">{{ get_currency_symbol($user_settings->currency) }} {{ currency_conversion($user_settings->currency, number_format($total_locked_fund, 2, '.', ',')) }}</div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="stat-box">
                        <div class="title">Savings</div>
                        <div class="value text-success">{{ get_currency_symbol($user_settings->currency) }} {{ currency_conversion($user_settings->currency, number_format($total_savings, 2, '.', ',')) }}</div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <div class="stat-box">
                        <div class="title">Total Card Balance</div>
                        <div class="value text-success">{{ get_currency_symbol($user_settings->currency) }} {{ currency_conversion($user_settings->currency, $total_card_balance) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Stats -->