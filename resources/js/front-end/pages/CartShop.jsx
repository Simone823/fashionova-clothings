/*** IMPORTS ***/
import React, { useEffect } from 'react';
/***************************************** */

const CartShop = () => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <section id='cart-shop'>
            <div className='container'>

                {/* title */}
                <div className='row mb-5'>
                    <div className='col-12'>
                        <h1 className='title-section'>Carrello</h1>
                    </div>
                </div>

            </div>
        </section>
    );
}

export default CartShop;