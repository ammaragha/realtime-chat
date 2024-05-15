<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {Head, Link} from "@inertiajs/vue3";
import UsersTable from "@/Components/UsersTable.vue";

defineProps({
    data: {
        type: Object,
        required: true
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});


</script>

<template>
    <Head title="Welcome"/>
    <GuestLayout>
        <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-dark dark:hover:text-dark/80 dark:focus-visible:ring-white"
            >
                Dashboard
            </Link>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-dark dark:hover:text-dark/80 dark:focus-visible:ring-white"
                >
                    Log in
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-dark dark:hover:text-dark/80 dark:focus-visible:ring-white"
                >
                    Register
                </Link>
            </template>
        </nav>

        <UsersTable :users="data.data" :links="data.links"></UsersTable>

    </GuestLayout>
</template>

<style scoped>

</style>
