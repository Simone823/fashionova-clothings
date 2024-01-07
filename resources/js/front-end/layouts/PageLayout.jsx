/*** IMPORTS ***/
import React from 'react';
import { Outlet } from 'react-router-dom';

// components
import Navbar from '../components/Navbar';
/******************************************* */

const PageLayout = () => {
    return (
        <>
            {/* Header */}
            <Navbar />

            {/* rotte nidificate da react index */}
            <main>
                <Outlet />
            </main>
        </>
    );
}

export default PageLayout;