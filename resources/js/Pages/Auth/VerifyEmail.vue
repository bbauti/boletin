<script setup>
import { computed } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.post(route("verification.send"));
};

const verificationLinkSent = computed(
    () => props.status === "verification-link-sent"
);
</script>

<script>
import GuestLayout from "@/Layouts/GuestLayout.vue";

export default {
    layout: GuestLayout,
};
</script>

<template>
    <Head title="Verificacion de email" />
    <section class="flex flex-1 h-screen bg-base-100">
        <main
            class="flex flex-col items-center flex-1 flex-shrink-0 px-5 py-16 lg:border-r border-accent/10 overflow-y-auto m-auto"
        >
            <section id="login" class="prose max-w-[40ch] w-full mx-auto">
                <div class="flex-col gap-0 w-full">
                    <p class="mb-4">
                        Antes de continuar debe verificar su dirección de correo
                        electrónico, haga click en el enlace que acabamos de
                        enviarle a su email.
                    </p>
                    <p class="mb-4">
                        Si no ha recibido el correo electrónico puede soliciar
                        otro.
                    </p>
                    <p
                        v-if="verificationLinkSent"
                        class="mb-4 font-medium text-sm text-success"
                    >
                        Un nuevo enlace ha sido enviado a tu direccion de correo
                        electronico.
                    </p>
                    <div class="flex flex-col gap-3">
                        <form @submit.prevent="submit">
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
                            <div class="flex justify-between p-2">
                                <Link
                                    :href="route('profile.show')"
                                    class="link link-hover text-sm text-accent/50 font-normal w-fit flex"
                                >
                                    Editar perfil</Link
                                >

                                <Link
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                    class="link link-hover text-sm text-accent/50 font-normal w-fit flex"
                                >
                                    Cerrar sesion
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </section>
</template>
