<script setup>
import { Head } from "@inertiajs/vue3";
import Warning from "@/Components/Warning.vue";
</script>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout,
}
</script>

<template>
    <Head title="Dashboard" />
    <Warning/>
    <div class="py-12">
        <p>Estadisticas escolares.</p>
    </div>
</template>
