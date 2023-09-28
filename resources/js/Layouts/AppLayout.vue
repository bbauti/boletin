<script setup>
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { useDark, useToggle, useStorage } from "@vueuse/core";
import { Motion, Presence } from "motion/vue";
import NavLink from "@/Components/NavLink.vue";
import { Toaster } from "vue-sonner";

import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { rollRight } from "@vueuse/motion";

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

const is_expanded = ref(useStorage("is_expanded", true));

const toggleMenu = () => {
    is_expanded.value = !is_expanded.value;
    localStorage.setItem("is_expanded", is_expanded.value);
};

const logout = () => {
    router.post(route("logout"));
};
</script>

<template>
    <Toaster richColors closeButton />
    <div class="min-h-screen flex items-start">
        <aside
            class="w-full max-w-[230px] bg-secondary border-r border-accent/20 sticky top-0 h-[100dvh] max-h-[100dvh] flex flex-col transition-all ease-in-out"
            :class="is_expanded ? '' : 'max-w-[56px]'"
        >
            <div class="bg-red h-20 relative">
                <div class="content">
                    <p
                        class="mt-4 flex text-xl tracking-wider font-bold transition-all ease-in-out select-none after:content-['.'] after:absolute after:transition-all after:ease-in-out relative"
                        :class="
                            is_expanded
                                ? 'ml-[35px] after:left-[45px]'
                                : 'ml-[15px] after:left-[12px]'
                        "
                    >
                        S<span
                            class="transition-all ease-in-out"
                            :class="is_expanded ? '' : 'text-transparent'"
                            >ilvi</span
                        >
                    </p>
                </div>
                <button
                    @click="toggleMenu"
                    class="transition-all ease-in-out duration-300 absolute top-[10px] hover:bg-accent/20 rounded-sm w-8 h-8 grid place-items-center select-none border"
                    :class="
                        is_expanded
                            ? 'right-[10px] border-transparent'
                            : 'right-[-17px] bg-secondary border border-accent/20 hover:bg-secondary-content'
                    "
                >
                    <p
                        class="transition-all ease-in-out duration-400"
                        :class="is_expanded ? 'rotate-180' : ''"
                    >
                        ->
                    </p>
                </button>
            </div>
            <!-- <div
                class="bg-gradient-to-r from-transparent from-1% via-accent/20 via-50% to-transparent to-99% h-[1px] mx-0"
            /> -->
            <!-- <div class="bg-accent/20 h-[1px] mx-3" /> -->
            <section class="flex flex-col h-full flex-1">
                <nav
                    class="flex flex-col gap-2 transition-all ease-in-out"
                    :class="is_expanded ? 'mx-6' : 'mx-2'"
                >
                    <div
                        class="group relative flex gap-2 items-center hover:bg-accent/5 px-2 py-1 rounded-md transition-all ease-out h-[2rem] border border-transparent active:bg-accent/10 active:border-accent/20 select-none"
                    >
                        <div
                            class="flex items-center transition-all ease-in-out"
                            :class="is_expanded ? 'gap-2' : 'justify-center'"
                        >
                            <Icon
                                icon="basil:notification-solid"
                                class="text-xl"
                            />
                            <div
                                class="overflow-hidden transition-all ease-in-out"
                                :class="is_expanded ? '' : 'text-transparent'"
                            >
                                <Presence>
                                    <Motion
                                        v-show="is_expanded"
                                        tag="p"
                                        :initial="false"
                                        :animate="{ opacity: 1, scale: 1 }"
                                        :exit="{ opacity: 0, translateX: -150 }"
                                    >
                                        Notificaciones
                                    </Motion>
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
                            icon="mi:select"
                            class="absolute right-[8px] text-accent/50 transition-all ease-in-out"
                            :class="is_expanded ? '' : 'hidden'"
                        />
                    </div>
                </nav>
                <nav
                    class="flex flex-col gap-2 transition-all ease-in-out"
                    :class="is_expanded ? 'mx-6' : 'mx-2'"
                >
                    <p
                        class="text-sm text-accent/30 font-medium uppercase tracking-wide mt-4 mb-2 select-none"
                    >
                        Principal
                    </p>
                    <NavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                        :is_expanded="is_expanded"
                        title="Dashboard"
                        icon="ic:baseline-analytics"
                    />
                    <NavLink
                        :href="route('login')"
                        :active="route().current('login')"
                        :is_expanded="is_expanded"
                        title="Asistencias"
                        icon="material-symbols:person"
                    />
                    <NavLink
                        :href="route('login')"
                        :active="route().current('login')"
                        :is_expanded="is_expanded"
                        title="Calificaciones"
                        icon="fa6-solid:file-pen"
                    />
                </nav>
                <nav
                    class="flex flex-col gap-2 transition-all ease-in-out"
                    :class="is_expanded ? 'mx-6' : 'mx-2'"
                >
                    <p
                        class="text-sm text-accent/30 font-medium uppercase tracking-wide mt-4 mb-2 select-none"
                    >
                        Otro
                    </p>
                    <NavLink
                        :href="route('settings')"
                        :active="route().current('settings')"
                        :is_expanded="is_expanded"
                        title="Ajustes"
                        icon="solar:settings-bold"
                    />
                    <NavLink
                        :href="route('login')"
                        :active="route().current('login')"
                        :is_expanded="is_expanded"
                        title="Soporte"
                        icon="tabler:headphones-filled"
                    />
                </nav>
                <div class="bg-accent/20 h-[1px] mx-3 mt-auto mb-5" />
                <nav
                    class="flex items-center transition-all mb-5 ease-in-out"
                    :class="is_expanded ? 'mx-6' : 'flex-col'"
                >
                    <div :class="is_expanded ? 'hidden' : ''">
                        <Presence>
                            <Motion
                                v-show="!is_expanded"
                                :initial="false"
                                :animate="{
                                    opacity: 1,
                                    scale: 1,
                                    transition: { delay: 0.1 },
                                }"
                                :exit="{ opacity: 0, scale: 0 }"
                                class="overflow-hidden"
                            >
                                <form @submit.prevent="logout">
                                    <button
                                        class="flex overflow-hidden"
                                        :class="is_expanded ? 'ml-2' : ''"
                                    >
                                        <Icon
                                            icon="ic:round-logout"
                                            class="transition-all ease-in-out rounded-md p-1 w-7 h-7 hover:scale-110 hover:bg-error/30 border border-transparent hover:border-accent/20 m-[0.2rem]"
                                        />
                                    </button>
                                </form>
                            </Motion>
                        </Presence>
                    </div>
                    <Link
                        :href="route('profile.show')"
                        class="flex items-center max-w-[16ch] min-w-[58px] relative group rounded-lg transition-all ease-in-out overflow-hidden select-none"
                        :class="[
                            route().current('profile.show')
                                ? 'bg-accent/10 pointer-events-none border border-accent/20'
                                : 'border border-transparent',
                            is_expanded
                                ? 'p-2 gap-2 hover:bg-accent/20'
                                : 'bg-transparent border border-transparent p-[7px] pointer-events-none',
                        ]"
                    >
                        <img
                            class="h-10 w-10 rounded-full object-cover transition-all ease-in-out"
                            :src="$page.props.auth.user.profile_photo_url"
                            :alt="$page.props.auth.user.name"
                            :class="[
                                route().current('profile.show') && !is_expanded
                                    ? 'pointer-events-none outline outline-2 outline-accent/50 outline-offset-1 rounded-full'
                                    : 'border border-transparent pointer-events-auto',
                                is_expanded ? '' : 'hover:outline-accent/20',
                            ]"
                        />
                        <div class="overflow-hidden">
                            <Presence>
                                <Motion
                                    v-show="is_expanded"
                                    :initial="false"
                                    :animate="{ opacity: 1, scale: 1 }"
                                    :exit="{ opacity: 0, translateX: -150 }"
                                >
                                    <div
                                        class="overflow-hidden max-w-[10ch] transition-all ease-in-out"
                                        :class="
                                            is_expanded
                                                ? ''
                                                : 'text-transparent -ml-[10rem]'
                                        "
                                    >
                                        <p
                                            class="text-sm font-medium overflow-hidden"
                                        >
                                            {{
                                                $page.props.auth.user.name.split(
                                                    " "
                                                )[0]
                                            }}
                                        </p>
                                        <p class="text-xs text-accent/20">
                                            {{ $page.props.auth.user.email }}
                                        </p>
                                    </div>
                                </Motion>
                            </Presence>
                        </div>
                    </Link>
                    <!-- <div
                        class="bg-accent/20 h-[1px] mx-3"
                        :class="is_expanded ? 'hidden' : ''"
                    /> -->
                    <div :class="is_expanded ? '' : 'hidden'">
                        <Presence>
                            <Motion
                                v-show="is_expanded"
                                :initial="false"
                                :animate="{
                                    opacity: 1,
                                    scale: 1,
                                    transition: { delay: 0.1 },
                                }"
                                :exit="{ opacity: 0, scale: 0 }"
                                class="overflow-hidden"
                            >
                                <form @submit.prevent="logout">
                                    <button
                                        class="flex overflow-hidden"
                                        :class="is_expanded ? 'ml-2' : ''"
                                    >
                                        <Icon
                                            icon="ic:round-logout"
                                            class="transition-all ease-in-out rounded-md p-1 w-7 h-7 hover:scale-110 hover:bg-error/30 border border-transparent hover:border-accent/20 m-[0.2rem]"
                                        />
                                    </button>
                                </form>
                            </Motion>
                        </Presence>
                    </div>
                </nav>
            </section>
        </aside>
        <!-- Page Content -->
        <section>
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
            <main class="px-10">
                <slot />
            </main>
        </section>
    </div>
</template>
