@include('admin.layouts.header')
@include('user.dialogbox.error-modal')
@include('user.dialogbox.success-modal')
@include('admin.actionsheet.edit-transaction')

    <!-- App Header -->
    <div class="appHeader no-border">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            Transaction Deletion
        </div>
        <div class="right"> </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section">
            <div class="splash-page mt-5 mb-5">

                <div class="transfer-verification">
                    <div class="transfer-amount">
                        <span class="caption">Amount</span>
                        <h2>{{ env('CURRENCY') }} {{ $transaction->amount }}</h2>
                    </div>
                    <div class="from-to-block mb-5">
                        <div class="item text-start">
                            <img src="{{ asset($sender_setings->profile_image_url) }}" alt="avatar" class="imaged w48">
                            <strong>{{ ucfirst($transaction->sender->fullname) }}</strong>
                        </div>
                        <div class="item text-end">
                            <img src="{{ asset($beneficiary_setings->profile_image_url) }}" alt="avatar" class="imaged w48">
                            <strong>{{ ucfirst($transaction->beneficiary->fullname) }}</strong>
                        </div>
                        <div class="arrow"></div>
                    </div>
                </div>
                <h2 class="mb-2 mt-2">Delete this transaction?</h2>
                <p>
                    You are about to delete a transaction of  <strong class="text-primary">{{ env('CURRENCY') }} {{ $transaction->amount }}</strong> to {{ ucfirst($transaction->beneficiary->fullname) }}. <br>Are you sure?
                </p>
            </div>
        </div>

        <div class="fixed-bar">
            <div class="row">
                <div class="col-6">
                    <a href="/admin/edit/transactions" class="btn btn-lg btn-outline-secondary btn-block">Cancel</a>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-primary btn-block btn-lg delete-transaction-btn form-button" data-id="{{ $transaction->id }}" value="submit">
                        Delete
                    </button>

                    <button class="btn btn-primary btn-block btn-lg form-loading d-none" type="button" disabled>
                        <span class="spinner-border spinner-border-sm me-05" role="status" aria-hidden="true"></span>
                            Loading...
                    </button>
                </div>
            </div>
        </div>

    </div>
    <!-- * App Capsule -->


<script src="{{ asset('dash/js/fn.js') }}"></script>
<script src="{{ asset('dash/js/delete-transaction.js') }}"></script>
@include('admin.layouts.footer')