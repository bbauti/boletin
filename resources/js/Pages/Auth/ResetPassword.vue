<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("password.update"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
defineLayout(GuestLayout);
</script>

<template>
    <Head title="Reset Password" />
    <section class="flex flex-1 h-screen bg-base-100">
        <main
            class="flex flex-col items-center flex-1 flex-shrink-0 px-5 py-16 lg:border-r border-accent/10 overflow-y-auto m-auto"
        >
            <section id="login" class="prose max-w-[40ch] w-full mx-auto">
                <div class="flex-col gap-0 w-full">
                    <div class="flex flex-col gap-3">
                        <div
                            v-if="status"
                            class="font-medium text-sm text-success"
                        >
                            {{ status }}
                        </div>
                        <form @submit.prevent="submit">
                            <div class="form-control w-full">
                                <label class="label" for="emailInput">
                                    <span class="label-text">Correo</span>
                                </label>
                                <input
                                    class="input input-bordered"
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
                                    for="emailInput"
                                >
                                    <span class="label-text text-error">
                                        {{ form.errors.email }}
                                    </span>
                                </label>
                            </div>
                            <div class="form-control w-full">
                                <label class="label" for="passwordInput">
                                    <span class="label-text">Contraseña</span>
                                </label>
                                <input
                                    class="input input-bordered"
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    autocomplete="new-password"
                                    placeholder="•••••"
                                />
                                <label
                                    v-if="form.errors.password"
                                    class="label"
                                    for="passwordInput"
                                >
                                    <span class="label-text text-error">
                                        {{ form.errors.password }}
                                    </span>
                                </label>
                            </div>
                            <div class="form-control w-full">
                                <label class="label" for="passwordInput">
                                    <span class="label-text"
                                        >Confirmar contraseña</span
                                    >
                                </label>
                                <input
                                    class="input input-bordered"
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    autocomplete="new-password"
                                    placeholder="•••••"
                                />
                                <label
                                    v-if="form.errors.password"
                                    class="label"
                                    for="passwordInput"
                                >
                                    <span class="label-text text-error">
                                        {{ form.errors.password }}
                                    </span>
                                </label>
                            </div>
                            <button
                                class="btn bg-secondary-content border-accent/10 hover:bg-accent/10 hover:border-accent/30 justify-center font-bold min-h-[2.5rem] h-[2.5rem] w-full mt-5"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                name="send"
                                aria-label="Enviar contraseña"
                            >
                                Cambiar contraseña
                            </button>
                        </form>
                        <Link
                            :href="route('login')"
                            class="link link-hover text-sm text-accent/50 font-normal w-fit flex"
                        >
                            Volver atras</Link
                        >
                    </div>
                </div>
            </section>
        </main>
    </section>
</template>
