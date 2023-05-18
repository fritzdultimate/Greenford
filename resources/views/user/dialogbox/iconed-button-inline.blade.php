<!-- Dialog Iconed Inline -->
<div class="modal fade dialogbox" id="DialogIconedButtonInline" data-bs-backdrop="static"
            role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="IconedButtonInlineHeader">Proceed?</h5>
            </div>
            <div class="modal-body" id="IconedButtonInlineMessage">
                Are you sure about that?
            </div>
            <div class="modal-footer">
                <div class="btn-inline">
                    <a href="#" class="btn btn-text-danger" data-bs-dismiss="modal">
                        <ion-icon name="close-outline"></ion-icon>
                        CANCEL
                    </a>
                    <a href="#" class="btn btn-text-primary" id="confirmDialogIconedButtonAction">
                        <ion-icon name="checkmark-outline" id="iconedButtonAction"></ion-icon>
                        CONFIRM
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Dialog Iconed Inline -->

<script>
    confirmDialogIconedButtonAction.addEventListener('click', (e) => {
        CONFIRM = true;
        let path = location.pathname;
        if(path == '/user/cards' || path == '/user') {
            deleteCard();
        } else if(LOGOUTALLDEVICES) {
            processLogoutAllDevice();
        } else if(SUSPENDINGUSERID) {
            processSuspendUser()
        } else if(DELETINGUSERID) {
            processDeleteUser();
        } else if(USERFORKYCID) {
            processUpgradeKyc();
        }

        let el = document.getElementById("DialogIconedButtonInline");
        bootstrap.Modal.getInstance(el).hide();
    })
</script>