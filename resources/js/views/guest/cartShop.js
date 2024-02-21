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

// Ottieni il numero totale dei prodotti nel carrello
getTotalItemToCart = () => {
    const itemsCart = JSON.parse(localStorage.getItem('cart'));

    if (itemsCart) {
        return itemsCart.length;
    }
    
    return 0;
}

//! DA TRASFORMARE
// addToCart: (state, action) => {
//     if(state.cart.length === 0) {
//         state.cart.push(action.payload);
//     } else {
//         // find item
//         let findItem = state.cart.find(el => el.id === action.payload.id);
        
//         if(findItem === undefined) {
//             state.cart.push(action.payload);
//         }
//     }

//     // somma prezzo stesso prodotto
//     let sumItem;

//     // somma totale prezzo
//     let totalCart = 0;

//     // for state cart
//     for (let i = 0; i < state.cart.length; i++) {
//         sumItem = state.cart[i].likes * 1;
//         totalCart += sumItem;
//     }

//     // state total
//     state.total = totalCart;

//     // set item localStorage
//     localStorage.setItem('cart', JSON.stringify(state.cart));

//     // localStorage set item total 
//     localStorage.setItem('total', totalCart);
// },

// removeToCart: (state, action) => {
//     state.cart = state.cart.filter((el) => el.id !== action.payload);

//     // somma prezzo stesso prodotto
//     let sumItem;

//     // somma totale prezzo
//     let totalCart = 0;

//     // for state cart
//     for (let i = 0; i < state.cart.length; i++) {
//         sumItem = state.cart[i].likes * 1;
//         totalCart += sumItem;
//     }

//     // state total 
//     state.total = totalCart;

//     // set cart localStorage
//     localStorage.setItem('cart', JSON.stringify(state.cart));

//     // localStorage set item total 
//     localStorage.setItem('total', totalCart);
// },

// removeAllToCart: (state) => {
//     // reset
//     state.cart = [];
//     state.total = 0;

//     // localStorage cart
//     localStorage.setItem('cart', JSON.stringify(state.cart));

//     // localStorage set total
//     localStorage.setItem('total', state.total);
// }