let createGoalBtns = document.querySelectorAll('.create-goal');
let createSavingsGoalForm = document.querySelector('.create-savings-goal-form');
let catchErrorMsg = "sorry, something went wrong";


let host = location.origin;
let urlPrefix = host + '/app/money/';
let headers = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Content-Type' : 'application/json'
};


window.addEventListener('load', () => {
    initSendMoneyBtnAction()
});

function initSendMoneyBtnAction(){
    [...createGoalBtns].forEach((goalBtn) => {
        goalBtn.addEventListener('click', (e) => {
            e.preventDefault();
            processSendingMoney(createSavingsGoalForm);
        })
    });
}

async function processSendingMoney(form){
    let target = form.elements.namedItem('target').value;
    let name = form.elements.namedItem('name').value;
    let description = form.elements.namedItem('description').value;
    let term = form.elements.namedItem('agree');
    console.log(term.checked)
    if(!!target && !!name){
        fetch(urlPrefix + 'create-savings-goal', {
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
            if('errors' in data){
                let errorMsg = getResponse(data);
                showErrorModal(errorMsg);
                console.log(errorMsg)
            }
            else if('success' in data){
                let successMsg = getResponse(data, 'success');
                showSuccessModal(successMsg)
            } else {
                 hideLoading();
                 console.log(data)  
                 showErrorModal('something is not right!'); 
            }
        }).catch((err) => {
            console.log(err);
             hideLoading();
             showErrorModal('something is not right!');
        });
    } else {
        // hideLoading();
        showErrorModal('Please fill up the box');
    }
}

function showErrorModal(message) {
    document.querySelector('#dialog-error-message').innerHTML = message;
    DialogIconedDanger.classList.add('show');
    DialogIconedDanger.style.display = 'block';
}

function showSuccessModal(message) {
    document.querySelector('#dialog-success-message').innerHTML = message;
    DialogIconedSuccess.classList.add('show');
    DialogIconedSuccess.style.display = 'block';
}