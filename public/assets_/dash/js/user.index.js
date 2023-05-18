if(sessionStorage.changedPass){
    lobiAlert('success','Password Changed Successfully');
    sessionStorage.removeItem('changedPass');
}