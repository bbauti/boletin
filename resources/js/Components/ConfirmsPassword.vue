<script setup>
import { ref, reactive, nextTick } from "vue";
import DialogModal from "./DialogModal.vue";

const emit = defineEmits(["confirmed"]);

defineProps({
    title: {
        type: String,
        default: "Confirma tu contraseña",
    },
    content: {
        type: String,
        default: "Por tu seguridad, confirma tu contraseña para continuar.",
    },
    button: {
        type: String,
        default: "Confirmar",
    },
});

const confirmingPassword = ref(false);

const form = reactive({
    password: "",
    error: "",
    processing: false,
});

const passwordInput = ref(null);

const startConfirmingPassword = () => {
    console.log('startConfirmingPassword')
    axios.get(route("password.confirmation")).then((response) => {
        if (response.data.confirmed) {
            emit("confirmed");
        } else {
            confirmingPassword.value = true;

            setTimeout(() => passwordInput.value.focus(), 250);
        }
    });
};

const confirmPassword = () => {
    form.processing = true;

    axios
        .post(route("password.confirm"), {
            password: form.password,
        })
        .then(() => {
            form.processing = false;

            closeModal();
            nextTick().then(() => emit("confirmed"));
        })
        .catch((error) => {
            form.processing = false;
            form.error = error.response.data.errors.password[0];
            passwordInput.value.focus();
        });
};

const closeModal = () => {
    confirmingPassword.value = false;
    form.password = "";
    form.error = "";
};
</script>

<template>
    <span>
        <span @click="startConfirmingPassword">
            <slot />
        </span>

        <DialogModal :show="confirmingPassword" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                {{ content }}
                <div class="form-control w-full mt-5">
                    <input
                        class="input input-bordered w-full"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        autocomplete="current-password"
                        @keyup.enter="confirmPassword"
                        placeholder="•••••"
                    />
                    <label v-if="form.errors" class="label" for="password">
                        <span class="label-text text-error">
                            {{ form.errors }}
                        </span>
                    </label>
                </div>
            </template>

            <template #footer>
                <div class="flex justify-between w-full">
                    <button
                        class="btn btn-accent"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="confirmPassword"
                    >
                        {{ button }}
                    </button>
                    <button class="btn btn-off" @click="closeModal">
                        Cancelar
                    </button>
                </div>
            </template>
        </DialogModal>
    </span>
</template>
