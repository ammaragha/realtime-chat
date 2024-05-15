<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {reactive} from "vue";
import {messaging} from "@/firebase.js";
import {onMessage} from "firebase/messaging";

const data = defineProps({
    chat: {
        type: Object,
        required: true
    },
    messages: {
        type: Array,

    }
});

onMessage(messaging, (response) => {
    data.messages.push({
        message: response.notification.body
    });
})


const form = reactive({
    message: null,
    chat_id: data.chat.id,
    receiver_id: data.chat.receiver.id
});


function sendMessage() {
    axios.post('/messages', form)
        .then((response) => {
            console.log(response)

            data.messages.push({
                user_id: data.chat.sender.id,
                message: response.data.message
            });
        })
        .catch((error) => {
            console.log(error)
        });
    form.message = "";
}


</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="chat-container">
                    Chat messages
                    <div class="chat-messages">
                        <div v-for="(message, index) in messages" :key="index" class="message">
                            <span v-if="message.user_id === $page.props.auth.user.id" class="message-sender">You:</span>
                            <span v-else class="message-sender">{{ chat.receiver.name }}:</span>
                            <span class="message-text">{{ message.message }}</span>
                        </div>
                    </div>

                    Message input
                    <form @submit.prevent="sendMessage">
                        <div class="message-input">
                            <input v-model="form.message" type="text"
                                   placeholder="Type your message...">
                            <button>Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<style scoped>
.chat-container {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 1rem;
    max-height: 500px; /* Set a maximum height for scrolling */
}

.message {
    margin-bottom: 1rem;
}

.message-sender {
    font-weight: bold;
    margin-right: 0.5rem;
}

.message-text {
    display: inline-block;
    background-color: #F3F4F6;
    padding: 0.5rem;
    border-radius: 0.5rem;
}

.message-input {
    display: flex;
    align-items: center;
    padding: 0.5rem;
}

.message-input input {
    flex: 1;
    padding: 0.5rem;
    border: 1px solid #D1D5DB;
    border-radius: 0.5rem;
    margin-right: 0.5rem;
}

.message-input button {
    background-color: #2563EB;
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
}

.message-input button:hover {
    background-color: #1E40AF;
}
</style>


