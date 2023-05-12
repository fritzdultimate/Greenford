<!-- DialogIconedDanger -->
<div class="modal fade dialogbox" id="DialogIconedDanger" data-bs-backdrop="static" tabindex="-1" role="dialog" id="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-icon text-danger">
                <ion-icon name="close-circle"></ion-icon>
            </div>
            <div class="modal-header">
                <h5 class="modal-title">Error</h5>
            </div>
            <div class="modal-body" id="dialog-error-message">
                There is something wrong.
            </div>
            <div class="modal-footer">
                <div class="btn-inline">
                    <a href="#" onclick="closeErrorModal()" class="btn" data-bs-dismiss="modal">CLOSE</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * DialogIconedDanger -->

<script>
    function closeErrorModal(event) {
        // event.target.preventDefault();
        DialogIconedDanger.classList.remove('show');
        DialogIconedDanger.style.display = '';
        document.querySelector('.modal-backdrop').remove();
    }
</script>