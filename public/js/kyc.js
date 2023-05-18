let $_table = null;

let addWalletBtn = document.querySelector('.add-wallet');
let walletForm = document.querySelector('.wallet-form');

window.addEventListener('load', () => {
    initTable();
    
    
    addWalletBtn.addEventListener('click', (e) => {
        e.preventDefault();
        $('#wallet-modal').modal('show');
    });
    
    
});

function initTable(){
    $_table = $('.record-table').DataTable({
        createdRow: function ( row, data, index ) {
            $(row).addClass('background_white');
        } 
    });
    $_table.on('draw', () => {
        registerBtnActionClick();
    });
}

function tableEdit(form){
    form = document.querySelector('.wallet-form');
    let tableDetails = getTableDetails();
    tableAdd(clickedBtn.dataset.id);
    let rowData = $_table.rows();
    let addedRowIndex = (rowData[0].length - 1);
    let addedRowData = $_table.row(addedRowIndex).data();
    $_table.row(addedRowIndex).remove().draw(false);
    $_table.row(tableDetails.currentTR).data(addedRowData).draw(false);
}
