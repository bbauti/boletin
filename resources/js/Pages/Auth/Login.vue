<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";

import { Icon } from "@iconify/vue";
import { ref, computed } from "vue";
import { useIntervalFn } from "@vueuse/core";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};

const opc = [
    "Mantenete al tanto de tus notas.",
    "Sigue tus calificaciones.",
    "Tus notas en tiempo real.",
    "App para tus notas escolares.",
    "No pierdas de vista tus notas.",
    "Tus notas, tu responsabilidad.",
    "Tus calificaciones a tu alcance.",
    "Tu app de notas escolares.",
];

const sel = ref(opc[Math.floor(Math.random() * opc.length)]);

useIntervalFn(() => {
    sel.value = opc[Math.floor(Math.random() * opc.length)];
}, 10000);

const text = computed(() => sel.value);
</script>

<template>
    <Head title="Login" />
    <main class="flex flex-1 h-screen bg-base-100">
        <section
            class="flex flex-col items-center flex-1 flex-shrink-0 px-5 py-16 lg:border-r border-accent/10 shadow-lg overflow-y-auto"
        >
            <div id="login" class="prose max-w-[40ch] w-full mx-auto">
                <div class="flex-col gap-0 w-full">
                    <h2 class="mt-0 mb-1 font-semibold">
                        Bienvenido de vuelta
                    </h2>
                    <p class="mt-1 mb-4 font-normal">
                        Inicia sesion en tu cuenta.
                    </p>

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
                                <label class="label" for="email">
                                    <span class="label-text">Correo</span>
                                </label>
                                <input
                                    class="input input-bordered {success === true ? 'input-success' : success === false || success === 'email' ? 'input-error' : ''}"
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    autofocus
                                    autocomplete="username"
                                    placeholder="john@bbauti.com"
                                />
                                <label
                                    v-if="form.errors.email"
                                    class="label"
                                    for="email"
                                >
                                    <span class="label-text text-error">
                                        {{ form.errors.email }}
                                    </span>
                                </label>
                            </div>
                            <div class="form-control w-full">
                                <label class="label" for="password">
                                    <span class="label-text">Contraseña</span>
                                    <Link
                                        v-if="canResetPassword"
                                        :href="route('password.request')"
                                        class="label-text link link-hover font-normal text-sm text-accent/70"
                                    >
                                        Olvidaste tu contraseña?
                                    </Link>
                                </label>
                                <input
                                    class="input input-bordered {success === true ? 'input-success' : success === false || success === 'passwords' ? 'input-error' : ''} transition ease-in-out"
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    autocomplete="current-password"
                                    placeholder="•••••"
                                />
                                <label
                                    v-if="form.errors.password"
                                    class="label pb-0"
                                    for="password"
                                >
                                    <span class="label-text text-error">
                                        {{ form.errors.password }}
                                    </span>
                                </label>
                            </div>
                            <div class="flex items-center mt-4">
                                <input
                                    id="link-checkbox"
                                    type="checkbox"
                                    class="rounded"
                                    value=""
                                />
                                <label
                                    for="link-checkbox"
                                    class="ml-2 text-sm font-medium select-none"
                                    :checked="form.remember"
                                    name="remember"
                                    >Recordarme</label
                                >
                            </div>
                            <button
                                v-if="form.processing"
                                class="btn mt-4 bg-success/20 min-h-[2.5rem] h-[2.5rem] w-full border-success/80 hover:border-success/80 hover:bg-success/25"
                                name="loginUser"
                                aria-label="Login"
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
                                name="loginUser"
                                aria-label="Login"
                            >
                                <Icon icon="ic:round-email" />
                                Iniciar sesion
                            </button>
                        </form>
                        <p class="text-sm text-accent/70 mx-auto">
                            No tenes una cuenta?<Link
                                use:inertia
                                :href="route('register')"
                                class="link link-hover text-sm text-accent font-normal ml-[0.5ch]"
                                >Registrate ahora</Link
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
