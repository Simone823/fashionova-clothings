// Mostra o nascondi i colori della taglia quando cambia il checkbox della taglia
toggleSizeColorsVisibility = (event) => {
    const checkboxSize = event.target;
    const sizeId = checkboxSize.getAttribute('data-size-id');
    const sizeColors = jQuery(`div[id=size-colors-${sizeId}]`);

    if (checkboxSize.checked) {
        sizeColors.removeClass('d-none');
    } else {
        // resetta i campi input delle quantità dei colori
        sizeColors.find('input[type="number"]').each(function () {
            setValueOnInput(this.id, "");
        });

        sizeColors.removeClass('d-block').addClass('d-none');
    }
}

// Mostra o nascondi input file image quando cambia la quantità del colore
toggleImageInputs = (sizeId, colorId) => {
    const quantityInput = document.getElementById(`size-${sizeId}-${colorId}-quantity_available`);
    const imageInput = document.getElementById(`images_colors-${colorId}`);

    // recupero tutti gli input delle quantità che corrispondono al pattern
    const otherQuantities = document.querySelectorAll(`input[id^="size-"][id$="-${colorId}-quantity_available"]`);

    // constrollo se almeno una delle altre taglie ha una quantità maggiore di 0 per lo stesso colore
    let hasOtherQuantities = Array.from(otherQuantities).some(input => {
        return input != quantityInput && parseInt(input.value.trim()) > 0;
    });

    /* 
    se la quantità dell'input corrente è maggiore di 0 o non vuota oppure se
    almeno una delle altre taglie ha quantità > 0 per lo stesso colore, mostra l'input immagine
    */
    if ((parseInt(quantityInput.value) > 0 && quantityInput.value != "") || hasOtherQuantities) {
        showInput(imageInput.id);
    } else {
        hideInput(imageInput.id);
    }
}