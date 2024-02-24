$(document).ready(function () {
    // controllo se siamo nella view '#guest-products-show'
    if ($('#guest-products-show').length > 0) {
        // Array per salvare gli elementi rimossi
        let removedCarouselItems = [];

        // Mostra solo i carousel-item corrispondenti al colore selezionato di default al caricamento della pagina
        updateCarouselItems();

        // quando cambia il colore aggiorno le immagini
        $('input[type="radio"][name="color_id"]').change(function () {
            // riappendo gli elementi rimossi se ce ne sono
            if (removedCarouselItems.length > 0) {
                $('#carouselImages .carousel-inner').append(removedCarouselItems);
                removedCarouselItems = [];
            }

            // aggiorno i carousel-item in base al colore selezionato
            updateCarouselItems();
        });

        // Funzione per controllare il path dell'immagine e rimuovere o aggiungere il carousel-item se necessario
        function updateCarouselItems() {
            const selectedColorName = $('input[type="radio"][name="color_id"]:checked').attr('data-color-name');

            // Ricerca e rimozione immediata dei carousel-item che non corrispondono al colore selezionato
            $('.carousel-item').each(function () {
                const imagePath = $(this).find('.image-product').attr('src');
                
                if (imagePath.indexOf(selectedColorName) === -1) {
                    // rimuovo e pusho il carousel-item rimosso
                    removedCarouselItems.push($(this).detach());
                }
            });

            // Imposta come attivo il primo carousel-item rimasto
            $('.carousel-item').first().addClass('active');
        }
    }
});