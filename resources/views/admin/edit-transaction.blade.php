@include('admin.layouts.header')
@include('user.dialogbox.error-modal')
@include('user.dialogbox.success-modal')
@include('admin.actionsheet.edit-transaction')

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
                <a href="#" class="item" data-bs-toggle="modal" data-bs-target="#editTransactionActionSheet" onclick="updateId(this)" data-id="{{ $transaction->id }}">
                
                    <div class="detail">
                        @if($transaction->type == 'debit')
                        <ion-icon class="text-danger" name="arrow-up-outline" style="margin-right: 5px;"></ion-icon>
                        @elseif($transaction->type == 'credit')
                        <ion-icon class="text-success" name="arrow-down-outline" style="margin-right: 5px;"></ion-icon>
                        @endif
                        <div>
                            <strong>{{ ucfirst($transaction->transaction) }}</strong>
                            
                            <p>In-app transfer</p>
                        </div>
                    </div>
                    <div class="right">
                        
                        <div class="price text-danger"> {{ env('CURRENCY') }} {{ number_format($transaction->amount, 2, '.', ',') }}</div>
                        
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
                No transaction history yet!
            </div>
        @endif


    </div>
    <!-- * App Capsule -->
    <script>
        let TransactionEditingId = null;

        function updateId(event) {
            TransactionEditingId = event.dataset.id;
            let createLink = '/admin/transaction/history/delete/' + TransactionEditingId;
            document.getElementById("transactionDeleteBtn").href = createLink;
            console.log(createLink);
        }
    </script>

<script src="{{ asset('dash/js/fn.js') }}"></script>
<script src="{{ asset('dash/js/edit-transaction.js?ref2') }}"></script>
@include('admin.layouts.footer')