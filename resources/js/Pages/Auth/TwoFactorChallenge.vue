<script setup>
import { nextTick, ref } from "vue";
import { Head, useForm } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

const recovery = ref(false);

const form = useForm({
    code: "",
    recovery_code: "",
});

const recoveryCodeInput = ref(null);
const codeInput = ref(null);

const toggleRecovery = async () => {
    recovery.value ^= true;

    await nextTick();

    if (recovery.value) {
        recoveryCodeInput.value.focus();
        form.code = "";
    } else {
        codeInput.value.focus();
        form.recovery_code = "";
    }
};

const submit = () => {
    form.post(route("two-factor.login"));
};
</script>

<template>
    <Head title="Autenticacion de dos factores" />
    <section class="flex flex-1 h-screen bg-base-100">
        <main
            class="flex flex-col items-center flex-1 flex-shrink-0 px-5 py-16 lg:border-r border-accent/10 overflow-y-auto m-auto"
        >
            <section
                id="login"
                class="prose max-w-[40ch] w-full mx-auto border-2 border-white/10 shadow-lg p-5 rounded-box"
            >
                <div class="flex-col gap-0 w-full">
                    <p v-if="!recovery" class="mt-1 mb-4 font-medium text-lg">
                        Confirme el acceso a su cuenta
                    </p>
                    <p v-else class="mt-1 mb-4 font-medium text-lg">
                        Ingrese uno de sus códigos de recuperación de emergencia
                    </p>
                    <div class="flex flex-col gap-3">
                        <form @submit.prevent="submit">
                            <div class="form-control w-full" v-if="!recovery">
                                <label class="label" for="code">
                                    <span class="label-text">Codigo</span>
                                </label>
                                <input
                                    class="input input-bordered"
                                    id="code"
                                    ref="codeInput"
                                    v-model="form.code"
                                    type="text"
                                    inputmode="numeric"
                                    autofocus
                                    autocomplete="one-time-code"
                                    placeholder="123 456"
                                />
                                <label
                                    v-if="form.errors.code"
                                    class="label"
                                    for="code"
                                >
                                    <span class="label-text text-error">
                                        {{ form.errors.code }}
                                    </span>
                                </label>
                            </div>
                            <div class="form-control w-full" v-else>
                                <label class="label" for="recovery_code">
                                    <span class="label-text"
                                        >Codigo de recuperacion</span
                                    >
                                </label>
                                <input
                                    class="input input-bordered"
                                    id="recovery_code"
                                    ref="recoveryCodeInput"
                                    v-model="form.recovery_code"
                                    type="text"
                                    autocomplete="one-time-code"
                                    placeholder="ab1de2ghi..."
                                />
                                <label
                                    v-if="form.errors.recovery_code"
                                    class="label"
                                    for="recovery_code"
                                >
                                    <span class="label-text text-error">
                                        {{ form.errors.recovery_code }}
                                    </span>
                                </label>
                            </div>
                            <button
                                v-if="form.processing"
                                class="btn bg-secondary-content border-accent/10 hover:bg-accent/10 hover:border-accent/30 justify-center font-bold min-h-[2.5rem] h-[2.5rem] w-full mt-5 opacity-80"
                                name="sendcode"
                                disabled
                                aria-label="Enviar correo"
                            >
                                <span
                                    class="loading loading-spinner loading-md"
                                ></span>
                                Cargando...
                            </button>
                            <button
                                v-if="!form.processing"
                                class="btn bg-secondary-content border-accent/10 hover:bg-accent/10 hover:border-accent/30 justify-center font-bold min-h-[2.5rem] h-[2.5rem] w-full mt-5"
                                name="sendcode"
                                aria-label="Enviar correo"
                            >
                                Iniciar sesion
                            </button>
                        </form>
                        <button
                            class="link link-hover text-sm text-accent/50 font-normal w-fit flex"
                            @click.prevent="toggleRecovery"
                        >
                            <span v-if="!recovery">
                                Usar un codigo de recuperacion
                            </span>

                            <span v-else>
                                Tengo un codigo de autenticacion
                            </span>
                        </button>
                    </div>
                </div>
            </section>
        </main>
    </section>
</template>
