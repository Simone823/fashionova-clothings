// APRI UN MODAL QUANDO SI VERIFICANO ERRORI DI VALIDAZIONE
openModal = (idHtmlModal) => {
    const modal = new bootstrap.Modal(document.getElementById(idHtmlModal), {
        keyboard: false
    });
    modal.show();
}

// FILTRA PROVINCE BY ID REGIONE
filterProvinceByRegionId = (event) => {
    const regionId = event.target.value;
    const provinceSelect = document.querySelector('select[id="province_id"');
    const provinceOptions = provinceSelect.getElementsByTagName('option');

    // reset valore select province_id
    provinceSelect.value = "";

    // filtro per province per regione id
    Array.from(provinceOptions).forEach((option) => {
        const optionRegionId = option.getAttribute('data-region-id');
    
        if (optionRegionId == regionId) {
            option.style.display = 'block';
        } else {
            option.style.display = 'none';
        }
    });
}

// FILTRA COMUNI BY PROVINCIA ID
filterCitiesByProvinceId = (event) => {
    const provinceId = event.target.value;
    const citiesSelect = document.querySelector('select[id="city_id"');
    const citiesOption = citiesSelect.getElementsByTagName('option');

    // reset value select city_id
    citiesSelect.value = "";

    // filtro comuni per provincia id
    Array.from(citiesOption).forEach((option) => {
        const optionProvinceId = option.getAttribute('data-province-id');
    
        if (optionProvinceId == provinceId) {
            option.style.display = 'block';
        } else {
            option.style.display = 'none';
        }
    });
}