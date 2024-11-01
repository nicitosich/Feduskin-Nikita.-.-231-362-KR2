document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault(); 
    const formData = new FormData(this);

    fetch('contact_process.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('response-message').innerHTML = data;
        document.getElementById('response-message').style.display = 'block';
        this.reset();
    })
    .catch(error => {
        document.getElementById('response-message').innerHTML = "Ошибка отправки формы!";
        document.getElementById('response-message').style.display = 'block';
    });
});