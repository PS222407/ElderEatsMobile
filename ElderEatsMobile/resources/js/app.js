import './bootstrap';

import Alpine from 'alpinejs';
import Push from 'push.js';

window.Alpine = Alpine;

Alpine.start();

let linkedAccountsId = document.querySelector('meta[name="linked-accounts"]').content;
let linkedAccountsArray = JSON.parse(linkedAccountsId);

let test =  Math.floor(Math.random() * 10);

linkedAccountsArray?.forEach((accountid) => {
    Echo.channel('product-scanned-channel-' + accountid)
        .listen('.add-product', (e) => {
            if (e.needsToSendNotification) {
                Push.create(`Apparaat ${e.accountId} heeft boodschappen aan de voorraad toegevoegd.`, {
                    body: "Voeg zo snel mogelijk een datum toe.",
                    icon: '/Images/logo_schaduw.png',
                });
            } else {
                console.log("Er is al een notificatie gestuurd onlangs.")
            }
        });
})





// Request permission to send notifications
function requestNotificationPermissions() {
    Push.create("Permission Request", {
        body: "Click here to enable notifications",
        timeout: 5000,
        onClick: function() {
            this.close();
            Push.Permission.request(onGranted, onDenied);
        }
    });
}

// Function to handle permission granted
function onGranted() {
    Push.create("Welcome", {
        body: "You will now receive notifications",
        timeout: 5000
    });
}

// Function to handle permission denied
function onDenied() {
    Push.create("Permission Denied", {
        body: "You have denied permission to receive notifications",
        timeout: 5000
    });
}

// Function to send a notification
function sendNotification(title, message) {
    Push.create(title, {
        body: message,
        timeout: 5000
    });
}

document.addEventListener('permission-button-pressed', function (e) {
    requestNotificationPermissions();
});
document.addEventListener('send-notification-button-pressed', function (e) {
    sendNotification('Hey hoi hallo', 'hoe gaat ie dan');
});
document.addEventListener('read-notification-permissions-button-pressed', function (e) {
    alert(Push.Permission.has() + ' ' + Push.Permission.get())
});
