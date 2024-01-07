/*** IMPORTS ***/
import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';

// layouts
import PageLayout from './layouts/PageLayout';

// Pages
import Homepage from './pages/Homepage';
import ContactUs from './pages/ContactUs';
import CartShop from './pages/CartShop';
/******************************************************************************** */

const ReactIndex = () => {
    return (
        <Router>
            <Routes>
                {/* rotte element pageLayout header footer */}
                <Route element={<PageLayout />}>
                    <Route path='/' element={<Homepage />} />
                    <Route path='/contact-us' element={<ContactUs />} />
                    <Route path='/cart-shop' element={<CartShop />} />
                </Route>

                {/* error page without header footer */}
                {/* <Route path='*' element={<NotFound />} /> */}
            </Routes>
        </Router>
    );
}

export default ReactIndex;