/*** IMPORTS ***/
import React, { useEffect } from 'react';

// redux
import { useSelector, useDispatch } from 'react-redux';
import { removeToCart, removeAllToCart } from '../redux/reducers/cartShop.js';
/***************************************** */

const CartShop = () => {
    // redux
    const dispatch = useDispatch();
    const { cart, total } = useSelector((state) => state.cartShop);

    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <section id='cart-shop'>
            <div className='container'>

                {cart.length == 0 ? (
                    <div className='row'>
                        <div className='col-12'>
                            <div className='card bg-body-secondary border-0 shadow-sm p-4 d-flex justify-content-center align-items-center gap-5'>
                                <figure className='icon-bag'>
                                    <img src='/storage/uploads/images/icon-bag-black.svg' alt='Icon bag' />
                                </figure>

                                <p className='mb-0 fw-bold fs-4'>Nessun articolo nel carrello.</p>
                            </div>
                        </div>
                    </div>
                ) : (
                    <div className='row'>
                        cart products
                    </div>
                )}

            </div>
        </section>
    );
}

export default CartShop;