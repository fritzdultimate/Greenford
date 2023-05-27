<!-- Transactions -->
<div class="section mt-4">
            <div class="section-heading">
                <h2 class="title">Transactions</h2>
                <a href="/user/transactions" class="link">View All</a>
            </div>
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
                            <div class="price text-danger"> - {{ get_currency_symbol($user_settings->currency) }} {{ currency_conversion($user_settings->currency, $transaction->amount) }}</div>
                        @elseif($transaction->beneficiary_id == $user->id)
                            <div class="price text-success"> + {{ get_currency_symbol($user_settings->currency) }} {{ currency_conversion($user_settings->currency, $transaction->amount) }}</div>
                        @endif
                    </div>
                </a>
                <!-- * item -->
                @endforeach
                
            </div>
        </div>
        <!-- * Transactions -->