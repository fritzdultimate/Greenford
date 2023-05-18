let passForm = document.querySelector('.pass-form');
let host = location.origin;
let catchText = "Sorry. something went wrong";
let api = host + '/app/register/setup/resetpass';

window.addEventListener('load', () => {
    initPassFormAction();
});

function initPassFormAction(){
    passForm.addEventListener('submit', (e) => {
        e.preventDefault();
        showLoading();
        processChangePass(e.currentTarget);
    });
}
function hasError(form){
    return checkError(form, true);
}
function checkError(form, mode){
    let fd = new FormData(form);
    let passwordMatch = fd.get('password') == fd.get('repassword');
    if(hasEmptyField(form)){
        return mode ? true : LobiNotify("error", "Inputs Cant Be Empty", 10000);
    } else if(!passwordMatch){
        return mode ? true : LobiNotify("error", "Passwords do not match", 10000);
    } else {
        return false;
    }
}
function processChangePass(form){
    if(hasError(form)){
        hideLoading();
        return checkError(form);
    }
    
    fetch(api, {
        method : 'post',
        headers : {
            'Content-type' : 'application/json',
            'X-Requested-With' : 'XMLHttpRequest'
        },
        body : JSON.stringify(jsonFormData(form))
    }).then((res) => {
        hideLoading();
        return res.json();
    }).then((data) => {
        if('errors' in data){
            let errorMsg = getResponse(data);
            LobiNotify('error', errorMsg, 10000);
        } else if('success' in data){
            form.reset();
            let successMsg = getResponse(data,'success');
            // lobiAlert('success',successMsg);
            sessionStorage.changedPass = true;
            redirectTo('/user');
        } else {
            LobiNotify('error', catchText);
        }
    }).catch((e) => {
         hideLoading();
        LobiNotify('error', catchText);
    })
}
