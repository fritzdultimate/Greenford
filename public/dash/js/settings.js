let host = location.origin;
let urlPrefix = host + '/app/setting/';
let headers = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Content-Type' : 'application/json'
};

let changePasswordBtn = document.querySelector('.change-password-btn');
let changePasswordForm = document.querySelector('.change-password-form');

window.addEventListener('load', () => {
    initChangePasswordBtnAction();
});

function initChangePasswordBtnAction() {
    changePasswordBtn.addEventListener('click', (e) => {
        e.preventDefault();
        processChangePassword(changePasswordForm)
    })
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