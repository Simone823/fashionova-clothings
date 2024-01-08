/*** IMPORTS ***/
import React, { useEffect } from 'react';

// Custom hook
import useTitle from '../customHook/useTitle.js';

// formik and yup
import { Formik, ErrorMessage } from 'formik';
import * as Yup from 'yup';
/***************************************** */

const ContactUs = () => {
    useTitle('Contattaci');

    // initial value form
    const form = {
        name: '',
        surname: '',
        email: '',
        phone: '',
        message: '',
        privacyChecked: false
    };

    // validation schema form
    const validationForm = Yup.object({
        name: Yup.string()
            .min(3, 'Il campo Nome deve contenere minimo 3 caratteri')
            .max(35, 'Il Nome può contenere massimo 35 caratteri')
            .required('Il campo Nome è richiesto')
            .matches(/^[a-zA-Z]+$/, 'Il Nome può contenere solo lettere senza spazi'),

        surname: Yup.string()
            .min(3, 'Il campo Cognome deve contenere minimo 3 caratteri')
            .max(35, 'Il Cognome può contenere massimo 35 caratteri')
            .required('Il campo Cognome è richiesto')
            .matches(/^[a-zA-Z]+$/, 'Il Cognome può contenere solo lettere senza spazi'),

        email: Yup.string()
            .email('Indirizzo Email non valido')
            .required('Il campo Email è richiesto'),

        phone: Yup.string()
            .required('Il campo Telefono è richiesto')
            .max(10, 'Il numero di Telefono può contenere massimo 10 cifre numeriche')
            .matches(/^(([+]|00)39)?((3[1-6][0-9]))(\d{7})$/, 'Il numero di Telefono deve essere valido e Italiano'),

        message: Yup.string()
            .required('Il campo Messaggio è richiesto'),

        privacyChecked: Yup.bool()
            .oneOf([true], 'È necessario accettare i termini e le condizioni')
            .default(false)
    });

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

                {/* references */}
                <div className="row mb-5">
                    <h3 className="text-uppercase fw-bolder mb-3">Fashionova Clothings</h3>
                    <p className="fw-bolder fs-5 mb-1">Indirizzo: <span className="fw-normal">Via Esempio 10, Italia</span></p>
                    <p className="fw-bolder fs-5 mb-0">Telefono: <span className="fw-normal">000 000 0000</span></p>
                    <p className="fw-bolder fs-5 mb-0">Orari: <span className="fw-normal">Da Lunedi a Venerdì 9:15-12:30 / 14.30-18-00</span></p>
                </div>

                {/* card form */}
                <div className='row'>
                    <div className='col-12'>
                        <div className='card bg-body-secondary border-0 shadow-sm p-4'>
                            <Formik initialValues={form} validationSchema={validationForm}
                                onSubmit={(values, actions) => {

                                }}
                            >
                                {props => (
                                    <form onSubmit={props.handleSubmit} className='row'>
                                        {/* name */}
                                        <div className="col-12 col-md-6 mb-4">
                                            <label htmlFor="name" className="form-label">Nome</label>
                                            <input onChange={props.handleChange} onBlur={props.handleBlur} type="text" className={`form-control ${props.touched.name && props.errors.name ? 'is-invalid' : ''}`} id="name" name='name' placeholder='Il tuo nome' value={props.values.name} />

                                            <ErrorMessage name="name" component="div" className='invalid-feedback' />
                                        </div>

                                        {/* surname */}
                                        <div className="col-12 col-md-6 mb-4">
                                            <label htmlFor="surname" className="form-label">Cognome</label>
                                            <input onChange={props.handleChange} onBlur={props.handleBlur} type="text" className={`form-control ${props.touched.surname && props.errors.surname ? 'is-invalid' : ''}`} id="surname" name='surname' placeholder='Il tuo cognome' value={props.values.surname} />

                                            <ErrorMessage name="surname" component="div" className='invalid-feedback' />
                                        </div>

                                        {/* email */}
                                        <div className="col-12 col-md-6 mb-4">
                                            <label htmlFor="email" className="form-label">Indirizzo Email</label>
                                            <input onChange={props.handleChange} onBlur={props.handleBlur} type="email" className={`form-control ${props.touched.email && props.errors.email ? 'is-invalid' : ''}`} id="email" name='email' placeholder='Il tuo indirizzo email' value={props.values.email} />

                                            <ErrorMessage name="email" component="div" className='invalid-feedback' />
                                        </div>

                                        {/* phone */}
                                        <div className="col-12 col-md-6 mb-4">
                                            <label htmlFor="phone" className="form-label">Telefono</label>
                                            <input onChange={props.handleChange} onBlur={props.handleBlur} type="tel" className={`form-control ${props.touched.phone && props.errors.phone ? 'is-invalid' : ''}`} id="phone" name='phone' placeholder='Il tuo numero di telefono' value={props.values.phone} />

                                            <ErrorMessage name="phone" component="div" className='invalid-feedback' />
                                        </div>

                                        {/* message */}
                                        <div className="col-12 mb-4">
                                            <label htmlFor="message" className="form-label">Messaggio</label>
                                            <textarea onChange={props.handleChange} onBlur={props.handleBlur} className={`form-control ${props.touched.message && props.errors.message ? 'is-invalid' : ''}`} id="message" name='message' rows="3" placeholder='Scrivi qui il tuo messaggio...' value={props.values.message}></textarea>

                                            <ErrorMessage name="message" component="div" className='invalid-feedback' />
                                        </div>

                                        {/* privacy check */}
                                        <div className='col-12 mb-5'>
                                            <div className="form-check form-switch">
                                                <input onChange={props.handleChange} onBlur={props.handleBlur} type="checkbox" role="switch" className={`form-check-input ${props.touched.privacyChecked && props.errors.privacyChecked ? 'is-invalid' : ''}`} id="privacyChecked" name='privacyChecked' checked={props.values.privacyChecked}/>
                                                <label className="form-check-label" htmlFor="privacyChecked">Acconsento al trattamento dei dati personali</label>

                                                <ErrorMessage name="privacyChecked" component="div" className='invalid-feedback' />
                                            </div>
                                        </div>

                                        {/* btn */}
                                        <div className='col-12'>
                                            <button type='submit' className='btn btn-primary text-uppercase px-5'>
                                                Invia
                                            </button>
                                        </div>
                                    </form>
                                )}
                            </Formik>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    );
}

export default ContactUs;