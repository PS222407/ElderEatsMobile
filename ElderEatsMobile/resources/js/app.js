import './bootstrap';

import Alpine from 'alpinejs';
import Push from 'push.js';

window.Alpine = Alpine;

Alpine.start();

let linkedAccountsId = document.querySelector('meta[name="linked-accounts"]').content;
let linkedAccountsArray = JSON.parse(linkedAccountsId);

linkedAccountsArray.forEach((accountid) => {
    Echo.channel('product-scanned-channel-' + accountid)
        .listen('.add-product', (e) => {
            Push.create("Boodschappen aan de voorraad toegevoegd.", {
                body: "Voeg zo snel mogelijk een datum toe.",
                icon: '/Images/logo_schaduw_32x.png',
            });
        });
})
