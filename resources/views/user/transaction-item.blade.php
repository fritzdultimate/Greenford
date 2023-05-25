@include('user.layouts.header')
<!-- App Header -->
<div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            Transaction Detail
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule" class="full-height">

        <div class="section mt-2 mb-2">


            <div class="listed-detail mt-3">
                <div class="icon-wrapper">
                    <div class="iconbox {{ $transaction->beneficiary_id == $user->id ? '' : 'bg-danger' }}">
                        @if( $transaction->beneficiary_id == $user->id )
                        <ion-icon name="arrow-back-outline"></ion-icon>
                        @else
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                        @endif
                    </div>
                </div>
                <h3 class="text-center mt-2">{{ $transaction->beneficiary_id == $user->id ? 'Payment Received' : 'Payment Sent'  }}</h3>
            </div>

            <ul class="listview flush transparent simple-listview no-space mt-3">
                <li>
                    <strong>Status</strong>
                    <span class="text-success">Success</span>
                </li>
                <li>
                    @if(!$transaction->sender_name)
                        <strong>{{ $transaction->beneficiary_id == $user->id ? 'From' : 'To'  }}</strong>
                    @else
                        <strong>{{ $transaction->type == 'debit' ? 'To' : 'From'  }}</strong>
                    @endif
                    
                    @if(!$transaction->sender_name)
                        <span>{{ $transaction->beneficiary_id == $user->id ? $transaction->sender->fullname : $transaction->beneficiary->fullname  }}</span>
                    @else
                        <span>{{ $transaction->type == 'debit' ? ucfirst($transaction->beneficiary_name) : ucfirst($transaction->sender_name)  }}</span>
                    @endif
                </li>
                <li>
                    <strong>Account Number</strong>
                    <span>{{ substr($transaction->account_number, 0, 3) . "***" . substr($transaction->account_number, -4, 4) }}</span>
                </li>
                <li>
                    <strong>Transaction ID</strong>
                    <span>{{ $transaction->transaction_id }}</span>
                </li>
                <li>
                    <strong>Description</strong>
                    <span>{{ $transaction->description }}</span>
                </li>
                <li>
                    <strong>Date</strong>
                    <span>{{ date_format(date_create($transaction->created_at), 'M d, Y H:m A') }}</span>
                </li>
                <li>
                    <strong>Amount</strong>
                    <h3 class="m-0">{{ get_currency_symbol($user_settings->currency)  }}  {{ currency_conversion($user_settings->currency, $transaction->amount) }}</h3>
                </li>
            </ul>


        </div>

    </div>
    <!-- * App Capsule -->
@include('user.layouts.general-scripts')
@include('user.layouts.footer')