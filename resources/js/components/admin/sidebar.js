document.addEventListener('DOMContentLoaded', () => {
    // Apri l'accordion che contiene un link attivo
    let activeLinkAccordion = document.querySelector('.accordion-active-link');
    if(activeLinkAccordion) {
        let accordionElement = activeLinkAccordion.parentNode.parentNode;
        let accordion = new bootstrap.Collapse(accordionElement);
        accordion.show();
    }
    /********************************************* */
});

// apri e chiudi sidebar
toggleCloseSidebar = () => {
    let sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('close');

    let hamburgerBtn = document.querySelector('.hamburger-btn');
    hamburgerBtn.classList.toggle('is-active');
}