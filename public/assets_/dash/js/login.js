let loginForm = document.querySelector('.login-form');
let host = location.origin;
let catchText = "Sorry. something went wrong";

window.addEventListener('load', () => {
    initLoginFormAction();
});

function initLoginFormAction(){
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        showLoading();
        processLogin(e.currentTarget);
    });
}
function processLogin(form){
    if(hasEmptyField(form)){
        hideLoading();
        LobiNotify('error', 'Inputs Cant Be Empty', 10000);
        return;
    }
    fetch(host + '/app/login', {
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
            redirectTo('/user')
        } else {
            LobiNotify('error', catchText, 10000)
        }
    }).catch((e) => {
        hideLoading();
        LobiNotify('error', catchText, 10000)
    })
}
