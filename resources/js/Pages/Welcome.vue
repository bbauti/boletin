<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Welcome" />
    <div class="navbar bg-gradient-to-b from-zinc-950/40 from-99% p-5 mb-10">
        <div class="navbar-start">
            <button tabindex="0" class="btn btn-ghost lg:hidden">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h8m-8 6h16"
                    />
                </svg>
            </button>
            <Link
                class="flex flex-col normal-case text-lg font-semibold px-3 py-1 rounded-lg hover:bg-white/5 hover:scale-105 transition-all ease-in-out"
                href="/"
                ><span>Tu</span> <span>Escuela</span> <span>Web</span></Link
            >
        </div>
        <!-- <div class="navbar-center hidden lg:flex">
            <ul class="px-1">
                <li><a>Item 1</a></li>
                <li><a>Item 3</a></li>
            </ul>
        </div> -->
        <div class="navbar-end">
            <div v-if="canLogin">
                <Link
                    class="btn"
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    >Dashboard</Link
                >

                <template v-else>
                    <div class="flex gap-3">
                        <Link
                            class="btn btn-ghost min-h-[unset] h-fit px-3 py-2 my-auto rounded-lg font-semibold"
                            :href="route('login')"
                            >Iniciar sesion</Link
                        >

                        <Link
                            class="btn btn-outline font-bold"
                            v-if="canRegister"
                            :href="route('register')"
                            >Comencemos</Link
                        >
                    </div>
                </template>
            </div>
        </div>
    </div>
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
