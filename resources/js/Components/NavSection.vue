<script setup>
const props = defineProps({
    title: String,
});
</script>

<template>
    <nav class="mx-6 flex flex-col gap-2">
        <p
            class="text-sm text-accent/30 font-medium uppercase tracking-wide mt-4 mb-2 select-none max-w-[3.5ch] overflow-hidden"
        >
            {{ title }}
        </p>
        <slot />
    </nav>
</template>
