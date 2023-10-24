<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<script>
import GuestLayout from "@/Layouts/GuestLayout.vue";

export default {

  layout: GuestLayout,
}
</script>

<template>
    <Head title="Welcome" />
    <!-- <div v-if="canLogin">
        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
            >Dashboard</Link
        >

        <template v-else>
            <Link :href="route('login')">Log in</Link>

            <Link v-if="canRegister" :href="route('register')">Register</Link>
        </template>
    </div> -->
    <div>
        <p>hola</p>
    </div>
</template>
