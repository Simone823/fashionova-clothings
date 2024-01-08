/*** IMPORTS ***/
import {configureStore } from '@reduxjs/toolkit';

// Reducers
import cartShopReducer from './reducers/cartShop';
/***************************************** */

// store
const store = configureStore({
    reducer: {
        cartShop: cartShopReducer
    }
});

export default store;