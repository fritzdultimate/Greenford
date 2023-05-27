    @include('user.dialogbox.error-modal')
    @include('user.dialogbox.success-modal')
    @include('user.dialogbox.iconed-button-inline')
    @include('user.dialogbox.enter-pin-dialogbox')
        <!-- Deposit Action Sheet -->
        <div class="modal fade action-sheet" id="depositActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Account Details</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form>
                                <div class="form-group basic">
                                    <label class="label">Account Number</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" placeholder=""
                                            value="{{ $user_account->account_number }}" id="accountNumberInput">
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <label class="label">Account Name</label>
                                    <div class="input-group mb-2">
                                        {{ $user->fullname }}
                                    </div>
                                </div>


                                <div class="form-group basic">
                                    <button type="button" class="btn btn-primary btn-block btn-lg"
                                        data-bs-dismiss="modalv" id="copyAccountNumberBtn">Copy Number</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Deposit Action Sheet -->

        <!-- Save Action Sheet -->
        <div class="modal fade action-sheet" id="withdrawActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Save Money</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content" id="modalContentSavings">
                            <form class="create-savings-form">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="account2d">From</label>
                                        <select class="form-control custom-select" id="account2d">
                                            <option value="">Account (*** {{substr($user_account->account_number, 6, 4) }}) </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="account2d">To</label>
                                        <select class="form-control custom-select" id="account2d" name="savings">
                                            @foreach($savings as $save)
                                            <option value="{{ $save->id }}">{{ ucfirst($save->name) }} (#{{ substr($save->savings_id, 0, 5) }}...{{ substr($save->savings_id, -4, 4) }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <label class="label">Enter Amount</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addonb1">{{ get_currency_symbol($user_settings->currency) }}</span>
                                        <input type="text" class="form-control" placeholder="Enter an amount" name="amount">
                                    </div>

                                    <div class="form-group basic">
                                    <label class="label">Transaction Pin</label>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control"
                                         name="pin">
                                    </div>
                                </div>
                                </div>

                                <div class="form-group basic">
                                    <button type="button" class="btn btn-primary btn-block btn-lg create-savings-btn form-button">Save</button>

                                    <button class="btn btn-primary btn-block btn-lg form-loading d-none" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm me-05" role="status" aria-hidden="true"></span>
                                         Loading...
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="text-center" style="padding: 10px; margin-bottom: 5px; display:none" id="createSavingsGoalPan">
                            <p>You have not created any savings</p>
                            
                            <div class="form-group basic">
                                <a href="user/savings/create" class="btn btn-primary btn-block btn-lg">Create Savings goal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Withdraw Action Sheet -->

        <!-- Send Action Sheet -->
        <div class="modal fade action-sheet" id="sendActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Send Money</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form class="send-money-form">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="account2">From</label>
                                        <select class="form-control custom-select" id="account2">
                                            <option value="0">{{ ucfirst(explode(' ', $user_account->user->account_type)[0]) }} (*** {{ substr((string) $user_account->account_number, 6, 4) }})</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="text11">To</label>
                                        <input type="number" class="form-control" id="text11"
                                            placeholder="Account number" name="account_number">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <label class="label">Bank Name</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" placeholder="Bank Name"
                                         name="bank">
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <label class="label">Routing Number</label>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" placeholder="e.g 123456789"
                                         name="routing">
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <label class="label">Enter Amount</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1">{{ get_currency_symbol($user_settings->currency) }}</span>
                                        <input type="number" class="form-control" placeholder="0.00"
                                         name="amount">
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <label class="label">Bank Address</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control"
                                         name="address">
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <label class="label">Reason (optional)</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control"
                                         name="description">
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <label class="label">Transaction Pin</label>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control"
                                         name="pin">
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg send-btn form-button"
                                    value="submit">Send</button>


                                    <button class="btn btn-primary btn-block btn-lg form-loading d-none" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm me-05" role="status" aria-hidden="true"></span>
                                         Loading...
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Send Action Sheet -->

        <!-- Lock Action Sheet -->
        <div class="modal fade action-sheet" id="exchangeActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Lock funds</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form class="lock-fund-form">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="account2">From</label>
                                        <select class="form-control custom-select" id="account2">
                                            <option value="0">Savings (*** {{ substr((string) $user_account->account_number, 6, 4) }})</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <label class="label">Enter Amount</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1">{{ get_currency_symbol($user_settings->currency) }}</span>
                                        <input type="number" class="form-control" placeholder="0.00"
                                         name="amount">
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <label class="label">Transaction Pin</label>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control"
                                         name="pin">
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <label class="label">Duration</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1">Days</span>
                                        <input type="number" class="form-control" placeholder="0.00"
                                         name="duration">
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg lock-fund-btn form-button"
                                    value="submit">Lock</button>

                                    <button class="btn btn-primary btn-block btn-lg form-loading d-none" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm me-05" role="status" aria-hidden="true"></span>
                                         Loading...
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Lock Action Sheet -->

        <!-- <script src="{{ asset('dash/js/deposit.js') }}"></script> -->

        <script>
            copyAccountNumberBtn.addEventListener('click', (e) => {
                let copyText = document.getElementById("accountNumberInput");

                copyText.select();
                copyText.setSelectionRange(0, 99999);

                navigator.clipboard.writeText(copyText.value);
                alert('Account number copied!')
            })
        </script>