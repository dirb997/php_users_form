const successAlert = document.getElementById('successAlert');
const errorAlert = document.getElementById('errorAlert');
const editAlert = document.getElementById('editAlert');
const addAlert = document.getElementById('addAlert');

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

if (addAlert) {
    setTimeout(() => {
        const addAlertInstance = new bootstrap.Alert(addAlert);
        addAlertInstance.close();
    }, 2000)
}

// Set the edit menu logic
document.getElementById('edit-btn').addEventListener('click', () => {
    let editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
});
if (editAlert){
    setTimeout(() => {
        const editAlertInstance = new bootstrap.Alert(editAlert);
        editAlertInstance.close();
    }, 3000);
}
document.getElementById('save-btn').addEventListener('click', () => {
    let formData = new FormData(document.getElementById('editForm'));
    fetch('update-user.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
                alert('Data edited successfully!')
            } else {
                alert('Failed to save!');
            }
        })
        .catch(error => {
            console.error(error);
            alert(error);
        });
});