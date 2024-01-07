/*** IMPORTS ***/
require('bootstrap');
window.axios = require('axios');

// react
import React from 'react';
import ReactDOM from 'react-dom';
import Router from './front-end/Router.jsx';

// redux
// import { Provider } from 'react-redux';
// import store from './front-end/redux/store';
/***************************************** */


/*** RENDER root React ***/
if (document.getElementById('root')) {
    ReactDOM.render(
        <React.StrictMode>
            {/* <Provider store={store}> */}
                <Router />
            {/* </Provider> */}
        </React.StrictMode>,
        document.getElementById('root')
    );
}
/***************************************** */