import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function showCurrencySelector() {
    fetch("{{ route('currencies.index') }}")
        .then(response => response.json())
        .then(data => {
            let selector = "<select id='currency-selector'>";
            data.forEach(currency => {
                selector += "<option value='" + currency.id + "'>" + currency.name + "</option>";
            });
            selector += "</select><br><br><button onclick='setDefaultCurrency()'>OK</button>";
            let modal = "<div style='background-color: #ccc; position: fixed; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.9;'></div>";
            modal += "<div style='background-color: #fff; position: fixed; top: 30%; left: 30%; width: 40%; height: 40%; padding: 20px;'>";
            modal += "<h2>Виберіть валюту за замовчуванням</h2>";
            modal += selector;
            modal += "</div>";
            document.body.innerHTML += modal;
        })
        .catch(error => {
            console.error(error);
        });
}

function setDefaultCurrency() {
    let selector = document.getElementById("currency-selector");
    let currencyId = selector.options[selector.selectedIndex].value;
    fetch("{{ route('users.setDefaultCurrency') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            currency_id: currencyId
        })
    })
        .then(response => response.json())
        .then(data => {
            window.location.href = "{{ route('accounts.create') }}";
        })
        .catch(error => {
            console.error(error);
        });
}

