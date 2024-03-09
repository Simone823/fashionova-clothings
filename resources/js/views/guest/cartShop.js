$(document).ready(function () {
    // set local storage
    if (!localStorage.getItem('cart') || !localStorage.getItem('total')) {
        localStorage.setItem('cart', '[]');
        localStorage.setItem('total', '0.00');
    }

    // controllo se siamo nella view guest cart shop
    if ($('#guest-cart-shop').length > 0) {
        showOrHideCartShop();
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
        return Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Devi selezionare un Colore.",
            timer: 3000,
            timerProgressBar: true,
        });
    } else if (selectedSizeId == undefined || selectedSizeId == "" || selectedSizeId == 0) {
        return Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Devi selezionare una Taglia.",
            timer: 3000,
            timerProgressBar: true,
        });
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
        productPriceDiscounted: product.price_discounted,
        productColorId: Number(selectedColorId),
        productColorName: selectedColorName,
        productSizeId: Number(selectedSizeId),
        productSizeName: selectedSizeName,
        productImage: JSON.parse(product.images).filter(image => image.includes(selectedColorName))[0],
        productQuantity: 1
    };

    if (cartShop.length == 0) {
        cartShop.push(item);
    } else {
        // recupero il prodotto nel carrello che abbia almeno l'id la taglia e il colore uguale
        let productFind = cartShop.find(element => element.productId == item.productId && element.productColorId == item.productColorId && element.productSizeId == item.productSizeId);

        // se esiste lo stesso prodotto pusho nel carrello, altrimenti aggiorno la quantità 
        if (productFind == undefined) {
            cartShop.push(item);
        } else {
            cartShop.forEach(element => {
                if (element.productId == productFind.productId) {
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

    return Swal.fire({
        icon: "success",
        title: "Success",
        text: "Il Prodotto è stato aggiunto al carrello.",
        timer: 3000,
        timerProgressBar: true,
    });
}

// RIMUOVI UN PRODOTTO DAL CARRELLO 
removeItemToCart = (productId, productColorId, productSizeId) => {
    // filtro i prodotti nel carrello rimuovendo il prodotto eliminato
    const cartShop = JSON.parse(localStorage.getItem('cart')).filter(product =>
        product.productId !== productId ||
        product.productColorId !== productColorId ||
        product.productSizeId !== productSizeId
    );

    // aggiorno il carrello e il totale
    localStorage.setItem("cart", JSON.stringify(cartShop));
    localStorage.setItem("total", getTotalPriceCart());

    // Trova e rimuovi l'elemento dalla lista nel DOM
    $('#guest-cart-shop .card-shop .list-products li').each(function () {
        const liProductId = Number($(this).attr('data-productId'));
        const liProductColorId = Number($(this).attr('data-productColorId'));
        const liProductSizeId = Number($(this).attr('data-productSizeId'));

        // rimuovo il prodotto dalla lista
        if (liProductId == productId && liProductColorId == productColorId && liProductSizeId == productSizeId) {
            $(this).remove();
        }
    });

    // aggiorno il badge totale elementi sulla nav del carrello
    $('#nav-guest .cart-total-item').html(getTotalItemToCart());

    showOrHideCartShop();
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
            productTotalPrice = (element.productPriceDiscounted * element.productQuantity);
        } else {
            productTotalPrice = (element.productPrice * element.productQuantity);
        }

        productTotalPrice = parseFloat(productTotalPrice).toFixed(2);
        totalPrice += parseFloat(productTotalPrice);
    });

    totalPrice = totalPrice.toFixed(2);

    return totalPrice;
}

showOrHideCartShop = () => {
    // cards carrello
    const cardShop = $('#row-card-shop-not-empty');
    const cardShopEmpty = $('#row-card-shop-empty');

    // controllo se è vuoto il carello
    if (getTotalItemToCart() == 0) {
        cardShop.hide();
        cardShopEmpty.removeClass('d-none');
    } else {
        const cartShop = JSON.parse(localStorage.getItem('cart'));

        if ($('#row-card-shop-not-empty .card-shop .list-products').children().length == 0) {
            cartShop.forEach((product) => {
                let liProduct = `
                    <li data-productId="${product.productId}" data-productColorId="${product.productColorId}" data-productSizeId="${product.productSizeId}">
                        <figure class="product-image">
                            <img src="/storage/${product.productImage}" alt="${product.productName}">
                        </figure>
    
                        <div class="details-product">
                            <p class="product-name">${product.productName}</p>
                            <p class="product-genre text-secondary">
                                Genere: <span>${product.productGenreName}</span>
                            </p>
                            <p class="product-color text-secondary">
                                Colore: <span>${product.productColorName}</span>
                            </p>
                            <p class="product-size text-secondary">
                                Taglia: <span>${product.productSizeName}</span>
                            </p>
                            <p class="product-price ${product.productPriceDiscounted ? 'text-danger' : ''}">
                                ${product.productPriceDiscounted ?? product.productPrice}
                            </p>
                        </div>
    
                        <div class="btn-actions">
                            <button onclick="removeItemToCart(${product.productId}, ${product.productColorId}, ${product.productSizeId});" type="button" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash"></i>
                                Elimina
                            </button>
                        </div>
                    </li>
                `;
    
                // mostro la row card del carrello
                $('#row-card-shop-not-empty .card-shop .list-products').append(liProduct);
                cardShop.removeClass('d-none');
            });
        }
    }

    updateCardTotal();
}

updateCardTotal = () => {
    $('.card-total .subtotal span').html(`${getTotalPriceCart()} €`);

    let shippingPrice = 0.00;
    if (getTotalPriceCart() < 50) {
        shippingPrice = 10.00;
        $('.card-total .shipping span').html(`${shippingPrice.toFixed(2)} €`);
    }

    const totalWithShipping = parseFloat(Number(getTotalPriceCart()) + shippingPrice);
    $('.card-total .total span').html(`${totalWithShipping.toFixed(2)} €`);
}