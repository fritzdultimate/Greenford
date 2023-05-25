let host = location.origin;
let urlPrefix = host + '/app/setting/';
let headers = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Content-Type' : 'application/json'
};

let changePasswordBtn = document.querySelector('.change-password-btn');
let changePasswordForm = document.querySelector('.change-password-form');

let setPinBtn = document.querySelector('.set-pin-btn');
let setPinForm = document.querySelector('.set-pin-form');

let setCurrencyBtn = document.querySelector('.set-currency-btn');
let setCurrencyForm = document.querySelector('.set-currency-form');

window.addEventListener('load', () => {
    initChangePasswordBtnAction();
    initSetPinBtnAction()
    initChangeCurrencyBtnAction()
});

function initChangePasswordBtnAction() {
    changePasswordBtn.addEventListener('click', (e) => {
        e.preventDefault();
        processChangePassword(changePasswordForm)
    })
}

function initChangeCurrencyBtnAction() {
    setCurrencyBtn.addEventListener('click', (e) => {
        e.preventDefault();
        processChangeCurrency(setCurrencyForm)
    })
}

function initSetPinBtnAction() {
    console.log('pin')
    setPinBtn.addEventListener('click', (e) => {
        e.preventDefault();
        processSetPin(setPinForm)
    })
}

async function processChangeCurrency(form){
    let currency = form.elements.namedItem('currency').value;
    let currency_name = form.elements.namedItem('currency').options[form.elements.namedItem('currency').selectedIndex].outerText;
    console.log(currency_name)
    // let confirm_password = form.elements.namedItem('confirm_password').value;
    if(!!currency){
        fetch(urlPrefix + 'changeCurrency', {
            method : 'post',
            headers,
            body : JSON.stringify({
                ...jsonFormData(form),
                'currency_name': currency_name
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
                showErrorModal(errorMsg, ['currencyFormActionSheet']);
                console.log(errorMsg)
            }
            else if('success' in data){
                let successMsg = getResponse(data, 'success');
                showSuccessModal(successMsg, ['currencyFormActionSheet']);
            } else {
                 hideLoading();
                 console.log(data)  
                 showErrorModal('something is not right!', ['currencyFormActionSheet']); 
            }
        }).catch((err) => {
            console.log(err);
             hideLoading();
             showErrorModal('something is not right!', ['currencyFormActionSheet']);
        });
    } else {
        // hideLoading();
        showErrorModal('Please fill up the box', ['currencyFormActionSheet']);
    }
}

async function processChangePassword(form){
    let password = form.elements.namedItem('password').value;
    let confirm_password = form.elements.namedItem('confirm_password').value;
    if(!!password && !!confirm_password){
        fetch(urlPrefix + 'changePassword', {
            method : 'post',
            headers,
            body : JSON.stringify({
                ...jsonFormData(form)
            })
        }).then((res) => {
            console.log(res)
            return res.json();
            // return res.text();
        })
        .then((data) => {
            console.dir(data)
            if('errors' in data){
                let errorMsg = getResponse(data);
                showErrorModal(errorMsg, ['passwordFormActionSheet']);
                console.log(errorMsg)
            }
            else if('success' in data){
                let successMsg = getResponse(data, 'success');
                showSuccessModal(successMsg, ['passwordFormActionSheet']);
            } else {
                 hideLoading();
                 console.log(data)  
                 showErrorModal('something is not right!', ['passwordFormActionSheet']); 
            }
        }).catch((err) => {
            console.log(err);
             hideLoading();
             showErrorModal('something is not right!', ['passwordFormActionSheet']);
        });
    } else {
        // hideLoading();
        showErrorModal('Please fill up the box', ['passwordFormActionSheet']);
    }
}

async function processSetPin(form){
    let password = form.elements.namedItem('password').value;
    let pin = form.elements.namedItem('pin').value;
    if(!!password && !!pin){
        fetch(urlPrefix + 'setpin', {
            method : 'post',
            headers,
            body : JSON.stringify({
                ...jsonFormData(form)
            })
        }).then((res) => {
            console.log(res)
            return res.json();
            // return res.text();
        })
        .then((data) => {
            console.dir(data)
            if('errors' in data){
                let errorMsg = getResponse(data);
                showErrorModal(errorMsg, ['pinFormActionSheet']);
                console.log(errorMsg)
            }
            else if('success' in data){
                let successMsg = getResponse(data, 'success');
                showSuccessModal(successMsg, ['pinFormActionSheet']);
            } else {
                 hideLoading();
                 console.log(data)  
                 showErrorModal('something is not right!', ['pinFormActionSheet']); 
            }
        }).catch((err) => {
            console.log(err);
             hideLoading();
             showErrorModal('something is not right!', ['pinFormActionSheet']);
        });
    } else {
        // hideLoading();
        showErrorModal('Please fill up the box', ['pinFormActionSheet']);
    }
}

function toggleMode() {
    let mode = darkmodeSwitch.checked;

    fetch(urlPrefix + 'toggleMode', {
        method : 'post',
        headers,
        body : JSON.stringify({
            'dark_mode' : mode
        })
    }).then((res) => {
        console.log(res)
        return res.json();
        // return res.text();
    })
    .then((data) => {
        console.dir(data)
        if('errors' in data){
            let errorMsg = getResponse(data);
            console.log(errorMsg)
        }
        else if('success' in data){
            let successMsg = getResponse(data, 'success');
            console.log(successMsg)
        } else {
             console.log(data) 
        }
    }).catch((err) => {
        console.log(err);
    });
}

function toggleTransactionEmails() {
    let email_transactions_enabled = SwitchCheckDefault1.checked;

    fetch(urlPrefix + 'toggleTransactionEmails', {
        method : 'post',
        headers,
        body : JSON.stringify({
            'transaction_emails' : email_transactions_enabled
        })
    }).then((res) => {
        console.log(res)
        return res.json();
        // return res.text();
    })
    .then((data) => {
        console.dir(data)
        if('errors' in data){
            let errorMsg = getResponse(data);
            console.log(errorMsg)
        }
        else if('success' in data){
            let successMsg = getResponse(data, 'success');
            console.log(successMsg)
        } else {
             console.log(data) 
        }
    }).catch((err) => {
        console.log(err);
    });
}

function toggleTwoFactor() {
    let twofac = SwitchCheckDefault3.checked;
    console.log(twofac)

    fetch(urlPrefix + 'toggleTwoFactor', {
        method : 'post',
        headers,
        body : JSON.stringify({
            'twofac' : twofac
        })
    }).then((res) => {
        console.log(res)
        return res.json();
        // return res.text();
    })
    .then((data) => {
        console.dir(data)
        if('errors' in data){
            let errorMsg = getResponse(data);
            console.log(errorMsg)
        }
        else if('success' in data){
            let successMsg = getResponse(data, 'success');
            console.log(successMsg)
        } else {
             console.log(data) 
        }
    }).catch((err) => {
        console.log(err);
    });
}

function processLogoutAllDevice() {
    console.log('yabio')
    let twofac = SwitchCheckDefault3.checked;
    console.log(twofac)

    fetch(urlPrefix + 'logOutOtherDevices', {
        method : 'post',
        headers,
        body : JSON.stringify({
            
        })
    }).then((res) => {
        console.log(res)
        return res.json();
        // return res.text();
    })
    .then((data) => {
        console.dir(data)
        if('errors' in data){
            let errorMsg = getResponse(data);
            showErrorModal(errorMsg, ['DialogIconedButtonInline']);
            console.log(errorMsg)
        }
        else if('success' in data){
            let successMsg = getResponse(data, 'success');
            console.log(successMsg)
            LOGOUTALLDEVICES = false;
            showSuccessModal(successMsg, ['DialogIconedButtonInline']);
        } else {
             console.log(data) 
        }
    }).catch((err) => {
        showErrorModal('something went wrong', ['DialogIconedButtonInline']);
    });
}

function updateAddress() {
    let email_transactions_enabled = SwitchCheckDefault1.checked;

    fetch(urlPrefix + 'toggleTransactionEmails', {
        method : 'post',
        headers,
        body : JSON.stringify({
            'transaction_emails' : email_transactions_enabled
        })
    }).then((res) => {
        console.log(res)
        return res.json();
        // return res.text();
    })
    .then((data) => {
        console.dir(data)
        if('errors' in data){
            let errorMsg = getResponse(data);
            console.log(errorMsg)
        }
        else if('success' in data){
            let successMsg = getResponse(data, 'success');
            console.log(successMsg)
        } else {
             console.log(data) 
        }
    }).catch((err) => {
        console.log(err);
    });
}