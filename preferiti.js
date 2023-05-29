
const preferitiItems = document.querySelectorAll('.preferiti-item');

const images = document.querySelectorAll('img');

document.addEventListener('click', (event) => {
    const target = event.target;

    if (target.tagName === 'IMG') {
        const preferitoSRC = target.src;

        if (preferitoSRC !== '') {
            // Richiesta AJAX per rimuovere l'elemento dai preferiti
            fetch('rimuovi_preferito.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'preferitoSRC=' + preferitoSRC
            })
                .then(function (response) {
                    if (response.ok) {
                        console.log("Dati salvati correttamente nel database.");
                        // Rimuovi l'immagine dalla pagina
                         const parentDiv = target.closest('.preferiti-item');
                        if (parentDiv) {
                            parentDiv.remove();
                        }
                        
                    } else {
                        console.error("Errore durante il salvataggio dei dati nel database.");
                    }
                })
                .catch(function (error) {
                    console.error("Errore durante l'invio dei dati al backend:", error);
                });
        }
    }
});



function onResponse(response) {
    if(response.ok){
        console.log("sei response");
        return response.json();
    }
    return null;
}

