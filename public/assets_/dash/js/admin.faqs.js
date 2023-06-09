let $_table = null;
let clickedBtn = null;
let catchErrorMsg = "sorry, something went wrong";
let faqMsgs = {
    delete : {
        title : 'Are you sure to delete?',
        msg : 'You will not be able to recover this Record !!'
    }
}
let host = location.origin;
let urlPrefix = host + '/app/admin/faq/';
let headers = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Content-Type' : 'application/json'
};
let addFaqBtn = document.querySelector('.add-faq');
let isEdit = false;

let faqForm = document.querySelector('.faq-form');

window.addEventListener('load', () => {
    initTable();
    registerBtnActionClick();
    addFaqBtn.addEventListener('click', (e) => {
        e.preventDefault();
        $('#faq-modal').modal('show');
    });
    
    faqForm.addEventListener('submit', (e) => {
        e.preventDefault();
        showLoading();
        handleSaveFaq(e.currentTarget);
    });
});
$('#faq-modal').on('show.bs.modal', () => {
    if(isEdit){
        document.querySelector('.faq-action').textContent = 'Edit ';
    } else {
        document.querySelector('.faq-action').textContent = 'Add New ';
    }
})
$('#faq-modal').on('hide.bs.modal', () => {
    isEdit = false;
    faqForm.reset();
    clickedBtn = null;
})

function initTable(){
    $_table = $('.record-table').DataTable({
        "order": [],
        createdRow: function ( row, data, index ) {
            $(row).addClass('background_white');
        } 
    });
    // $_table.rows().every(function() {
        // this.nodes().to$().removeClass('background_white')
    // });
    $_table.on('draw', () => {
        registerBtnActionClick();
    });
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

function handleBtnAction(btn){
    let action = clickedBtn.dataset.action;
    if(action == 'edit'){
        isEdit = true;
        let dataset = {... clickedBtn.dataset};
        console.log(dataset);
        console.log(jsonFormData(faqForm));
        for(key in dataset){
            if(faqForm.elements.namedItem(key)){
                faqForm.elements.namedItem(key).value = dataset[key].toLowerCase();
            }
        }
        
        $('#faq-modal').modal('show');
    } else if(faqMsgs.hasOwnProperty(action)){
        doActionConfirm(action);
    }
}

function handleSaveFaq(form){
    let urlAction = isEdit ? 'update' : 'create';
    fetch(urlPrefix + urlAction, {
        method : 'post',
        headers,
        body : JSON.stringify({
            ...jsonFormData(form),
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
         hideLoading();
         console.log(err);
        LobiNotify('error', catchErrorMsg);
     });
}

function doActionConfirm(action){
    Lobibox.confirm({
        title : faqMsgs[action].title,
        msg : faqMsgs[action].msg,
        soundPath,
        callback :  ($this, type, ev) => {
            if(type == 'yes'){
                blockUI();
                deleteFaq(action);
            }
        }
    })
}
function deleteFaq(){
    let tableDetails = getTableDetails();
    let currentTR = tableDetails.currentTR;
    fetch(urlPrefix + 'delete', {
        method : 'post',
        headers,
        body : JSON.stringify({
            id : clickedBtn.dataset.id
        })
    }).then((res) => {
        unblockUI();
        return res.json();
    })
    .then((data) => {
        if('errors' in data){
            let errorMsg = getResponse(data);
            lobiAlert('error', errorMsg);
        }
        else if('success' in data){
            $_table.row(currentTR).remove().draw(false);
            let successMsg = getResponse(data, 'success');
            lobiAlert('success', successMsg);
        } else {
            lobiAlert('error', catchErrorMsg);    
        }
    }).catch((err) => {
        lobiAlert('error', catchErrorMsg);
    });
}

function tableEdit(form){
    form = document.querySelector('.faq-form');
    let tableDetails = getTableDetails();
    tableAdd(clickedBtn.dataset.id);
    let rowData = $_table.rows();
    let addedRowIndex = (rowData[0].length - 1);
    let addedRowData = $_table.row(addedRowIndex).data();
    $_table.row(addedRowIndex).remove().draw(false);
    $_table.row(tableDetails.currentTR).data(addedRowData).draw(false);
}

function tableAdd(id){
    let form = document.querySelector('.faq-form');
    let formData = jsonFormData(form);
    let faqData = [
        `<div class="media cs-media">
            <div class="media-body"> 
                <h5> ${formData.priority} </h5>
            </div>
        </div>`,
        `<div class="media cs-media">
            <div class="media-body"> 
                <h5> ${formData.question} </h5>
            </div>
        </div>`,
        `<div class="media cs-media">
            <div class="media-body"> 
                <h5> ${formData.answer} </h5>
            </div>
        </div>`,
        faqBtnAction(formData, id)
    ];

    let node = $_table.row.add(faqData).draw(false).node();
    let info = $_table.page.info();
    if((info.page + 1) < info.pages){
        $_table.page('next').draw('page');
    }
}

function faqBtnAction(faq, id){
    return `
    <nav class="navbar navbar-expand">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu">
                    <a data-priority="${ faq['priority'] }" data-answer="${ faq['answer'] }" data-question="${ faq['question'] }" data-id="${ id }" class="action-link dropdown-item" href="#">Edit</a>
                    <a data-action="delete" data-id="${ id }" class="action-link dropdown-item" href="#">Delete</a>
                </div>
            </li>
        </ul>
    </nav>
    `
}