function deleteCard() {
    fetch(location.origin + '/app/card/delete/' + cardId, {
        method : 'delete',
        headers,
    }).then((res) => {
        console.log(res)
        return res.json();
        // return res.text();
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
            showSuccessModal(successMsg, [])

            setTimeout(() => {
                location.reload()
            }, 3000);
        } else {
             hideLoading();
             console.log(data)  
             showErrorModal('something is not right!', []); 
        }
    }).catch((err) => {
        console.log(err);
         hideLoading();
         showErrorModal('something is not right!', []);
    });
}