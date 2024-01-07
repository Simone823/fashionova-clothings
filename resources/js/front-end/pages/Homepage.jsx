/*** IMPORTS ***/
import React, { useEffect } from 'react';
/******************************************* */

const Homepage = () => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <div>Homepage</div>
    );
}

export default Homepage;