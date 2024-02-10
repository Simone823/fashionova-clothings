// Mostra o nascondi i colori della taglia quando cambia il checkbox della taglia
toggleSizeColorsVisibility = (event) => {
    const checkboxSize = event.target;
    const sizeId = checkboxSize.value;
    const sizeColors = document.getElementById('size-colors-' + sizeId);
    
    if (checkboxSize.checked) {
        sizeColors.classList.remove('d-none');
    } else {
        // resetta i campi input delle quantità dei colori
        sizeColors.querySelectorAll('input[type="number"]').forEach(quantity => {
            quantity.value = '';
        });
        
        sizeColors.classList.remove('d-block');
        sizeColors.classList.add('d-none');
    }
}