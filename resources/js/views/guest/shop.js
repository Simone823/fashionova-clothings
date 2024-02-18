// invio form filtri prodotti (azione submit o reset per eliminare i filtri)
submitFormFiltersProducts = (event) => {
    event.preventDefault();

    const form = event.target.form;

    // type btn (submit o reset)
    const typeBtn = event.target.type;

    // input hidden action submit o reset
    const inputHiddenActionSubmit = $('input[type="hidden"][id="action_submit"]');
    const inputHiddenActionReset = $('input[type="hidden"][id="action_reset"]');

    // controllo il tipo del btn
    if (typeBtn == 'submit') {
        inputHiddenActionSubmit.val(1);
        inputHiddenActionReset.val(0);
    } else if (typeBtn == 'reset') {
        inputHiddenActionSubmit.val(0);
        inputHiddenActionReset.val(1);
    } else {
        inputHiddenActionSubmit.val(1);
        inputHiddenActionReset.val(0);
    }

    // invio form
    form.submit();
}