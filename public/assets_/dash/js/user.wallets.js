let $_table = null;
let clickedBtn = null;
let catchErrorMsg = "sorry, something went wrong";
let isEdit = false;
let host = location.origin;
let urlPrefix = host + '/app/wallet/';
let headers = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Content-Type' : 'application/json'
};

let addWalletBtn = document.querySelector('.add-wallet');
let walletForm = document.querySelector('.wallet-form');

window.addEventListener('load', () => {
    initTable();
    registerBtnActionClick();
    addWalletBtn.addEventListener('click', (e) => {
        e.preventDefault();
        $('#wallet-modal').modal('show');
    });
    $('.memo-wrapper').on('change', 'select', function(){
        toggleMemoCont();
    });
    walletForm.addEventListener('submit', (e) => {
        e.preventDefault();
        showLoading();
        handleSaveWallet(e.currentTarget);
    });
});
$('#wallet-modal').on('show.bs.modal', () => {
    if(isEdit){
        document.querySelector('.wallet-action').textContent = 'Edit ';
    } else {
        document.querySelector('.wallet-action').textContent = 'Add New ';
    }
})

$('#wallet-modal').on('hide.bs.modal', () => {
    isEdit = false;
    walletForm.reset();
    clickedBtn = null;
})

function toggleMemoCont(){
    if(hasMemo()){
        document.querySelector('.memo-cont').classList.remove('d-none');
    } else {
        document.querySelector('.memo-cont').classList.add('d-none');
    }
}
function hasMemo(){
    let select = document.querySelector('#has-memo');
    let selectedOption = select.selectedOptions[0];
    return !!(+selectedOption.dataset.has_memo)
}
function registerBtnActionClick(target){
    let actionLinks = [... document.querySelectorAll('.action-link')];
    actionLinks.forEach((actionLink) => {
        if(!actionLink.dataset.added){
            actionLink.addEventListener('click', (e) => {
                e.preventDefault();
                clickedBtn = e.currentTarget;
                handleBtnAction(e.currentTarget);
            });
            actionLink.dataset.added = true;
        }
    });
}

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

function handleBtnAction(btn){
    let action = clickedBtn.dataset.action;
    if(action == 'edit'){
        isEdit = true;
        let dataset = {... clickedBtn.dataset};
        for(key in dataset){
            if(walletForm.elements.namedItem(key)){
                walletForm.elements.namedItem(key).value = dataset[key].toLowerCase();
            }
        }
        $('#has-memo').niceSelect('update');
        toggleMemoCont();
        $('#wallet-modal').modal('show');
    } 
}

function handleSaveWallet(form){
    let urlAction = isEdit ? 'update' : 'create';
    console.log(jsonFormData(form));
    fetch(urlPrefix + urlAction, {
        method : 'post',
        headers,
        body : JSON.stringify({
            ...jsonFormData(form),
            has_memo : hasMemo(),
            id : isEdit ? clickedBtn.dataset.id : null
        })
    }).then((res) => {
        hideLoading();
        return res.json();
    })
    .then((data) => {
        if('errors' in data){
            let errorMsg = getResponse(data);
            LobiNotify('error', errorMsg);
        }
        else if('success' in data){
            if(isEdit){
                tableEdit(form);
            } else {
                lastInsertId = data['success']['id'];
                tableAdd(lastInsertId);
                form.reset();
            }
            let successMsg = getResponse(data, 'success');
            LobiNotify('success', successMsg);
        } else {
            LobiNotify('error', catchErrorMsg);    
        }
     }).catch((err) => {
         console.log(err);
        LobiNotify('error', catchErrorMsg);
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

function tableAdd(id){
    let form = document.querySelector('.wallet-form');
    let select = document.querySelector('#has-memo');
    let selectedOption = select.selectedOptions[0];
    let formData = jsonFormData(form);
    let walletData = [
        `<div class="media cs-media">
            <div class="media-body"> 
                <h5> ${selectedOption.dataset.currency} </h5>
            </div>
        </div>`,
        `<div class="media cs-media">
            <div class="media-body"> 
                <h5> ${selectedOption.dataset.symbol} </h5>
            </div>
        </div>`,
        `<div class="media cs-media">
            <div class="media-body"> 
                <h5> ${formData.currency_address} </h5>
            </div>
        </div>`,
        `<div class="media cs-media">
            <div class="media-body"> 
                <h5> ${formData.memo_token} </h5>
            </div>
        </div>`,
        walletBtnAction(formData, id, selectedOption)
    ];

    let node = $_table.row.add(walletData).draw(false).node();
    let info = $_table.page.info();
    console.log(info);
    if(info){
        if((info.page + 1) < info.pages){
            $_table.page('next').draw('page');
        }
    }
}
function walletBtnAction(wallet, id, mainWallet){
    return `
    <nav class="navbar navbar-expand">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu">
                    <a data-main_wallet-id="${ mainWallet.dataset.id }" data-currency_address="${ wallet['currency_address'] }"
                    data-action="edit" data-id="${ id }" class="action-link dropdown-item" href="#">Edit</a>
                </div>
            </li>
        </ul>
    </nav>
    `
}