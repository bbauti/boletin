<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import ActionSection from "@/Components/ActionSection.vue";
import DialogModal from "@/Components/DialogModal.vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: "",
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
    form.delete(route("current-user.destroy"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <ActionSection>
        <template #title> Borrar cuenta </template>

        <template #description> Borrar permanentemente tu cuenta. </template>

        <template #content>
            <div class="max-w-xl text-sm font-semibold">
                Una vez eliminada su cuenta, todos sus recursos y datos se
                borrarán permanentemente.
            </div>

            <div class="mt-5">
                <button class="btn btn-error" @click="confirmUserDeletion">
                    Borrar cuenta
                </button>
            </div>

            <DialogModal :show="confirmingUserDeletion" @close="closeModal">
                <template #title> Borrar cuenta </template>

                <template #content>
                    ¿Está seguro de que desea eliminar su cuenta? Por favor,
                    introduzca su contraseña para confirmar que desea eliminar
                    permanentemente su cuenta.
                    <div class="form-control w-full">
                        <label class="label" for="password">
                            <span class="label-text">Contraseña</span>
                        </label>
                        <input
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            name="password"
                            class="input input-bordered w-full"
                            autocomplete="current-password"
                            @keyup.enter="deleteUser"
                            placeholder="•••••"
                        />
                        <label
                            v-if="form.errors.password"
                            class="label"
                            for="password"
                        >
                            <span class="label-text text-error">
                                {{ form.errors.password }}
                            </span>
                        </label>
                    </div>
                </template>

                <template #footer>
                    <div class="flex justify-between w-full">
                        <button
                            class="btn btn-error"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click="deleteUser"
                        >
                            Borrar cuenta
                        </button>
                        <button class="btn btn-off" @click="closeModal">
                            Cancelar
                        </button>
                    </div>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
