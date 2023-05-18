
            
            
fetch(host + '/app/money/' + 'savings-goals', {
    method : 'get',
    headers,
}).then((res) => {
    // console.log(res)
    return res.json();
    // return res.text();
})
.then((data) => {
    if('errors' in data){
        createSavingsGoalPan.style.display = 'block';
        modalContentSavings.style.display = 'none';
        console.log(errorMsg)
    }
    
}).catch((err) => {
    console.log(err);
        // hideLoading();
        // showErrorModal('something is not right!');
});