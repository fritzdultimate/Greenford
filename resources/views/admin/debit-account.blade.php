@include('admin.layouts.header')
@include('user.dialogbox.error-modal')
@include('user.dialogbox.success-modal')
@include('user.dialogbox.iconed-button-inline')

<!-- App Capsule -->
<div id="appCapsule">


    <div class="section mt-2">
        <div class="section-title">Debit Account</div>
        <div class="card">
            <div class="card-body">

                <form class="credit-account-form">
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="userid1">User ID</label>
                            <select class="form-control custom-select" id="account2d" name="user_id">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ ucfirst($user->fullname) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="amount1">Amount</label>
                            <input type="number" class="form-control" id="amount1" placeholder="Enter an Amount" name="amount">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <button type="button" class="btn btn-primary btn-block btn-lg credit-account-btn">Debit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

<!--* App Capsule -->
<script src="{{ asset('dash/js/fn.js') }}"></script>
<script src="{{ asset('dash/js/debit-account.js') }}"></script>
@include('admin.layouts.footer')