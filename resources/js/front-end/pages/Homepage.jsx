/*** IMPORTS ***/
import React, { useEffect } from 'react';

// Custom hook
import useTitle from '../customHook/useTitle';
import Hero from '../components/Hero';

// Components
import Services from '../components/Services';
/******************************************* */

const Homepage = () => {
    useTitle('Home');

    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <section id='homepage'>
            {/* Hero */}
            <Hero />

            <div className='container'>
                {/* Services */}
                <Services/>
            </div>
        </section>
    );
}

export default Homepage;