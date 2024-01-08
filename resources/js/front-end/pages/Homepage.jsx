/*** IMPORTS ***/
import React, { useEffect } from 'react';

// Custom hook
import useTitle from '../customHook/useTitle';
import Hero from '../components/Hero';
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
                
            </div>
        </section>
    );
}

export default Homepage;