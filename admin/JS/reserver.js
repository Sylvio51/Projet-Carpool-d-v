const reserverBtns = document.querySelectorAll('.btn-reserver');

reserverBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const annonceId = btn.dataset.id;
        const confirmReservation = confirm('Voulez-vous vraiment réserver cette annonce ?');

        if (confirmReservation) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'reserver.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert(`Annonce ${annonceId} réservée avec succès !`);
                    } else {
                        alert('Une erreur s\'est produite lors de la réservation.');
                    }
                }
            };
            xhr.send('annonceId=' + annonceId);
        }
    });
});