<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import { toast } from "vue-sonner";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const updatePassword = () => {
    form.put(route("user-password.update"), {
        errorBag: "updatePassword",
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            toast.success("Contraseña actualizada correctamente");
        },
        onError: () => {
            if (form.errors.password) {
                form.reset("password", "password_confirmation");
                passwordInput.value.focus();
            }

            if (form.errors.current_password) {
                form.reset("current_password");
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <FormSection @submitted="updatePassword">
        <template #title> Actualizar contraseña </template>

        <template #description>
            Asegúrate de que tu cuenta utiliza una contraseña larga y aleatoria
            para mayor seguridad.
        </template>

        <template #form>
            <div class="form-control col-span-6 sm:col-span-4">
                <label class="label" for="current_password">
                    <span class="label-text">Contraseña actual</span>
                </label>
                <input
                    class="input input-bordered w-full"
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    autocomplete="current-password"
                    placeholder="•••••"
                />
                <label
                    v-if="form.errors.current_password"
                    class="label"
                    for="current_password"
                >
                    <span class="label-text text-error">
                        {{ form.errors.current_password }}
                    </span>
                </label>
            </div>
            <div class="form-control col-span-6 sm:col-span-4">
                <label class="label" for="password">
                    <span class="label-text">Contraseña nueva</span>
                </label>
                <input
                    class="input input-bordered w-full"
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    autocomplete="new-password"
                    placeholder="•••••"
                />
                <label v-if="form.errors.password" class="label" for="password">
                    <span class="label-text text-error">
                        {{ form.errors.password }}
                    </span>
                </label>
            </div>
            <div class="form-control col-span-6 sm:col-span-4">
                <label class="label" for="password_confirmation">
                    <span class="label-text">Confirmar contraseña</span>
                </label>
                <input
                    class="input input-bordered w-full"
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    placeholder="•••••"
                />
                <label
                    v-if="form.errors.password_confirmation"
                    class="label"
                    for="password_confirmation"
                >
                    <span class="label-text text-error">
                        {{ form.errors.password_confirmation }}
                    </span>
                </label>
            </div>
        </template>

        <template #actions>
            <button
                class="btn btn-accent"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Guardar
            </button>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Guardado.
            </ActionMessage>
        </template>
    </FormSection>
</template>
