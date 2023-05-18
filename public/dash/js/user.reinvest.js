
let reinvestForm = document.querySelector('.reinvest-form');
let catchErrorMsg = "sorry, something went wrong";
let memoCont = document.querySelector('.memo-cont');


let randomAddr = "my random wallet address";
let qrcode = null;
let host = location.origin;
let urlPrefix = host + '/app/deposit/';
let headers = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Content-Type' : 'application/json'
};
let hasWallet = !!(+document.querySelector('.plan_investment_wrapper').dataset.wallet);

$('#success-modal').on('show.bs.modal',function() {
    if(!qrcode){
        qrcode = new QRCode(document.querySelector(".wallet-qrcode"), {
            width : 110,
            height : 110,
            colorDark : "#092029",
        });
    }
    makeCode();
});
window.addEventListener('load', () => {
    if(!hasWallet){
        lobiAlert('error', "You haven't created any wallet yet");
    }
})
$('#success-modal').on('hide.bs.modal',function() {
    qrcode.clear();
})
function makeCode () {
	var elText = document.querySelector(".clip-input");
	qrcode.makeCode(elText.value);
}


window.addEventListener('load', () => {
    initReinvestFormAction();
});

$('.plan-wrapper').on('change', 'select', function(){
    let select = document.querySelector("#select-plan");
    let selected = select.selectedOptions[0];
    setMinMax(selected);
    console.log('worked now');
});

new ClipboardJS('.clipboard-btn');

function setMinMax(elem){
    reinvestForm.elements.namedItem('amount').setAttribute('max', elem.dataset.max);
    reinvestForm.elements.namedItem('amount').setAttribute('min', elem.dataset.min);
}

function initReinvestFormAction(){
    reinvestForm.addEventListener('submit', (e) => {
        e.preventDefault();
        if(!hasWallet){
            lobiAlert('error', "You haven't created any wallet yet");
            return;
        }
         console.log('before showloading');
        showLoading();
        console.log('showloading');
        processReinvest(e.currentTarget);
    });
}

async function processReinvest(form){
    console.log('process form')
    let amount = form.elements.namedItem('amount').value;
    if(!!amount){
        fetch(urlPrefix + 'reinvest', {
            method : 'post',
            headers,
            body : JSON.stringify({
                ...jsonFormData(form)
            })
        }).then((res) => {
            console.log('before loading')
            hideLoading();
            console.log('after loading')
            return res.json();
            // return res.text();
        })
        .then((data) => {
            console.log(data);
            if('errors' in data){
                console.log(data);
                let errorMsg = getResponse(data);
                LobiNotify('error', errorMsg);
            }
            else if('success' in data){
                LobiNotify('success', 'Reinvestment created successfully');
                // alert('Reinvestment created successfully');
            } else {
                console.log('data');
                 hideLoading();
                LobiNotify('error', catchErrorMsg);    
            }
        }).catch((err) => {
            console.log(err);
             hideLoading();
            LobiNotify('error', catchErrorMsg);
        });
    } else {
        console.log('err');
        hideLoading();
        LobiNotify('error', "Fields can't be empty");
    }
}

