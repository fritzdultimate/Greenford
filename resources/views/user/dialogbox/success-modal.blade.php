<!-- DialogIconedSuccess -->
<div class="modal fade dialogbox" id="DialogIconedSuccess" data-bs-backdrop="static" tabindex="-1"
    role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-icon text-success">
                <ion-icon name="checkmark-circle"></ion-icon>
            </div>
            <div class="modal-header">
                <h5 class="modal-title">Success</h5>
            </div>
            <div class="modal-body" id="dialog-success-message">
                Action was successfull.
            </div>
            <div class="modal-footer">
                <div class="btn-inline">
                    <a href="#" onclick="closeSuccessModal()" class="btn" data-bs-dismiss="modal">CLOSE</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * DialogIconedSuccess -->

<script>
    function closeSuccessModal(event) {
        // event.target.preventDefault();
        DialogIconedSuccess.classList.remove('show');
        DialogIconedSuccess.style.display = '';
        document.querySelector('.modal-backdrop').remove();
    }
</script>