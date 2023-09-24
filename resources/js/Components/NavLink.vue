<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

const props = defineProps({
    href: String,
    active: Boolean,
    icon: String,
});

const classes = computed(() => {
    return props.active
        ? "bg-accent/10 pointer-events-none translate-x-2 border border-accent/20"
        : "border-transparent";
});
</script>

<template>
    <Link
        class="group relative flex gap-2 items-center justify-between hover:bg-accent/20 px-2 py-1 rounded-md transition-all ease-out hover:translate-x-1 border"
        :href="href"
        :class="classes"
    >
        <div class="flex gap-2 items-center">
            <Icon :icon="icon" class="text-xl" />
            <slot />
        </div>
        <Icon
            icon="line-md:arrow-right"
            class="absolute right-[8px] text-transparent group-hover:text-accent/50 transition-all ease-in-out"
        />
    </Link>
</template>
