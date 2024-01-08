/*** IMPORTS ***/
import React from 'react';
/******************************************* */

const Services = () => {
    return (
        <div className='row gy-5'>
            {/* Title */}
            <div className='col-12'>
                <h1 className='title-section'>Servizi</h1>
            </div>

            {/* delivery */}
            <div className='col-12 col-md-4'>
                <div className='icon-service d-flex justify-content-center mb-4'>
                    <i className="fa-solid fa-truck-fast fs-1"></i>
                </div>

                <div className='description'>
                    <h4 className='fw-semibold'>Consegna gratuita</h4>
                    <p className='mb-0'>
                        Ti offriamo la comodità della consegna gratuita per tutti gli ordini superiori a 50€.
                        Vogliamo assicurarci che tu possa godere dei tuoi acquisti senza preoccuparti dei costi di spedizione.
                        Approfitta della nostra offerta di consegna gratuita per
                        ordini sopra i 50€ e ricevi i tuoi prodotti comodamente a casa tua, senza costi aggiuntivi.
                    </p>
                </div>
            </div>

            {/* refund */}
            <div className='col-12 col-md-4'>
                <div className='icon-service d-flex justify-content-center mb-4'>
                    <i className="fa-solid fa-right-left fs-1"></i>
                </div>

                <div className='description'>
                    <h4 className='fw-semibold'>30 giorni di restituzione</h4>
                    <p className='mb-0'>
                        Offriamo una garanzia di soddisfazione entro 30 giorni dall'acquisto.
                        Se per qualsiasi motivo non sei completamente soddisfatto del tuo acquisto,
                        accettiamo resi entro 30 giorni dalla data di consegna. Gli articoli
                        restituiti devono essere in condizioni originali, non utilizzati e
                        con l'imballaggio intatto.
                    </p>
                </div>
            </div>

            {/* payment */}
            <div className='col-12 col-md-4'>
                <div className='icon-service d-flex justify-content-center mb-4'>
                    <i className="fa-solid fa-key fs-1"></i>
                </div>

                <div className='description'>
                    <h4 className='fw-semibold'>100% Pagamento sicuro</h4>
                    <p className='mb-0'>
                        La tua sicurezza è la nostra priorità assoluta.
                        Utilizziamo protocolli di crittografia avanzati e partner di pagamento affidabili per
                        garantire transazioni sicure e protette.
                        Ogni pagamento effettuato sul nostro sito è protetto al 100%, garantendo la
                        tua tranquillità e la riservatezza dei tuoi dati finanziari.
                    </p>
                </div>
            </div>
        </div>
    );
}

export default Services;