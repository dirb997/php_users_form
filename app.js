const successAlert = document.getElementById('successAlert');
const errorAlert = document.getElementById('errorAlert');

if (successAlert) {
    setTimeout(() => {
        const successAlertInstance = new bootstrap.Alert(successAlert);
        successAlertInstance.close();
    }, 3000)
}

if (errorAlert){
    setTimeout(() => {
        const errorAlertInstance = new bootstrap.Alert(errorAlert);
        errorAlertInstance.close();
    }, 3000);
}