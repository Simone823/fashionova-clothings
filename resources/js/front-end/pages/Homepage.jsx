/*** IMPORTS ***/
import React, { useEffect } from 'react';

// Custom hook
import useTitle from '../customHook/useTitle';
/******************************************* */

const Homepage = () => {
    useTitle('Home');

    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <section id='homepage'>
            <div className='container'>

                {/* title */}
                <div className='row mb-5'>
                    <div className='col-12'>
                        <h1 className='title-section'>Homepage</h1>
                    </div>
                </div>

            </div>
        </section>
    );
}

export default Homepage;