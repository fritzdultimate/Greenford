let passForm = document.querySelector('.pass-form');
let host = location.origin;
let catchText = "Sorry. something went wrong";
let api = host + '/app/register/setup/forgotpassword/email';
// /register/setup/forgotpassword/email

window.addEventListener('load', () => {
    initPassFormAction();
});

function initPassFormAction(){
    passForm.addEventListener('submit', (e) => {
        e.preventDefault();
        showLoading();
        processPass(e.currentTarget);
    });
}
function processPass(form){
    if(hasEmptyField(form)){
        hideLoading();
        LobiNotify('error', 'Inputs Cant Be Empty', 10000);
        return;
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
            console.log(data);
            let errorMsg = getResponse(data);
            LobiNotify('error', errorMsg, 10000)
        } else if('success' in data){
            
            redirectTo('/verify-token')
        } else {
            LobiNotify('error', catchText, 10000)
        }
    }).catch((e) => {
        hideLoading();
        LobiNotify('error', catchText, 10000)
    })
}
