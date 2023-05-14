<!-- Transactions -->
<div class="section mt-4">
            <div class="section-heading">
                <h2 class="title">Transactions</h2>
                <a href="app-transactions.html" class="link">View All</a>
            </div>
            <div class="transactions">
                @foreach($transactions as $transaction)
                <!-- item -->
                <a href="app-transaction-detail.html" class="item">
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
                            <div class="price text-danger"> - $ {{ number_format($transaction->amount, 2, '.', ',') }}</div>
                        @elseif($transaction->beneficiary_id == $user->id)
                            <div class="price text-success"> + $ {{ number_format($transaction->amount, 2, '.', ',') }}</div>
                        @endif
                    </div>
                </a>
                <!-- * item -->
                @endforeach
                <!-- item -->
                <a href="app-transaction-detail.html" class="item">
                    <div class="detail">
                        <img src="{{ asset('app/img/sample/brand/2.jpg') }}" alt="img" class="image-block imaged w48">
                        <div>
                            <strong>Apple</strong>
                            <p>Appstore Purchase</p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="price text-danger">- $ 29</div>
                    </div>
                </a>
                <!-- * item -->
            </div>
        </div>
        <!-- * Transactions -->