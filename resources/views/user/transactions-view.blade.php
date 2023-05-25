@include('user.layouts.header')

    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            Transactions
        </div>
        
    </div>
    <!-- * App Header -->


    <!-- App Capsule -->
    <div id="appCapsule">

        <!-- Transactions -->
        @foreach($new_transaction_arr as $key => $transactions)
        <div class="section mt-2">
            <div class="section-title">{{ get_day_name($dates[$key]) }} </div>
            <div class="transactions">
            @foreach($transactions as $transaction)
                <!-- item -->
                <a href="/user/transaction/data/{{ $transaction->transaction_id }}" class="item">
                    <div class="detail">
                        @if($transaction->user_id == $user->id && $transaction->transaction == 'transfer')
                        <ion-icon class="text-danger" name="arrow-up-outline" style="margin-right: 5px;"></ion-icon>
                        @elseif($transaction->beneficiary_id == $user->id && $transaction->transaction == 'transfer')
                        <ion-icon class="text-success" name="arrow-down-outline" style="margin-right: 5px;"></ion-icon>
                        @endif
                        <div>
                            <strong>{{ ucfirst($transaction->transaction) }}</strong>
                            @if($transaction->user_id == $user->id && $transaction->transaction == 'transfer')
                            <p>Debit</p>
                            @elseif($transaction->beneficiary_id == $user->id && $transaction->transaction == 'transfer')
                            <p>Credit</p>
                            @endif
                        </div>
                    </div>
                    <div class="right">
                        @if($transaction->user_id == $user->id)
                            <div class="price text-danger"> - {{ get_currency_symbol($user_settings->currency)  }}  {{ currency_conversion($user_settings->currency, $transaction->amount) }}</div>
                        @elseif($transaction->beneficiary_id == $user->id)
                            <div class="price text-success"> + {{ get_currency_symbol($user_settings->currency)  }}  {{ currency_conversion($user_settings->currency, $transaction->amount) }}</div>
                        @endif
                    </div>
                </a>
                <!-- * item -->
            @endforeach
            </div>
        </div>
        @endforeach
        <!-- * Transactions -->

        <div class="section mt-2 mb-2 hidden" style="visibility:hidden">
            <a href="#" class="btn btn-primary btn-block btn-lg">Load More</a>
        </div>

        @if($transaction_count == 0)
            <div class="flex justify-center content-center" style="display: flex; justify-content: center; height: 100%; align-items: center; flex-direction: column; font-size: 15px;">
                You do not have any transaction history yet!
            </div>
        @endif


    </div>
    <!-- * App Capsule -->

@include('user.layouts.general-scripts')
@include('user.layouts.footer')