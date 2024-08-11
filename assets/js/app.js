const successAlert = document.getElementById('successAlert');
const errorAlert = document.getElementById('errorAlert');
const editAlert = document.getElementById('editAlert');
const addAlert = document.getElementById('addAlert');
const deleteAlert = document.getElementById('deleteAlert');
const infoAlert = document.getElementById('infoAlert');

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

document.getElementById('delete-btn').addEventListener('click', () => {
    let deleteButton = document.getElementById('delete-btn');
    deleteButton.addEventListener('click', () => {
        if (confirm('Are you sure you want to delete your user information?')) {
            fetch('delete-user.php', {
                method: 'DELETE',
                content: 'application/json',
                body: new URLSearchParams({
                    'user_id': '<?php echo $user_id; ?>'
                    })
            })
                .then(response => response.text())
                .then(result => {
                    if (result.status === 'success') {
                        location.replace("login.php");
                    }else {
                        alert("Error: " + result.status);
                    }
                })
                .catch(error => {
                    console.error(error);
                })
        }
    })

})