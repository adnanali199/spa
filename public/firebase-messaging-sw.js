// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp( {
    apiKey: "AIzaSyDSo0Bmcn2Y0xLoZzZjgZUH6kRD_PVg50Y",
    authDomain: "spabooking-f8af7.firebaseapp.com",
    projectId: "spabooking-f8af7",
    storageBucket: "spabooking-f8af7.appspot.com",
    messagingSenderId: "118064225989",
    appId: "1:118064225989:web:97b0e8b578840414441aac",
    measurementId: "G-SVYMP9WNRM"
  });

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});