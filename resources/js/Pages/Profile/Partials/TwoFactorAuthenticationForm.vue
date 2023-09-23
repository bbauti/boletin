<script setup>
import { ref, computed, watch } from "vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import ActionSection from "@/Components/ActionSection.vue";
import ConfirmsPassword from "@/Components/ConfirmsPassword.vue";
import { toast } from "vue-sonner";

const props = defineProps({
    requiresConfirmation: Boolean,
});

const page = usePage();
const enabling = ref(false);
const confirming = ref(false);
const disabling = ref(false);
const qrCode = ref(null);
const setupKey = ref(null);
const recoveryCodes = ref([]);

const confirmationForm = useForm({
    code: "",
});

const twoFactorEnabled = computed(
    () => !enabling.value && page.props.auth.user?.two_factor_enabled
);

watch(twoFactorEnabled, () => {
    if (!twoFactorEnabled.value) {
        confirmationForm.reset();
        confirmationForm.clearErrors();
    }
});

const enableTwoFactorAuthentication = () => {
    enabling.value = true;

    router.post(
        route("two-factor.enable"),
        {},
        {
            preserveScroll: true,
            onSuccess: () =>
                Promise.all([
                    showQrCode(),
                    showSetupKey(),
                    showRecoveryCodes(),
                ]),
            onFinish: () => {
                enabling.value = false;
                confirming.value = props.requiresConfirmation;
            },
        }
    );
};

const showQrCode = () => {
    return axios.get(route("two-factor.qr-code")).then((response) => {
        qrCode.value = response.data.svg;
    });
};

const showSetupKey = () => {
    return axios.get(route("two-factor.secret-key")).then((response) => {
        setupKey.value = response.data.secretKey;
    });
};

const showRecoveryCodes = () => {
    return axios.get(route("two-factor.recovery-codes")).then((response) => {
        recoveryCodes.value = response.data;
    });
};

const confirmTwoFactorAuthentication = () => {
    confirmationForm.post(route("two-factor.confirm"), {
        errorBag: "confirmTwoFactorAuthentication",
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            confirming.value = false;
            qrCode.value = null;
            setupKey.value = null;
            toast.success("Autenticacion de dos factores activada");
        },
    });
};

const regenerateRecoveryCodes = () => {
    axios
        .post(route("two-factor.recovery-codes"))
        .then(() => showRecoveryCodes());
};

const disableTwoFactorAuthentication = () => {
    disabling.value = true;

    router.delete(route("two-factor.disable"), {
        preserveScroll: true,
        onSuccess: () => {
            disabling.value = false;
            confirming.value = false;
            toast.success("Autenticacion de dos factores desactivada");
        },
    });
};
</script>

<template>
    <ActionSection>
        <template #title> Autenticación de dos factores </template>

        <template #description>
            Añadi seguridad adicional a tu cuenta mediante la autenticación de
            dos factores.
        </template>

        <template #content>
            <h3
                v-if="twoFactorEnabled && !confirming"
                class="text-lg font-medium"
            >
                Tenes activada la autenticación de dos factores.
            </h3>

            <h3
                v-else-if="twoFactorEnabled && confirming"
                class="text-lg font-medium"
            >
                Termina de habilitar la autenticación de dos factores.
            </h3>

            <h3 v-else class="text-lg font-medium">
                No activaste la autenticación de dos factores.
            </h3>

            <div class="mt-3 max-w-xl text-sm">
                <p>
                    Cuando la autenticación de dos factores está activada, se le
                    pedirá un código aleatorio seguro durante la autenticación.
                    Puede encontrar este codigo en la aplicación Google
                    Authenticator desde su teléfono.
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm">
                        <p v-if="confirming" class="font-semibold">
                            Para terminar de activar la autenticación de dos
                            factores, escanee el siguiente código QR con la
                            aplicación o introduzca la clave de configuración y
                            el código OTP generado.
                        </p>

                        <p v-else>
                            La autenticación de dos factores ya está activada.
                            Escanee el siguiente código QR con la aplicación de
                            autenticación de tu teléfono o introduce la clave de
                            configuración.
                        </p>
                    </div>

                    <div
                        class="mt-4 p-2 inline-block bg-white"
                        v-html="qrCode"
                    />

                    <div v-if="setupKey" class="mt-4 max-w-xl text-sm">
                        <p class="font-semibold">
                            Llave de configuración:
                            <span v-html="setupKey"></span>
                        </p>
                    </div>
                    <div v-if="confirming" class="form-control">
                        <label class="label" for="code">
                            <span class="label-text">Codigo</span>
                        </label>
                        <input
                            class="input input-bordered w-fit"
                            id="code"
                            v-model="confirmationForm.code"
                            type="text"
                            name="code"
                            inputmode="numeric"
                            autofocus
                            autocomplete="one-time-code"
                            @keyup.enter="confirmTwoFactorAuthentication"
                        />
                        <label
                            v-if="confirmationForm.errors.code"
                            class="label"
                            for="code"
                        >
                            <span class="label-text text-error">
                                {{ confirmationForm.errors.code }}
                            </span>
                        </label>
                    </div>
                </div>

                <div v-if="recoveryCodes.length > 0 && !confirming">
                    <div class="mt-4 max-w-xl text-sm">
                        <p class="font-semibold">
                            Guarde estos códigos de recuperación en un lugar
                            seguro. Pueden utilizarse para recuperar el acceso a
                            su cuenta si pierde el dispositivo de autenticación.
                        </p>
                    </div>

                    <div
                        class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 dark:bg-gray-900 dark:text-gray-100 rounded-lg"
                    >
                        <div v-for="code in recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="!twoFactorEnabled">
                    <ConfirmsPassword
                        @confirmed="enableTwoFactorAuthentication"
                    >
                        <button
                            class="btn btn-accent"
                            :class="{ 'opacity-25': enabling }"
                            :disabled="enabling"
                        >
                            Activar
                        </button>
                    </ConfirmsPassword>
                </div>

                <div v-else class="flex gap-1 items-center">
                    <ConfirmsPassword
                        @confirmed="confirmTwoFactorAuthentication"
                        v-if="confirming"
                    >
                        <button
                            class="btn btn-accent"
                            :class="{ 'opacity-25': enabling }"
                            :disabled="enabling"
                        >
                            Activar
                        </button>
                    </ConfirmsPassword>

                    <ConfirmsPassword
                        @confirmed="regenerateRecoveryCodes"
                        v-if="recoveryCodes.length > 0 && !confirming"
                    >
                        <button class="btn btn-off">
                            Regenerar codigos de recuperacion
                        </button>
                    </ConfirmsPassword>

                    <ConfirmsPassword
                        @confirmed="showRecoveryCodes"
                        v-if="recoveryCodes.length === 0 && !confirming"
                    >
                        <button class="btn btn-off">
                            Ver codigos de recuperacion
                        </button>
                    </ConfirmsPassword>

                    <ConfirmsPassword
                        @confirmed="disableTwoFactorAuthentication"
                        v-if="confirming"
                    >
                        <button
                            class="btn btn-off"
                            :class="{ 'opacity-25': disabling }"
                            :disabled="disabling"
                        >
                            Cancelar
                        </button>
                    </ConfirmsPassword>

                    <ConfirmsPassword
                        @confirmed="disableTwoFactorAuthentication"
                        v-if="!confirming"
                    >
                        <button
                            class="btn btn-error"
                            :class="{ 'opacity-25': disabling }"
                            :disabled="disabling"
                        >
                            Desactivar
                        </button>
                    </ConfirmsPassword>
                </div>
            </div>
        </template>
    </ActionSection>
</template>
