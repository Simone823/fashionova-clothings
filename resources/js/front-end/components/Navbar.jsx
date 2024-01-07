/*** IMPORTS ***/
import React from 'react';
import { NavLink } from 'react-router-dom';
/***************************************** */

const Navbar = () => {
  return (
    <nav className="navbar navbar-expand-md navbar-light bg-body-secondary">
      <div className="container">

        {/* logo */}
        <a className="navbar-brand" href="/">
          <img src='storage/uploads/images/icon-black.png' alt='Logo' />
        </a>

        {/* btn mobile */}
        <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span className="navbar-toggler-icon"></span>
        </button>

        {/* menu */}
        <div className="collapse navbar-collapse" id="navbarNav">
          {/* NavLink */}
          <ul className="navbar-nav flex-grow-1 justify-content-center gap-4">
            <li className="nav-item">
              <NavLink to="/" className='nav-link text-uppercase'>
                Home
              </NavLink>
            </li>
            <li className="nav-item">
              <NavLink to="/products" className='nav-link text-uppercase'>
                Prodotti
              </NavLink>
            </li>
            <li className="nav-item">
              <NavLink to="/contact-us" className='nav-link text-uppercase'>
                Contattaci
              </NavLink>
            </li>
          </ul>

          {/* Btn */}
          <ul className='navbar-nav gap-4'>
            <li className='nav-item'>
              <NavLink to="/cart-shop" className='nav-link position-relative'>
                <i className="fa-solid fa-cart-shopping fs-4"></i>
                <span className="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  0
                  <span className="visually-hidden">prodotti nel carrello</span>
                </span>
              </NavLink>
            </li>
          </ul>
        </div>

      </div>
    </nav>
  );
}

export default Navbar;