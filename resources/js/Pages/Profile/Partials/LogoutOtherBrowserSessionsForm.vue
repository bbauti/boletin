<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import ActionSection from '@/Components/ActionSection.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    sessions: Array,
});

const confirmingLogout = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmLogout = () => {
    confirmingLogout.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const logoutOtherBrowserSessions = () => {
    form.delete(route('other-browser-sessions.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingLogout.value = false;

    form.reset();
};
</script>

<template>
    <ActionSection>
        <template #title>
            Otros navegadores
        </template>

        <template #description>
            Gestione y cierre sus sesiones activas en otros navegadores y dispositivos.
        </template>

        <template #content>
            <div class="max-w-xl text-sm">
                Si es necesario, puede cerrar todas sus sesiones de navegación en todos sus dispositivos. A continuación se enumeran algunas de sus sesiones recientes; sin embargo, esta lista puede no estar completa. Si cree que su cuenta se ha visto comprometida, actualice también su contraseña.            </div>

            <!-- Other Browser Sessions -->
            <div v-if="sessions.length > 0" class="mt-5 space-y-6">
                <div v-for="(session, i) in sessions" :key="i" class="flex items-center">
                    <div>
                        <svg v-if="session.agent.is_desktop" class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                        </svg>

                        <svg v-else class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                        </svg>
                    </div>

                    <div class="ml-3">
                        <div class="text-sm">
                            {{ session.agent.platform ? session.agent.platform : 'Desconocido' }} - {{ session.agent.browser ? session.agent.browser : 'Desconocido' }}
                        </div>

                        <div>
                            <div class="text-xs">
                                {{ session.ip_address }},

                                <span v-if="session.is_current_device" class="text-success font-semibold">Este dispositivo</span>
                                <span v-else>Ultima vez: {{ session.last_active }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-5">
                <button class="btn btn-success" @click="confirmLogout">
                    Cerrar otras sesiones
                </button>

                <ActionMessage :on="form.recentlySuccessful" class="ml-3">
                    Hecho.
                </ActionMessage>
            </div>

            <!-- Log Out Other Devices Confirmation Modal -->
            <DialogModal :show="confirmingLogout" @close="closeModal">
                <template #title>
                    Cerrar otras sesiones
                </template>

                <template #content>
                    Por favor, introduzca su contraseña para confirmar que desea desconectarse de sus otras sesiones de navegación en todos sus dispositivos.
                    <div class="mt-4">
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
                            @keyup.enter="logoutOtherBrowserSessions"
                            placeholder="•••••"
                        />
                        <label
                            v-if="form.errors.email"
                            class="label"
                            for="password"
                        >
                            <span class="label-text text-error">
                                {{ form.errors.password }}
                            </span>
                        </label>
                    </div>
                    </div>
                </template>

                <template #footer>
                    <div class="flex justify-between gap-5 w-full">
                        <button
                            v-if="form.processing"
                            class="btn bg-success border-accent/10 hover:bg-success/10 hover:border-accent/30 justify-center font-bold min-h-[2.5rem] h-[2.5rem] w-fit mt-5 opacity-80"
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
                            class="btn bg-success border-accent/10 hover:bg-success/10 hover:border-accent/30 justify-center font-bold min-h-[2.5rem] h-[2.5rem] w-fit mt-5"
                            name="sendcode"
                            aria-label="Enviar correo"
                            @click="logoutOtherBrowserSessions"
                        >
                            Cerrar otras sesiones del navegador
                        </button>
                        <button
                            class="btn bg-secondary border-accent/10 hover:bg-accent/10 hover:border-accent/30 justify-center font-bold min-h-[2.5rem] h-[2.5rem] w-fit mt-5"
                            @click="closeModal">
                            Cancelar
                        </button>
                    </div>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
