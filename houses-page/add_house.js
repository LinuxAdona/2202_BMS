document.querySelector('form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission

    var formData = new FormData(this); // Get form data

    fetch('process_add_house.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message); // Show success message
                this.reset(); // Reset the form
            } else {
                alert(data.message); // Show error message
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while adding the resident.');
        });
});