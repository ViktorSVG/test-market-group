import * as bootstrap from 'bootstrap';
window.onload = (e)=>{
    window.VacationModalObj = new VacationModal;
    const toastElList = document.querySelectorAll('.toast');
    const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));
    toastList.forEach(toast => toast.show());
    setTimeout(function (){
        toastList.forEach(toast => toast.hide());
    }, 5000);
};
