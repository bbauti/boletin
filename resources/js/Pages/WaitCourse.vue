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
}
</script>

<template>
    <Head title="Verificacion de email" />
    <section class="flex flex-1 h-screen bg-base-100">
        <main
            class="flex flex-col items-center flex-1 flex-shrink-0 px-5 py-16 lg:border-r border-accent/10 overflow-y-auto m-auto"
        >
            <section id="login" class="prose max-w-[40ch] w-full mx-auto">
                <div class="flex-col gap-0 w-full">
                    <h3 class="mb-4">
                        Parece que no estas en ningun curso!
                    </h3>
                    <p class="mb-4">
                        Tu preceptor te asignara uno lo mas pronto posible.
                    </p>
                    <div class="flex flex-col gap-3">
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
                    </div>
                </div>
            </section>
        </main>
    </section>
</template>
