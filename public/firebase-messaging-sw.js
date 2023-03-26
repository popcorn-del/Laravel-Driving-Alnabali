importScripts('https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/9.14.0/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyBOuhG1Ht31r2SyrBD3Wa8riG7gZ5OfpPs",
    authDomain: "fluttersupervisor.firebaseapp.com",
    projectId: "fluttersupervisor",
    storageBucket: "fluttersupervisor.appspot.com",
    messagingSenderId: "906276400183",
    appId: "1:906276400183:web:cd50a9bf75ba167ca2a3b2",
    measurementId: "G-XHMGLHKYDW"
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});