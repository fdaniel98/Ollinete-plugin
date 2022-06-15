
const settings = document.getElementById('app-settings').dataset;

document.getElementById('newCustomerSaveButtonUpdated').addEventListener('click', function () {
    return onSaveNewCustomer();
});


function saveNewCustomerOllinete(taxID, name, ref) {
    const data = new FormData();

    data.set('action', 'save-new-customer');
    data.set('taxID', taxID);
    data.set('name', name);
    data.set('ref', ref);

    return basePostRequest(data);
}

function setCustomer(code, description) {
    document.getElementById('codcliente').value = code;
    document.getElementById('customerSearch').value = description;
    //OrderCart.setCustomer(code);

    $('.modal').modal('hide');
}

function onSaveNewCustomer() {
    const taxID = document.getElementById('newCustomerTaxID').value;
    const name = document.getElementById('newCustomerName').value;
    const ref = document.getElementById('newCustomerRef').value;

    function saveCustomer(response) {
        if (response.codcliente) {
            setCustomer(response.codcliente, response.razonsocial);
            $("#newCustomerForm").collapse('toggle');
        }
    }

    saveNewCustomerOllinete(taxID, name, ref).then(saveCustomer);
}

function basePostRequest(data) {
    const options = {
        method: 'POST',
        body: data
    };

    return fetch(settings.url, options).then(response => {
        if (response.ok) {
            return response.json();
        }
    });
}