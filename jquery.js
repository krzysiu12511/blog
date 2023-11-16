document.addEventListener('DOMContentLoaded', function() {
    // Złap formularz
    var form = document.getElementById('yourFormId'); // Zmień 'yourFormId' na rzeczywiste ID Twojego formularza

    // Nasłuchuj na zdarzenie przesyłania formularza
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Zatrzymaj standardowe przesyłanie formularza

        // Utwórz obiekt FormData do przesyłania danych formularza
        var formData = new FormData(form);

        // Wyślij zapytanie AJAX
        fetch('script.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Wyświetl komunikat sukcesu za pomocą SweetAlert2
                Swal.fire({
                    title: 'Sukces!',
                    text: 'Post został dodany do bazy pomyślnie.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else {
                // Obsłuż błąd (opcjonalnie)
                console.error('Wystąpił błąd podczas dodawania postu.');
            }
        })
        .catch(error => {
            console.error('Wystąpił błąd podczas wysyłania zapytania AJAX:', error);
        });
    });
});
