<script setup>
import { Toaster } from "vue-sonner";
</script>

<template>
    <Toaster richColors closeButton />
    <main>
        <slot />
    </main>
</template>
