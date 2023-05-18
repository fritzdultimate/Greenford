if(sessionStorage.changedPass){
    lobiAlert('success','Password Changed Successfully');
    sessionStorage.removeItem('changedPass');
}

let host = location.origin;
let depositApi = host + '/app/deposit/create';
let withdrawalApi = host + '/app/withdrawal/create';

let headers = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Content-Type' : 'application/json'
};
let depositForm = document.querySelector('.deposit-form');
let withdrawalForm = document.querySelector('.withdrawal-form');
let hasWallet = !!(+document.querySelector('.row-content').dataset.wallet);
let depositPauseBtns = [... document.querySelectorAll('.deposit-pause-btn')];

// let memoCont = document.querySelector('.memo-cont');
// console.log(memoCont);
let catchErrorMsg = "sorry, something went wrong";
let randomAddr = "my random wallet address";
let qrcode = null;
$('#deposit-modal').on('show.bs.modal',function() {
    drawQrCode();
});
$('#deposit-modal').on('hide.bs.modal',function() {
    qrcode.clear();
})
function makeCode () {
	var elText = document.querySelector(".clip-input");
	qrcode.makeCode(elText.value);
}

function setMinMax(elem){
    depositForm.elements.namedItem('amount').setAttribute('max', elem.dataset.max);
    depositForm.elements.namedItem('amount').setAttribute('min', elem.dataset.min);
}
// let sa = null;
function drawQrCode(){
    if(!qrcode){
        qrcode = new QRCode(document.querySelector(".wallet-qrcode"), {
            width : 110,
            height : 110,
            colorDark : "#092029",
        });
    }
    makeCode();
}
function handlePauseDeposit(btn){
    swal.close();
    fetch(host + '/app/user/deposit/pause', {
            method : 'post',
            headers,
            body : JSON.stringify({
                id : btn.dataset.id
            })
        }).then((res) => {
            unblockUI();
            return res.json();
            // return res.text();
        }).then((data) => {
            console.log(data);
            if('errors' in data){
                let errorMsg = getResponse(data);
                swal.fire("Oops...",errorMsg,"error")
            }
            else if('success' in data){
                $(btn).closest('tr')[0].remove();
                swal("Success","Deposit has been paused successfully","success");
            } else {
                swal.fire("Oops...",catchErrorMsg,"error");
            }
        }).catch((err) => {
            unblockUI();
            swal.fire("Oops...",catchErrorMsg,"error")
    });
}
window.addEventListener('load', () => {
    depositPauseBtns.forEach((depositPauseBtn) => {
        depositPauseBtn.addEventListener('click', () => {
            let btn = event.currentTarget;
            sa = swal({
                title:"Are you sure to pause active deposit?",
                text:"You will no longer receive interests for this deposits",
                type:"warning",showCancelButton:true,
                confirmButtonColor:"#DD6B55",
                confirmButtonText:"Yes, pause it",
                closeOnConfirm:false
            },
            function(){
                blockUI('<h4>Processing</h4>');
                handlePauseDeposit(btn);
            }
    );
        });
    });
    depositForm.addEventListener('submit', (e) => {
        e.preventDefault();
        showLoading();
        if(!hasWallet){
            swal.fire("Oops...","You haven't created any wallet yet","error")
        } else {
            processDeposit(e.currentTarget);
        }
    })
    withdrawalForm.addEventListener('submit', (e) => {
        e.preventDefault();
        showLoading();
        if(!hasWallet){
            swal.fire("Oops...","You haven't created any wallet yet","error")
        } else {
            processWithdrawal(e.currentTarget);
        }
    })
});

function makeCode () {
	var elText = document.querySelector(".clip-input");
	qrcode.makeCode(elText.value);
}
document.querySelector('#select-plan').addEventListener('change', (e) => {
    let select = e.currentTarget;
    let selected = select.selectedOptions[0];
    setMinMax(selected);
    console.log('worked');
});
// $('.plan-wrapper').on('change', 'select', function(){
//     let select = document.querySelector("#select-plan");
//     let selected = select.selectedOptions[0];
//     setMinMax(selected);
//     console.log('worked');
// });

new ClipboardJS('.clipboard-btn');

async function processDeposit(form){
    let amount = form.elements.namedItem('amount').value;
    let currencyIndex = form.elements.namedItem('user_wallet_id').selectedIndex;
    let selectedCurrency = form.elements.namedItem('user_wallet_id').options[currencyIndex];
    let currencySymbol = selectedCurrency.dataset.symbol;
    if(!!amount && !!currencyIndex){
        let selectedWalletRate = await tocrypto(currencySymbol);
        if(!selectedWalletRate) return [hideLoading(), swal.fire("Oops...","Unable to fetch currency rate","error")];
        fetch(depositApi, {
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
            console.log(data);
            if('errors' in data){
                let errorMsg = getResponse(data);
                // LobiNotify('error', errorMsg);
                swal.fire("Oops...",errorMsg,"error")
            }
            else if('success' in data){
                let successMsg = getResponse(data, 'success');
                totalAmount = selectedWalletRate * amount;
                let wallet = data['success']['wallet'];
                document.querySelector(".clip-input").value = wallet['currency_address'];
                document.querySelector('.deposit-amount').textContent = totalAmount;
                [... document.querySelectorAll('.deposit-wallet')].forEach((elem) => {
                    elem.textContent = currencySymbol;
                });
                if(!!(+wallet.has_memo)){
                    document.querySelector(".memo-input").value = wallet['memo_token'];
                    document.querySelector('.memo-cont').classList.remove('d-none');
                } else {
                    document.querySelector('.memo-cont').classList.add('d-none');
                }
                $('#deposit-modal').modal('show');
            } else {
                 hideLoading();
                // LobiNotify('error', catchErrorMsg);   
                swal.fire("Oops...",catchErrorMsg,"error")

            }
        }).catch((err) => {
            console.log(err);
             hideLoading();
            // LobiNotify('error', catchErrorMsg);
            swal.fire("Oops...",catchErrorMsg,"error")

        });
    } else {
        hideLoading();
        // LobiNotify('error', "Fields can't be empty");
        swal.fire("Oops...","Fields can't be empty","error")

    }
}

async function tocrypto(symbol) {
    try {
        // let response = await fetch(`https://min-api.cryptocompare.com/data/price?fsym=usd&tsyms=${symbol}`, {
        //     method: 'GET'
        // });
        // let result = await response.json();
        // return result[symbol.toUpperCase()];
        return 12;
    } catch {
        return false;
    }
}

function showDepositModal(elem){
    depositForm.elements.namedItem('child_plan_id').value = elem.dataset.plan;
    setMinMax(elem);
    // $('#select-plan').niceSelect('update');
    // drawQrCode();
    $('#deposit-modal').modal('show');
}
function processWithdrawal(form){
    fetch(withdrawalApi, {
        method : 'POST',
        headers,
        body : JSON.stringify(jsonFormData(form))
    }).then((res) => {
        hideLoading();
        return res.json();
    })
    .then((data) => {
        if('errors' in data){
            let errorMsg = getResponse(data);
            swal.fire("Oops...",errorMsg,"error")
        }
        else if('success' in data){
            let successMsg = getResponse(data, 'success');
            swal.fire("Success",successMsg,"success")
        } else {
            swal.fire("Oops...",catchErrorMsg,"error")
        }
     }).catch((err) => {
        swal.fire("Oops...",catchErrorMsg,"error")
     });
}

// depositPauseBtns.