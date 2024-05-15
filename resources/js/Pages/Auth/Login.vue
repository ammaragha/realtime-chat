<script setup>
import axios from 'axios';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import {messaging} from "@/firebase.js";
import {getToken} from "firebase/messaging";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

let fcmToken = '';

function retrieveFCMToken() {
    return getToken(messaging, {vapidKey: 'BJu4P1JvcqTnJy6gHZxwoom5eJENGwPje9JBYAzglTMIG1N1p9cZvk9AaOckDMUXw14nIatBhdJT_HnD7epE_8E'})
        .then((response) => {
            console.log(response)
            return response
        })
        .catch((error) => {
            console.log(error);
            return "";
        })
}

function requestPermission() {
    console.log('Requesting permission...');
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            console.log('Notification permission granted.');
        }
    });

}


const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = async () => {
    // Retrieve FCM token
    fcmToken = await retrieveFCMToken()
    requestPermission()
    // Post login form data
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
            // Send FCM token to server after login
            sendFCMToken();
        },
    });
};

const sendFCMToken = () => {
    axios.post('/save-token', {'token': fcmToken})
        .then(response => {
            console.log('FCM token saved successfully');
        })
        .catch(error => {
            console.error('Error saving FCM token:', error);
        });
};
</script>


<template>
    <GuestLayout>
        <Head title="Log in"/>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email"/>

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email"/>
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password"/>

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password"/>
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember"/>
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
