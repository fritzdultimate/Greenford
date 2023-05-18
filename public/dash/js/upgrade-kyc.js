let host = location.origin;
let urlPrefix = host + '/app/user/';
let headers = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Content-Type' : 'application/json'
};

async function processUpgradeKyc(){
    if(true){
        console.log(KYCTOUPGRADETO, USERFORKYCID)
        fetch(urlPrefix + 'upgrade-kyc', {
            method : 'post',
            headers,
            body : JSON.stringify({
                'id': USERFORKYCID,
                'kyc_level' : KYCTOUPGRADETO
            })
        }).then((res) => {
            return res.json();
        })
        .then((data) => {
            if('errors' in data){
                let errorMsg = getResponse(data);
                showErrorModal(errorMsg, []);
                console.log(errorMsg)
            }
            else if('success' in data){
                let successMsg = getResponse(data, 'success');
                showSuccessModal(successMsg, [])
                USERFORKYCID = null;
                KYCTOUPGRADETO = 'tier 2';
            } else {
                 console.log(data)  
                 showErrorModal('something is not right!', []); 
            }
        }).catch((err) => {
            console.log(err);
             showErrorModal('something is not right!', []);
        });
    }
}
