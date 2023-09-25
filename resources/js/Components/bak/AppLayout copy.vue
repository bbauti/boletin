<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { useDark, useToggle } from "@vueuse/core";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import NavSection from "@/Components/NavSection.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

defineProps({
    title: String,
});

const isDark = useDark({
    selector: "html",
    attribute: "data-theme",
    valueDark: "dark",
    valueLight: "light",
});

const toggleDark = () => {
    document.startViewTransition(useToggle(isDark));
};

const showingNavigationDropdown = ref(false);

const is_expanded = ref(false);

const toggleMenu = () => {
    is_expanded.value = !is_expanded.value;
};

const logout = () => {
    router.post(route("logout"));
};
</script>

<template>
    <div class="min-h-screen flex items-start">
        <aside
            class="w-full max-w-[230px] bg-secondary border-r border-accent/20 sticky top-0 h-[100dvh] max-h-[100dvh] flex flex-col transition-all ease-in-out"
            :class="is_expanded ? 'max-w-[80px]' : ''"
        >
            <div class="bg-red h-20 relative flex items-center">
                <button
                    @click="toggleMenu"
                    class="transition-all ease-in-out duration-300 absolute top-[10px] hover:bg-accent/20 rounded-sm w-8 h-8 grid place-items-center"
                    :class="
                        is_expanded ? 'right-[30px]' : 'rotate-180 right-[10px]'
                    "
                >
                    ->
                </button>
            </div>
            <!-- <div
                class="bg-gradient-to-r from-transparent from-1% via-accent/20 via-50% to-transparent to-99% h-[1px] mx-0"
            /> -->
            <div class="bg-accent/20 h-[1px] mx-3" />
            <section class="flex flex-col h-full flex-1">
                <NavSection title="Principal">
                    <NavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                        icon="ic:baseline-analytics"
                    >
                        Dashboard
                    </NavLink>
                    <NavLink
                        :href="route('login')"
                        :active="route().current('login')"
                        icon="material-symbols:person"
                    >
                        Asistencias
                    </NavLink>
                    <NavLink
                        :href="route('login')"
                        :active="route().current('login')"
                        icon="fa6-solid:file-pen"
                    >
                        Calificaciones
                    </NavLink>
                </NavSection>
                <NavSection title="Otro">
                    <NavLink
                        :href="route('login')"
                        :active="route().current('login')"
                        icon="solar:settings-bold"
                    >
                        Ajustes
                    </NavLink>
                    <NavLink
                        :href="route('login')"
                        :active="route().current('login')"
                        icon="tabler:headphones-filled"
                    >
                        Soporte
                    </NavLink>
                </NavSection>
                <div class="bg-accent/20 h-[1px] mx-3 mt-auto mb-5" />
                <nav class="flex items-center mx-6 mb-5">
                    <Link
                        :href="route('profile.show')"
                        class="flex items-center gap-2 max-w-[16ch] relative group hover:bg-accent/20 p-2 rounded-lg transition-all ease-in-out overflow-hidden"
                        :class="
                            route().current('profile.show')
                                ? 'bg-accent/10 pointer-events-none border border-accent/20'
                                : 'border border-transparent'
                        "
                    >
                        <img
                            class="h-10 w-10 rounded-full object-cover"
                            :src="$page.props.auth.user.profile_photo_url"
                            :alt="$page.props.auth.user.name"
                        />
                        <div class="overflow-hidden max-w-[10ch]">
                            <p class="text-sm font-medium">
                                {{ $page.props.auth.user.name.split(" ")[0] }}
                            </p>
                            <p class="text-xs text-accent/20">
                                {{ $page.props.auth.user.email }}
                            </p>
                        </div>
                    </Link>
                    <form @submit.prevent="logout">
                        <button class="ml-2 flex">
                            <Icon
                                icon="ic:round-logout"
                                class="transition-all ease-in-out rounded-md p-1 w-7 h-7 hover:scale-110 hover:bg-error/30 border border-transparent hover:border-accent/20"
                            />
                        </button>
                    </form>
                </nav>
            </section>
        </aside>
        <!-- Page Content -->
        <section>
            <main>
                <!-- <nav
                    class="h-12 w-full bg-secondary/90 border-b border-accent/20 sticky top-0 backdrop-blur-[2px] flex items-center overflow-hidden"
                >
                    hola
                    <label class="swap swap-rotate ml-auto mr-2">
                        <input
                            type="checkbox"
                            @click="toggleDark()"
                            :checked="!isDark"
                            class="hidden"
                        />
                        <svg
                            class="swap-on fill-current w-7 h-7"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"
                            />
                        </svg>
                        <svg
                            class="swap-off fill-current w-7 h-7"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"
                            />
                        </svg>
                    </label>
                </nav> -->
                <slot />
            </main>
        </section>
    </div>
</template>
