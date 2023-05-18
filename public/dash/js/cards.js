let addCardBtn = document.querySelector('.add-card-btn');
let addCardForm = document.querySelector('.add-card-form');

let host = location.origin;
let urlPrefix = host + '/app/card/';
let headers = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Content-Type' : 'application/json'
};

window.addEventListener('load', () => {
    initAddCardBtnAction();
});

function initAddCardBtnAction() {
    addCardBtn.addEventListener('click', (e) => {
        e.preventDefault();
        processAddCard(addCardForm)
    })
} 

async function processAddCard(form) {
    let amount = form.elements.namedItem('amount').value;
    let type = form.elements.namedItem('type').value;
    let pin = form.elements.namedItem('pin').value;
    console.log(amount, type, pin)
    if(!!amount && !!type && !!pin){
        addCard(form);
    } else {
        // hideLoading();
        showErrorModal('Please fill up the box', ['addCardActionSheet']);
    }
}

async function addCard(form) {
    fetch(urlPrefix + 'add', {
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
            showErrorModal(errorMsg, ['addCardActionSheet']);
            console.log(errorMsg)
        }
        else if('success' in data){
            let successMsg = getResponse(data, 'success');
            showSuccessModal(successMsg, ['addCardActionSheet'])

            setTimeout(() => {
                location.reload()
            }, 3000);
        } else {
             hideLoading();
             console.log(data)  
             showErrorModal('something is not right!', ['addCardActionSheet']); 
        }
    }).catch((err) => {
        console.log(err);
         hideLoading();
         showErrorModal('something is not right!', ['addCardActionSheet']);
    });
}
