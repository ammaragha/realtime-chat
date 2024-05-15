<script setup>
import Pagination from "@/Components/Pagination.vue";
import {Link} from "@inertiajs/vue3";

defineProps({
    users: {
        type: Array,
        required: true
    },
    links: {
        type: Array
    }
});
</script>

<template>
    <table class="table-auto w-full">
        <!-- Table header -->
        <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th v-if="$page.props.auth.user" class="px-4 py-2">Chat</th>
        </tr>
        </thead>
        <!-- Table body -->
        <tbody>
        <tr v-for="user in users" :key="user.id">
            <td class="border px-4 py-2">{{ user.name }}</td>
            <td class="border px-4 py-2">{{ user.email }}</td>
            <td v-if="$page.props.auth.user" class="border px-4 py-2">
                <Link class="bottom-auto bg-blue-500 p-2 rounded hover:bg-blue-100" :href="route('chat.with', { id: user.id })">Chat With</Link>
            </td>
        </tr>
        </tbody>
    </table>
    <Pagination :links="links"></Pagination>
</template>

<style scoped>

</style>
