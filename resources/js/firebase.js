// Import the functions you need from the SDKs you need
import {initializeApp} from "firebase/app";
import {getMessaging} from "firebase/messaging";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyBeDoELFYtbiTp0vNu8XBNufbGqA61dSvs",
    authDomain: "realtime-chat-3498c.firebaseapp.com",
    projectId: "realtime-chat-3498c",
    storageBucket: "realtime-chat-3498c.appspot.com",
    messagingSenderId: "266955362941",
    appId: "1:266955362941:web:2932c5675e7cae9cab5714"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

// Get Firebase messaging instance
const messaging = getMessaging(app);

export {messaging};
