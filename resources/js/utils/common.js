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

// Inizializza tootip
document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
});

// ricerca in una tabella
searchOnTable = () => {
    const valInputSearch = $("#searchInput").val().toUpperCase();

    $("table tr").each(function(index) {
        if (index !== 0) {
            // riga attuale
            let row = $(this);

            // mostra o no la riga attuale
            let display = false;

            row.find("td").each(function() {
                const txtValue = $(this).text().toUpperCase();
                
                if (txtValue.includes(valInputSearch)) {
                    display = true;
                    return false;
                }
            });

            if (display) {
                row.show();
            } else {
                row.hide();
            }
        }
    });
}

// NASCONDI INPUT E LA SUA COL
hideInput = (idInputHtml) => {
    const input = $(`input[id="${idInputHtml}"]`);
    input.parent().addClass("d-none");
}

// MOSTRA INPUT E LA SUA COL
showInput = (idInputHtml) => {
    const input = $(`input[id="${idInputHtml}"]`);
    input.parent().removeClass("d-none");
}

// SETTA IL VALORE AD UN INPUT
setValueOnInput = (idInputHtml, value) => {
    const input = $(`input[id="${idInputHtml}"]`);
    input.val(value).trigger("change");
}

// SETTA IL VALORE AD UNA SELECT
setValueOnSelect = (idSelectHtml, value) => {
    const select = $(`select[id="${idSelectHtml}"]`);
    select.val(value).trigger("change");
}