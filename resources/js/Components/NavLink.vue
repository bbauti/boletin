<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { Motion, Presence } from "motion/vue";

const props = defineProps({
    href: String,
    active: Boolean,
    icon: String,
    is_expanded: Boolean,
    title: String,
});

const classes = computed(() => {
    return props.active
        ? "bg-accent/10 pointer-events-none  border border-accent/20"
        : "border-transparent";
});

const iconClasses = computed(() => {
    return props.active ? "text-accent/50" : "text-transparent";
});

const expandedClasses = computed(() => {
    return props.is_expanded ? "" : "text-transparent -ml-[10rem]";
});

const textExpandedClasses = computed(() => {
    return props.is_expanded
        ? "hover:translate-x-1"
        : "hover:translate-x-0 translate-x-0";
});
</script>

<template>
    <Link
        :class="[
            classes,
            textExpandedClasses,
            props.active && props.is_expanded ? 'translate-x-2' : '',
        ]"
        class="group relative flex gap-2 items-center hover:bg-accent/20 px-2 py-1 rounded-md transition-all ease-out border h-[2rem] select-none"
        :href="href"
    >
        <div
            class="flex items-center transition-all ease-in-out"
            :class="props.is_expanded ? 'gap-2' : 'justify-center'"
        >
            <Icon :icon="icon" class="text-xl" />
            <div
                class="overflow-hidden transition-all ease-in-out"
                :class="props.is_expanded ? '' : 'text-transparent'"
            >
                <Presence>
                    <Motion
                        v-show="props.is_expanded"
                        tag="p"
                        :initial="false"
                        :animate="{ opacity: 1, scale: 1 }"
                        :exit="{ opacity: 0, translateX: -150 }"
                        >{{ title }}</Motion
                    >
                </Presence>
                <!-- <p
                    v-show="props.is_expanded"
                    class="transition-all ease-in-out"
                    :class="expandedClasses"
                >
                    {{ title }}
                </p> -->
            </div>
        </div>
        <Icon
            icon="line-md:arrow-right"
            class="absolute right-[8px] text-transparent group-hover:text-accent/50 transition-all ease-in-out"
            :class="props.is_expanded ? '' : 'hidden'"
        />
    </Link>
</template>
