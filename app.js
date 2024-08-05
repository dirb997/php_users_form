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

// Set the edit menu logic
document.getElementById('edit-btn').addEventListener('click', () => {
    let editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
});

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
            } else {
                alert('Failed to save!');
            }
        })
        .catch(error => {
            console.log(error);
            alert(error);
        });
});