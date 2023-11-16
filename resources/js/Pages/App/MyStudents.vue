<script setup>
import { Head } from "@inertiajs/vue3";
defineProps({ users: Object })
</script>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {    
    layout: AppLayout,
}
</script>

<template>
    <Head title="Mis Estudiantes" />
    <div class="py-12">
        <p class="mb-5">Estudiantes</p>
        <p>{{ users }}</p>
    </div>
</template>
