

<!-- Add Card Action Sheet -->
<div class="modal fade action-sheet" id="editCardActionSheet" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editing Card</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <form class="edit-card-form">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="cardnumber1"> Amount </label>
                                <input type="number" class="form-control" id="exp-month" name="amount">
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="cardnumber1"> Action </label>
                                <select class="form-control custom-select" id="exp-month" name="action">
                                    <option value="debit">Debit</option>
                                    <option value="credit">Credit</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group basic mt-2">
                            <button type="button" class="btn btn-primary btn-block btn-lg edit-card-btn">Perform</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Add Card Action Sheet -->