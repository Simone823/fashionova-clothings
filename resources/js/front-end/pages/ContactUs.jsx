/*** IMPORTS ***/
import React, { useEffect } from 'react';
/***************************************** */

const ContactUs = () => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <section id='contact-us'>
            <div className='container'>

                {/* title */}
                <div className='row mb-5'>
                    <div className='col-12'>
                        <h1 className='title-section'>Contattaci</h1>
                    </div>
                </div>

            </div>
        </section>
    );
}

export default ContactUs;