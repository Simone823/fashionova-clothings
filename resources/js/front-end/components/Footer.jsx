/*** IMPORTS ***/
import React from 'react';
import { Link } from 'react-router-dom';
/***************************************** */

const Footer = () => {
    return (
        <footer>
            <div className="container pt-5 pb-2">

                {/* details */}
                <div className="row mb-5 gy-4">
                    {/* logo */}
                    <div className='col-12 col-md-4'>
                        <a href='/' className='logo'>
                            <img src='/storage/uploads/images/icon-black.png' />
                        </a>
                    </div>

                    {/* menu */}
                    <div className="col-12 col-md-4">
                        <div className="title mb-4">
                            <h5 className="mb-0 text-uppercase fw-bolder">Menù</h5>
                        </div>

                        {/* <!-- links --> */}
                        <ul className="list_link list-unstyled">
                            <li className="mb-2">
                                <Link to='/' className='link-secondary'>Home</Link>
                            </li>
                            <li className="mb-2">
                                <Link to='/products' className='link-secondary'>Prodotti</Link>
                            </li>
                            <li className="mb-2">
                                <Link to='/contact-us' className='link-secondary'>Contattaci</Link>
                            </li>
                            <li>
                                <Link to='/cart-shop' className='link-secondary'>Carrello</Link>
                            </li>
                        </ul>
                    </div>

                    {/* Referenze */}
                    <div className="col-12 col-md-4">
                        <div className="title mb-4">
                            <h5 className="mb-0 text-uppercase fw-bolder">Contatti</h5>
                        </div>

                        {/* detail contact */}
                        <ul className="detail_list list-unstyled">
                            <li className="mb-2">
                                <p className="fw-bolder text-secondary">
                                    <i className="fa-solid fa-location-dot me-2"></i>
                                    Indirizzo:
                                    <span className="fw-normal ms-2">Via Esempio 10, Italia</span>
                                </p>
                            </li>
                            <li className="mb-2">
                                <p className="fw-bolder text-secondary">
                                    <i className="fa-solid fa-phone me-2"></i>
                                    Telefono:
                                    <span className="fw-normal ms-2">000 000 0000</span>
                                </p>
                            </li>
                            <li>
                                <p className="fw-bolder text-secondary">
                                    <i className="fa-solid fa-envelope me-2"></i>
                                    E-mail:
                                    <span className="fw-normal ms-2">fashionova@info.local</span>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>

                {/* copyright */}
                <div className="row">
                    <div className="col-12 text-center">
                        <h6>
                            © Copyright {new Date().getFullYear()} Fashionova Clothings | Tutti i diritti riservati.
                        </h6>
                        <h6>Powered by
                            <a target='_blank' className="text-decoration-none fw-bold" href="https://simonedaglio.it"> @Simone Daglio</a>
                        </h6>
                    </div>
                </div>

            </div>
        </footer>
    );
}

export default Footer;