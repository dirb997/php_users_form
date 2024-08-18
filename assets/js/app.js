const successAlert = document.getElementById('successAlert');
const errorAlert = document.getElementById('errorAlert');
const editAlert = document.getElementById('editAlert');
const addAlert = document.getElementById('addAlert');
const deleteAlert = document.getElementById('deleteAlert');
const infoAlert = document.getElementById('infoAlert');
const deleteButton = document.getElementById('delete-btn');

// Set the alerts
if (successAlert) {
    setTimeout(() => {
        const successAlertInstance = new bootstrap.Alert(successAlert);
        successAlertInstance.close();
    }, 2000)
}

if (errorAlert){
    setTimeout(() => {
        const errorAlertInstance = new bootstrap.Alert(errorAlert);
        errorAlertInstance.close();
    }, 2000);
}

if (addAlert) {
    setTimeout(() => {
        const addAlertInstance = new bootstrap.Alert(addAlert);
        addAlertInstance.close();
    }, 2000)
}

if(infoAlert) {
    setTimeout(() => {
        const infoAlertInstance = new bootstrap.Alert(infoAlert);
        infoAlertInstance.close();
    }, 2000)
}


if(deleteAlert) {
    setTimeout(() => {
        const deleteAlertInstance = new bootstrap.Alert(deleteAlert);
        deleteAlertInstance.close();
    }, 3000)
}

// Set the edit menu logic
document.getElementById('edit-btn').addEventListener('click', () => {
    let editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
});
document.getElementById('save-btn').addEventListener('click', () => {
    let formData = new FormData(document.getElementById('editForm'));
    fetch('controllers/update_user.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Data edited successfully!');
                location.reload();
            } else {
                alert('Failed to save!');
            }
        })
        .catch(error => {
            console.error(error);
            alert(error);
        });
});

// Set the delete user's information logic
const userId = '<?php echo $user_id; ?>';
deleteButton.addEventListener('click', event => {
    if (confirm('Are you sure you want to delete your information?')) {
        fetch('controllers/delete_user.php', {
            method: 'DELETE',
            header: 'application/json',
            body: userId
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status === 'success') {
                    location.replace("/");
                }else{
                    alert('Failed to delete!');
                }
            })
    }
})