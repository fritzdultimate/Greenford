let withdrawalForm = document.querySelector('.withdrawal-form');
let catchErrorMsg = "sorry, something went wrong";
let hasWallet = !!(+document.querySelector('.account-contant').dataset.wallet);
let isKycVerified = document.querySelector('.account-contant').dataset.kyc == 'verified';
let host = location.origin;
let urlPrefix = host + '/app/withdrawal/';
let headers = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Content-Type' : 'application/json'
};
window.addEventListener('load', () => {
    if(isKycVerified) {
        if(!hasWallet){
            lobiAlert('error', "You haven't created any wallet yet");
        }
    } else {
        lobiAlert('error', "Please upload your KYC document, and wait for verification");
    }
    initWithdrawalFormAction();
});

function initWithdrawalFormAction(){
    withdrawalForm.addEventListener('submit', (e) => {
        e.preventDefault();
        showLoading();
        if(isKycVerified) {
            if(hasWallet){
                processWithdrawal(e.currentTarget);
            } else {
                lobiAlert('error', "You haven't created any wallet yet");
            }
        } else {
            lobiAlert('error', "Please upload your KYC document, and wait for verification");
        }
    });
}

function processWithdrawal(form){
    fetch(urlPrefix + 'create', {
        method : 'post',
        headers,
        body : JSON.stringify(jsonFormData(form))
    }).then((res) => {
        hideLoading();
        return res.json();
    })
    .then((data) => {
        // console.log(data)
        if('errors' in data){
            let errorMsg = getResponse(data);
            LobiNotify('error', errorMsg);
        }
        else if('success' in data){
            let successMsg = getResponse(data, 'success');
            lobiAlert('success', successMsg);
        } else {
            LobiNotify('error', catchErrorMsg);    
        }
     }).catch((err) => {
        LobiNotify('error', catchErrorMsg);
     });
}