importScripts('https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/9.14.0/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyCB1kU6T7OxTLl9tXbV-gAKEnWhochnVEY",
    authDomain: "fluttersupervisor.firebaseapp.com",
    projectId: "alnabaliapp",
    storageBucket: "fluttersupervisor.appspot.com",
    messagingSenderId: "171718709025",
    appId: "1:171718709025:android:a029b4145295fa5925f860",
    measurementId: "G-XHMGLHKYDW"
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});