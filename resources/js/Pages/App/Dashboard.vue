<script setup>
import { Head } from "@inertiajs/vue3";
</script>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import GeneralLayout from "@/Layouts/GeneralLayout.vue";

export default {
    layout: [AppLayout, GeneralLayout],
};
</script>

<template>
    <Head title="Dashboard" />
    <div class="py-12">
        <p>hola</p>
    </div>
</template>
