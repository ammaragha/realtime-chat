import { onBackgroundMessage } from 'firebase/messaging/sw';
import {messaging} from "@/firebase.js";

console.log('iam in SW');
onBackgroundMessage(messaging, (payload) => {
    console.log('Received background message', payload);
    // Customize notification handling here
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
