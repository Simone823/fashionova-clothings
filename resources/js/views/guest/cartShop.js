$(document).ready(function() {
    // set local storage
    if(!localStorage.getItem('cart') || !localStorage.getItem('total')) {
        localStorage.setItem('cart', '[]');
        localStorage.setItem('total', '0');
    }

    // cards carrello
    const cardShop = $('#cart-shop .card-shop');
    const cardShopEmpty = $('#cart-shop .card-empty-shop');

    // controllo se è vuoto il carello
    if (getTotalItemToCart() == 0) {
        cardShopEmpty.removeClass('d-none');
    } else {
        cardShop.removeClass('d-none');
    }
});


// AGGIUNGI UN PRODOTTO AL CARRELLO
addItemToCart = (product) => {
    // colore selezionato
    const inputColor = $('input[type="radio"][name="color_id"]:checked');
    const selectedColorId = inputColor.val();
    const selectedColorName = inputColor.attr('data-color-name');

    // taglia selezionata
    const selectSize = $('select[id="size_id"]');
    const selectedSizeId = selectSize.val();
    const selectedSizeName = $('select[id="size_id"] option:selected').attr('data-size-name');

    // controllo se ha selezionato il colore e la taglia
    if (selectedColorId == undefined || selectedColorId == "" || selectedColorId == 0) {
        return alert('Devi selezionare un Colore.');
    } else if (selectedSizeId == undefined || selectedSizeId == "" || selectedSizeId == 0) {
        return alert('Devi selezionare una Taglia.');
    }

    // carrello
    const cartShop = JSON.parse(localStorage.getItem('cart', '[]'));

    // costruisco l'oggetto prodotto per il carrello
    const item = {
        productId: product.id,
        productCode: product.code,
        productName: product.name,
        productGenreId: product.genre_id,
        productGenreName: product.genre.name,
        productPrice: product.price,
        productDiscountPercent: product.discount_percent,
        productDescription: product.description,
        productColorId: Number(selectedColorId),
        productColorName: selectedColorName,
        productSizeId: Number(selectedSizeId),
        productSizeName: selectedSizeName,
        productImages: JSON.parse(product.images).filter(image => image.includes(selectedColorName)),
        productQuantity: 1
    };

    if (cartShop.length == 0) {
        // pusho il prodotto in cartShop
        cartShop.push(item);
    } else {
        // recupero il prodotto nel carrello che abbia almeno l'id la taglia e il colore uguale
        let productFind = cartShop.find(element => element.productId == item.productId && element.productColorId == item.productColorId && element.productSizeId == item.productSizeId);

        // se esiste lo stesso prodotto nel carrello aggiorno la quantità
        if (productFind == undefined) {
            // pusho il nuovo prodotto
            cartShop.push(item);
        } else {
            // aggiorno la quantità
            cartShop.forEach(element => {
                if(element.productId == productFind.productId) {
                    element.productQuantity += 1;
                }
            });
        }
    }

    // salva cartShop e prezzo totale sul local storage
    localStorage.setItem("cart", JSON.stringify(cartShop));
    localStorage.setItem("total", getTotalPriceCart());

    // reset valore taglia selezionata
    setValueOnSelect(selectSize.attr('id'), "");

    // aggiorno il badge totale elementi sulla nav del carrello
    $('#nav-guest .cart-total-item').html(getTotalItemToCart());
}

// OTTIENI IL NUMERO TOTALE DEI PRODOTTI PRESENTI NEL CARRELLO
getTotalItemToCart = () => {
    const itemsCart = JSON.parse(localStorage.getItem('cart'));

    if (itemsCart) {
        return itemsCart.length;
    }
    
    return 0;
}

// OTTIENI IL PREZZO TOTALE DEL CARRELLO
getTotalPriceCart = () => {
    const cartShop = JSON.parse(localStorage.getItem('cart', '[]'));
    let totalPrice = 0;

    cartShop.forEach((element) => {
        let productTotalPrice;

        if (element.productDiscountPercent !== null && element.productDiscountPercent !== "") {
            const discountPercent = parseFloat(element.productDiscountPercent);
            productTotalPrice = (element.productPrice * element.productQuantity) - ((element.productPrice * element.productQuantity) * (discountPercent / 100));
        } else {
            productTotalPrice = (element.productPrice * element.productQuantity);
        }

        productTotalPrice = parseFloat(productTotalPrice).toFixed(2);
        totalPrice += parseFloat(productTotalPrice);
    });

    totalPrice = totalPrice.toFixed(2);

    return totalPrice;
}