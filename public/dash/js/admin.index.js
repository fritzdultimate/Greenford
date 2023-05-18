let newsForm = document.querySelector('.news-form');
let host = location.origin;
let catchText = "Sorry. something went wrong";
let toggleSelectBtn = document.querySelector('.toggleSelectBtn');
let state = 'select';
 

window.addEventListener('load', () => {
    toggleSelectBtn.addEventListener('click', handleToggleSelect);
    initNewsFormAction();
});

function initNewsFormAction(){
    newsForm.addEventListener('submit', (e) => {
        e.preventDefault();
        showLoading();
        processNews(e.currentTarget);
    });
}
function processNews(form){
    if(hasEmptyField(form)){
        hideLoading();
        LobiNotify('error', 'Inputs Cant Be Empty', 10000);
        return;
    }
    let apiBody = jsonFormData(form);
    fetch(host + '/app/admin/newsletter', {
        method : 'POST',
        headers : {
            "Accept": "application/json",
            "X-CSRF-TOKEN": apiBody._token,
            'X-Requested-With' : 'XMLHttpRequest',
            'Content-Type' : 'application/json'
        },
        body : JSON.stringify({
            ...apiBody,
            receivers : [...document.querySelector('.select-plan').selectedOptions].map(e => e.value)
        })
    }).then((res) => {
        hideLoading();
        return res.json();
    }).then((data) => {
        if('errors' in data){
            let errorMsg = getResponse(data);
            LobiNotify('error', errorMsg, 10000)
        } else if('success' in data){
            let successMsg = getResponse(data, 'success');
            LobiNotify('success', successMsg, 10000)
        } else {
            LobiNotify('error', catchText, 10000)
        }
    }).catch((e) => {
        hideLoading();
        LobiNotify('error', catchText, 10000)
    })
}


function handleToggleSelect(){
	toggleSelect()
 	changeBtnAction();
}
function toggleSelect() {
  return state == 'select' ? selectAll() : deSelectAll();
}
function deSelectAll(){
	document.querySelector('select').selectedIndex = -1;
    state = 'select';
}
function selectAll(){
	let options = [... document.querySelector('select').options];
    options.forEach((option) => {
      option.selected = true;
    });
    state = 'deselect';
}
function changeBtnAction(){
	toggleSelectBtn.textContent = state + ' all users';
}