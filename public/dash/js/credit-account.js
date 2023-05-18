let creditAccountBtn = document.querySelector('.credit-account-btn');
let creditAccountForm = document.querySelector('.credit-account-form');

let host = location.origin;
let urlPrefix = host + '/app/account/';
let headers = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Content-Type' : 'application/json'
}

window.addEventListener('load', () => {
    initcreditAccountBtnAction();
});

function initcreditAccountBtnAction() {
    creditAccountBtn.addEventListener('click', (e) => {
        e.preventDefault();
        processCreditAccount(creditAccountForm)
    })
}

async function processCreditAccount(form){
    let amount = form.elements.namedItem('amount').value;
    if(!!amount){
        fetch(urlPrefix + 'credit', {
            method : 'post',
            headers,
            body : JSON.stringify({
                ...jsonFormData(form)
            })
        }).then((res) => {
            console.log(res)
            return res.json();
        })
        .then((data) => {
            console.dir(data)
            if('errors' in data){
                let errorMsg = getResponse(data);
                showErrorModal(errorMsg, []);
                console.log(errorMsg)
            }
            else if('success' in data){
                let successMsg = getResponse(data, 'success');
                showSuccessModal(successMsg, []);
            } else {
                 hideLoading();
                 console.log(data)  
                 showErrorModal('something is not right!', ['withdrawActionSheet']); 
            }
        }).catch((err) => {
            console.log(err);
             showErrorModal('something is not right!', []);
        });
    } else {
        // hideLoading();
        showErrorModal('Please fill up the box', []);
    }
}