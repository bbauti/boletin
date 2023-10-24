<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

defineProps({
    status: String,
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<script>
import GuestLayout from "@/Layouts/GuestLayout.vue";

export default {
  layout: GuestLayout,
}
</script>

<template>
    <Head title="Olvide mi contraseña" />
    <section class="flex flex-1 h-screen bg-base-100">
        <main
            class="flex flex-col items-center flex-1 flex-shrink-0 px-5 py-16 lg:border-r border-accent/10 overflow-y-auto m-auto"
        >
            <section id="login" class="prose max-w-[40ch] w-full mx-auto">
                <div class="flex-col gap-0 w-full">
                    <h2 class="mt-0 mb-1 font-semibold">Cambiar contraseña</h2>
                    <p class="mt-1 mb-4 font-normal">
                        Olvidaste tu contraseña?
                    </p>

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
                            <button
                                class="btn bg-secondary-content border-accent/10 hover:bg-accent/10 hover:border-accent/30 justify-center font-bold min-h-[2.5rem] h-[2.5rem] w-full mt-5"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                name="sendcode"
                                aria-label="Enviar correo"
                            >
                                <Icon icon="ic:round-email" />
                                Enviar correo
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
