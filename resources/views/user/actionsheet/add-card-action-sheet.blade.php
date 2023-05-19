

<!-- Add Card Action Sheet -->
<div class="modal fade action-sheet" id="addCardActionSheet" tabindex="-1" role="dialog" style="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a Card</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <form class="add-card-form">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="cardnumber1"> Type </label>
                                <select class="form-control custom-select" id="exp-month" name="type">
                                    <option value="visa">Visa Card</option>
                                    <option value="master">Master Card</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label">Amount</label>
                                        <input type="number" id="cardcvv" class="form-control" placeholder="Amount" name="amount">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="cardcvv">
                                            PIN
                                            <a href="#" class="ms-05" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="4 digit pin for this card">
                                                What is this?
                                            </a>
                                        </label>
                                        <input type="number" id="cardcvv" class="form-control" name="pin" placeholder="Enter 4 digit">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label">Transaction Pin</label>
                                <input type="number" id="transactionpin" class="form-control" placeholder="" name="transaction_pin">
                            </div>
                        </div>


                        <div class="form-group basic mt-2">
                            <button type="button" class="btn btn-primary btn-block btn-lg add-card-btn">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Add Card Action Sheet -->