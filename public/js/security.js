let securityForm = document.querySelector('.security-form');
let host = location.origin;
let catchText = "Sorry. something went wrong";

window.addEventListener('load', () => {
    initSecurityFormAction();
});

function initSecurityFormAction(){
    securityForm.addEventListener('submit', (e) => {
        e.preventDefault();
        showLoading();
        processChangePass(e.currentTarget);
    });
}
function processChangePass(form){
    if(hasEmptyField(form)){
        hideLoading();
        lobiAlert('error', "Inputs Cant Be Empty", 10000);
        return;
    }
    fetch(host + '/app/security', {
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
            lobiAlert('error', errorMsg, 10000);
        } else if('success' in data){
            let successMsg = getResponse(data, 'success');
            lobiAlert("success", successMsg, 10000);
        } else {
            lobiAlert('error', catchText);
        }
    }).catch((e) => {
        lobiAlert('error', catchText);
    })
}
