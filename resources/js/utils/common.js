// APRI UN MODAL QUANDO SI VERIFICANO ERRORI DI VALIDAZIONE
openModal = (idHtmlModal) => {
    const modal = new bootstrap.Modal(document.getElementById(idHtmlModal), {
        keyboard: false
    });
    modal.show();
}

// FILTRA PROVINCE BY ID REGIONE
filterProvinceByRegionId = (event, clearSelectProvince = true) => {
    const idAddressMatch = event.target.id.match(/user_address_(\d+)_region_id/);
    const regionId = event.target.value;

    // Select e options privince_id
    let provinceSelect;
    if (idAddressMatch) {
        provinceSelect = document.querySelector(`select[id="user_address_${idAddressMatch[1]}_province_id"]`);
    } else {
        provinceSelect = document.querySelector("select[id='province_id']");
    }
    const provinceOptions = provinceSelect.getElementsByTagName('option');

    // reset valore select province_id
    if (clearSelectProvince) {
        provinceSelect.value = "";
    }

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
filterCitiesByProvinceId = (event, clearSelectCity = true) => {
    const idAddressMatch = event.target.id.match(/user_address_(\d+)_province_id/);
    const provinceId = event.target.value;

    // Select e options city_id
    let citiesSelect;
    if (idAddressMatch) {
        citiesSelect = document.querySelector(`select[id="user_address_${idAddressMatch[1]}_city_id"]`);
    } else {
        citiesSelect = document.querySelector("select[id='city_id']");
    }
    const citiesOption = citiesSelect.getElementsByTagName('option');

    // reset value select city_id
    if (clearSelectCity) {
        citiesSelect.value = "";
    }

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