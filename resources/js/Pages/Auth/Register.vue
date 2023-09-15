<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";

import { Icon } from "@iconify/vue";
import { toast } from "vue-sonner";
import { ref, computed } from "vue";
import { onMounted, onUnmounted } from "vue";
import { useIntervalFn } from "@vueuse/core";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};

const opc = [
    "Regístrate para mejorar tus calificaciones",
    "Únete y optimiza tu rendimiento escolar",
    "Crea tu cuenta y alcanza el éxito académico",
    "Registra tu cuenta y sigue tu progreso",
    "Tu herramienta para el éxito académico",
    "Regístrate y alcanza tus metas educativas",
    "Ingresa y mejora tu experiencia de aprendizaje",
    "Empieza tu viaje hacia el conocimiento",
    "Regístrate y da un paso hacia el aprendizaje",
    "Únete y descubre tu potencial académico",
    "Comienza a elevar tus calificaciones hoy",
];

const sel = ref(opc[Math.floor(Math.random() * opc.length)]);

useIntervalFn(() => {
    sel.value = opc[Math.floor(Math.random() * opc.length)];
}, 10000);

const text = computed(() => sel.value);
</script>

<template>
    <Head title="Register" />
    <main class="flex flex-1 h-screen bg-base-100">
        <section
            class="flex flex-col items-center flex-1 flex-shrink-0 px-5 py-16 lg:border-r border-accent/10 shadow-lg overflow-y-auto"
        >
            <div id="register" class="prose max-w-[40ch] w-full mx-auto">
                <div class="flex-col gap-0 w-full">
                    <!-- <img
                        class="rounded-3xl shadow-lg"
                        src="https://media.discordapp.net/attachments/1128453887259594783/1128769815578955816/DALLE_2023-07-12_16.27.39_-_fill_the_blank_space_with_a_B_with_a_gradient_and_it_migth_have_a_purple_background.png"
                        alt="Logo"
                        width="100px"
                    /> -->
                    <h2 class="mt-0 mb-1 font-semibold">Bienvenido!</h2>
                    <p class="mt-1 mb-4 font-normal">Crea tu cuenta.</p>
                    <div class="flex flex-col gap-3 mt-10">
                        <button
                            class="btn bg-secondary-content border-accent/10 hover:bg-accent/10 hover:border-accent/30 justify-center font-bold min-h-[2.5rem] h-[2.5rem] w-full"
                        >
                            <Icon icon="bi:github" class="icon" />
                            Iniciar con GitHub
                        </button>
                        <button
                            class="btn bg-secondary/50 border-accent/10 hover:border-accent/50 hover:bg-secondary/30 justify-center font-bold min-h-[2.5rem] h-[2.5rem] w-full"
                        >
                            <Icon icon="bi:google" class="icon" />
                            Iniciar con Google
                        </button>
                        <div class="divider">Queres usar tu email?</div>
                        <form @submit.prevent="submit">
                            <div class="form-control w-full">
                                <label class="label" for="name">
                                    <span class="label-text"
                                        >Nombre completo</span
                                    >
                                </label>
                                <input
                                    class="input input-bordered {success === true ? 'input-success' : success === false ? 'input-error' : ''}"
                                    id="name"
                                    v-model="form.name"
                                    autofocus
                                    autocomplete="name"
                                    placeholder="John Doe"
                                />
                                <label class="label" for="name">
                                    <span class="label-text text-error">
                                        {{ form.errors.name }}
                                    </span>
                                </label>
                            </div>
                            <div class="form-control w-full">
                                <label class="label" for="email">
                                    <span class="label-text">Correo</span>
                                </label>
                                <input
                                    class="input input-bordered {success === true ? 'input-success' : success === false || success === 'email' ? 'input-error' : ''}"
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    autocomplete="username"
                                    placeholder="john@bbauti.com"
                                />
                                <label class="label" for="email">
                                    <span class="label-text text-error">
                                        {{ form.errors.email }}
                                    </span>
                                </label>
                            </div>
                            <div class="form-control w-full">
                                <label class="label" for="password">
                                    <span class="label-text">Contraseña</span>
                                </label>
                                <input
                                    class="input input-bordered {success === true ? 'input-success' : success === false || success === 'passwords' ? 'input-error' : ''} transition ease-in-out"
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    autocomplete="new-password"
                                    placeholder="•••••"
                                />
                                <label class="label" for="password">
                                    <span class="label-text text-error">
                                        {{ form.errors.password }}
                                    </span>
                                </label>
                            </div>
                            <div class="form-control w-full">
                                <label
                                    class="label"
                                    for="password_confirmation"
                                >
                                    <span class="label-text"
                                        >Confirmar contraseña</span
                                    >
                                </label>
                                <input
                                    class="input input-bordered {success === true ? 'input-success' : success === false || success === 'passwords' ? 'input-error' : ''} transition ease-in-out"
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    autocomplete="new-password"
                                    placeholder="•••••"
                                />
                                <label
                                    class="label"
                                    for="password_confirmation"
                                >
                                    <span class="label-text text-error">
                                        {{ form.errors.password_confirmation }}
                                    </span>
                                </label>
                            </div>
                            <button
                                v-if="form.processing"
                                class="btn mt-4 bg-success/20 min-h-[2.5rem] h-[2.5rem] w-full border-success/80 hover:border-success/80 hover:bg-success/25"
                                name="register1"
                                aria-label="Register"
                                disabled
                                style="
                                    background-color: rgb(10, 36, 6);
                                    color: rgb(129, 129, 129);
                                "
                            >
                                <span
                                    class="loading loading-spinner loading-md"
                                ></span>
                                Cargando...
                            </button>
                            <button
                                v-if="!form.processing"
                                class="btn mt-4 bg-success/50 min-h-[2.5rem] h-[2.5rem] w-full border-success/80 hover:border-success/80 hover:bg-success/25"
                                name="register1"
                                aria-label="Register"
                            >
                                <Icon icon="ic:round-email" />
                                Crear cuenta
                            </button>
                        </form>
                        <p class="text-sm text-accent/70 mx-auto">
                            Ya tenes una cuenta?<Link
                                :href="route('login')"
                                class="link link-hover text-sm text-accent font-normal ml-[0.5ch]"
                                >Inicia sesion</Link
                            >
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <aside
            class="flex-col items-center justify-center flex-1 flex-shrink hidden basis-1/4 xl:flex bg-zinc-900/10"
        >
            <h1 class="text-6xl max-w-[10ch] font-bold">{{ text }}</h1>
        </aside>
    </main>
</template>
