

<!-- Add Card Action Sheet -->
<div class="modal fade action-sheet" id="editTransactionActionSheet" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editing Transaction</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <form class="edit-transaction-form">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="cardnumber1"> Amount </label>
                                <input type="number" class="form-control" id="exp-month" name="amount">
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="cardnumber1"> Sender </label>
                                <input type="text" class="form-control" id="exp-month" name="sender">
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="cardnumber1"> Beneficiary </label>
                                <input type="text" class="form-control" id="exp-month" name="beneficiary">
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="cardnumber1"> Type </label>
                                <select class="form-control custom-select" id="exp-month" name="type">
                                    <option value="debit">Debit</option>
                                    <option value="credit">Credit</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label">Transaction Date</label>
                                <input type="date" id="transactionpin" class="form-control" placeholder="" name="date">
                            </div>
                        </div>


                        <div class="form-group basic mt-2">
                            <button type="button" class="btn btn-primary btn-block btn-lg edit-transaction-btn">Edit</button>
                        </div>

                        <div class="form-group mt-">
                            <a href="" id="transactionDeleteBtn" class="btn btn-danger btn-block btn-lg">Delete</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Add Card Action Sheet -->

<script>
    
</script>