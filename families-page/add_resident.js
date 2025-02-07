document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('form').addEventListener('submit', function (event) {
        event.preventDefault();

        const form = event.target;

        console.log("Submitting form...");

        fetch('process_add_resident.php', {
            method: 'POST',
            body: new FormData(form)
        })
            .then(response => {
                console.log("Response received:", response);
                return response.json();
            })
            .then(data => {
                console.log("Data received:", data);
                if (data.status === 'success') {
                    alert(data.message);
                    window.location.href = '../residents-page/residents.php';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing your request.');
            });
    });
});
