let host = location.origin;
let urlPrefix = host + '/app/user/';
let headers = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Content-Type' : 'application/json'
};

async function processSuspendUser(){
    if(true){
        fetch(urlPrefix + 'toggle-suspend', {
            method : 'post',
            headers,
            body : JSON.stringify({
                'id': SUSPENDINGUSERID
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
                SUSPENDINGUSERID = null;
            } else {
                 console.log(data)  
                 showErrorModal('something is not right!', ['sendActionSheet']); 
            }
        }).catch((err) => {
            console.log(err);
             showErrorModal('something is not right!', []);
        });
    }
}

async function processBlockUser(){
    if(true){
        fetch(urlPrefix + 'toggle-block', {
            method : 'post',
            headers,
            body : JSON.stringify({
                'id': BLOCKINGINGUSERID
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
                BLOCKINGINGUSERID = null;
            } else {
                 console.log(data)  
                 showErrorModal('something is not right!', ['sendActionSheet']); 
            }
        }).catch((err) => {
            console.log(err);
             showErrorModal('something is not right!', []);
        });
    }
}

async function processDeleteUser(){
    if(true){
        fetch(urlPrefix + 'delete-user', {
            method : 'post',
            headers,
            body : JSON.stringify({
                'id': DELETINGUSERID
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
                DELETINGUSERID = null;
            } else {
                 console.log(data)  
                 showErrorModal('something is not right!', ['sendActionSheet']); 
            }
        }).catch((err) => {
            console.log(err);
             showErrorModal('something is not right!', []);
        });
    }
}
