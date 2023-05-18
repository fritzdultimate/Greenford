let registerForm = document.querySelector('.register-form');
let host = location.origin;
let catchText = "Sorry. something went wrong";

window.addEventListener('load', () => {
    initRegisterFormAction();
});

function initRegisterFormAction(){
    registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        showLoading();
        processRegister(e.currentTarget);
    });
}
function hasError(form){
    return checkError(form, true);
}
function checkError(form, mode){
    let fd = new FormData(form);
    let passwordMatch = fd.get('password') == fd.get('repassword');
    let acceptedTerms = !!fd.get('terms');
    if(hasEmptyField(form)){
        return mode ? true : LobiNotify("error", "Inputs Cant Be Empty", 10000);
    } else if(!passwordMatch){
        return mode ? true : LobiNotify("error", "Passwords do not match", 10000);
    }  else if(!acceptedTerms){
        return mode ? true : LobiNotify("error", "Accept our terms and conditions before proceeding", 10000);
    } else {
        return false;
    }
}
function processRegister(form){
    if(hasError(form)){
        hideLoading();
        return checkError(form);
    }
    let url = host + '/app/register';
    fetch(location.search ? url + getRef() : url, {
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
            lobiAlert('success',successMsg);
        } else {
            LobiNotify('error', catchText);
        }
    }).catch((e) => {
         hideLoading();
        LobiNotify('error', catchText);
    })
}
