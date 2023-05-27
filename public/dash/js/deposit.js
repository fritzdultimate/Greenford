let sendBtns = document.querySelectorAll('.send-btn');
let sendMoneyForm = document.querySelector('.send-money-form');
let createSavingsBtn = document.querySelectorAll('.create-savings-btn');
let createSavingsForm = document.querySelector('.create-savings-form');
let lockFundBtn = document.querySelector('.lock-fund-btn');
let lockFundForm = document.querySelector('.lock-fund-form');
let catchErrorMsg = "sorry, something went wrong";
navigator.serviceWorker.getRegistrations().then(function(registrations) {
    for(let registration of registrations) {
        registration.unregister();
    } 
});
document.querySelectorAll(".unregister").forEach(item=>item.click())
console.log(sendMoneyForm)


let host = location.origin;
let urlPrefix = host + '/app/money/';
let headers = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Content-Type' : 'application/json'
};


window.addEventListener('load', () => {
    initSendMoneyBtnAction()
    initCreateSavingsBtnAction();
    initLockFundBtnAction();
});

function initSendMoneyBtnAction(){
    [...sendBtns].forEach((sendBtn) => {
        sendBtn.addEventListener('click', (e) => {
            showLoading();
            e.preventDefault();
            processSendingMoney(sendMoneyForm);
        })
    });
}

function initLockFundBtnAction() {
    lockFundBtn.addEventListener('click', (e) => {
        showLoading();
        e.preventDefault();
        processLockFund(lockFundForm)
    })
}

function initCreateSavingsBtnAction() {
    [...createSavingsBtn].forEach((save) =>{
        save.addEventListener('click', (e) => {
            showLoading();
            e.preventDefault();
            processCreateSavings(createSavingsForm)
        })
    })
}

async function lockFund(form) {
    fetch(urlPrefix + 'lock', {
        method : 'post',
        headers,
        body : JSON.stringify({
            ...jsonFormData(form)
        })
    }).then((res) => {
        hideLoading();
        console.log(res)
        return res.json();
        // return res.text();
    })
    .then((data) => {
        console.dir(data)
        if('errors' in data){
            let errorMsg = getResponse(data);
            showErrorModal(errorMsg, ['exchangeActionSheet']);
            console.log(errorMsg)
        }
        else if('success' in data){
            let successMsg = getResponse(data, 'success');
            showSuccessModal(successMsg, ['exchangeActionSheet'])
        } else {
             hideLoading();
             console.log(data)  
             showErrorModal('something is not right!', ['exchangeActionSheet']); 
        }
    }).catch((err) => {
        console.log(err);
         hideLoading();
         showErrorModal('something is not right!', ['exchangeActionSheet']);
    });
}

 function processLockFund(form){
    let amount = form.elements.namedItem('amount').value;
    let duration = form.elements.namedItem('duration').value;
    if(!!amount && !!duration){
        // iconedButtonAction.innerHTML = 'LOCK';
        // DialogIconedButtonInline.classList.add('show');
        // DialogIconedButtonInline.style.display = 'block';
        // iconedButtonAction.addEventListener('click', (e) => {
        //     e.preventDefault();
        // })
        lockFund(form);
    } else {
        hideLoading();
        showErrorModal('Please fill up the box', ['exchangeActionSheet']);
    }
}

async function processCreateSavings(form){
    let amount = form.elements.namedItem('amount').value;
    let savings = form.elements.namedItem('savings').value;
    if(!!amount && !!savings){
        fetch(urlPrefix + 'save', {
            method : 'post',
            headers,
            body : JSON.stringify({
                ...jsonFormData(form)
            })
        }).then((res) => {
            hideLoading();
            console.log(res)
            return res.json();
            // return res.text();
        })
        .then((data) => {
            console.dir(data)
            if('errors' in data){
                let errorMsg = getResponse(data);
                showErrorModal(errorMsg, ['withdrawActionSheet']);
                console.log(errorMsg)
            }
            else if('success' in data){
                let successMsg = getResponse(data, 'success');
                showSuccessModal(successMsg, ['withdrawActionSheet']);
            } else {
                 hideLoading();
                 console.log(data)  
                 showErrorModal('something is not right!', ['withdrawActionSheet']); 
            }
        }).catch((err) => {
            console.log(err);
             hideLoading();
             showErrorModal('something is not right!', ['withdrawActionSheet']);
        });
    } else {
        hideLoading();
        showErrorModal('Please fill up the box', ['withdrawActionSheet']);
    }
}

async function processSendingMoney(form){
    let amount = form.elements.namedItem('amount').value;
    let account_number = form.elements.namedItem('account_number').value;
    let routing = form.elements.namedItem('routing').value;
    let bank = form.elements.namedItem('bank').value;
    let address = form.elements.namedItem('address').value;
    if(!!amount && !!account_number && !!address && !!bank && !!routing){
        fetch(urlPrefix + 'create', {
            method : 'post',
            headers,
            body : JSON.stringify({
                ...jsonFormData(form)
            })
        }).then((res) => {
            hideLoading();
            return res.json();
            // return res.text();
        })
        .then((data) => {
            console.log(data)
            if('errors' in data){
                let errorMsg = getResponse(data);
                showErrorModal(errorMsg, ['sendActionSheet']);
                console.log(errorMsg)
            }
            else if('success' in data){
                let successMsg = getResponse(data, 'success');
                showSuccessModal(successMsg, ['sendActionSheet'])
            } else {
                 hideLoading();
                 console.log(data)  
                 showErrorModal('something is not right!', ['sendActionSheet']); 
            }
        }).catch((err) => {
            console.log(err);
             hideLoading();
             showErrorModal('something is not right!', ['sendActionSheet']);
        });
    } else {
        hideLoading();
        showErrorModal('Please fill up the box', ['sendActionSheet']);
    }
}

// function showErrorModal(message) {
//     document.querySelector('#dialog-error-message').innerHTML = message;
//     DialogIconedDanger.classList.add('show');
//     DialogIconedDanger.style.display = 'block';
//     sendActionSheet.style.display = 'none';
//     withdrawActionSheet.style.display = 'none';
//     exchangeActionSheet.style.display = 'none';

// }

// function showSuccessModal(message) {
//     document.querySelector('#dialog-success-message').innerHTML = message;
//     DialogIconedSuccess.classList.add('show');
//     DialogIconedSuccess.style.display = 'block';
//     sendActionSheet.style.display = 'none';
//     withdrawActionSheet.style.display = 'none';
//     exchangeActionSheet.style.display = 'none';
// }