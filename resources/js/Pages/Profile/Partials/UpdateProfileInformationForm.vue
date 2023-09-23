<script setup>
import { ref } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import { toast } from "vue-sonner";

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: "PUT",
    name: props.user.name,
    email: props.user.email,
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route("user-profile-information.update"), {
        errorBag: "updateProfileInformation",
        preserveScroll: true,
        onSuccess: () => {
            clearPhotoFileInput();
            toast.success("Perfil actualizado correctamente");
        },
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route("current-user-photo.destroy"), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title> Informacion del perfil </template>

        <template #description>
            Actualiza la informacion de tu perfil y direccion de correo
            electronico.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div
                v-if="$page.props.jetstream.managesProfilePhotos"
                class="col-span-6 sm:col-span-4"
            >
                <!-- Profile Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                />

                <label class="label" for="photo">
                    <span class="label-text">Foto de perfil</span>
                </label>

                <!-- Current Profile Photo -->
                <div v-show="!photoPreview" class="mt-2">
                    <img
                        :src="user.profile_photo_url"
                        :alt="user.name"
                        class="rounded-full h-20 w-20 object-cover"
                    />
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="
                            'background-image: url(\'' + photoPreview + '\');'
                        "
                    />
                </div>

                <button
                    class="btn btn-off mt-5"
                    type="button"
                    @click.prevent="selectNewPhoto"
                >
                    Cambiar imagen
                </button>

                <button
                    v-if="user.profile_photo_path"
                    type="button"
                    class="btn btn-error-secondary ml-2 mt-5"
                    @click.prevent="deletePhoto"
                >
                    Borrar
                </button>

                <label v-if="form.errors.photo" class="label">
                    <span class="label-text text-error">
                        {{ form.errors.photo }}
                    </span>
                </label>
            </div>

            <!-- Name -->
            <div class="form-control col-span-6 sm:col-span-4">
                <label class="label" for="name">
                    <span class="label-text">Nombre</span>
                </label>
                <input
                    class="input input-bordered w-full"
                    id="name"
                    v-model="form.name"
                    type="text"
                    required
                    autocomplete="name"
                    :placeholder="$page.props.auth.user.name"
                />
                <label v-if="form.errors.name" class="label" for="name">
                    <span class="label-text text-error">
                        {{ form.errors.name }}
                    </span>
                </label>
            </div>

            <!-- Email -->
            <div class="form-control col-span-6 sm:col-span-4">
                <label class="label" for="email">
                    <span class="label-text">Nombre</span>
                </label>
                <input
                    class="input input-bordered w-full"
                    id="email"
                    v-model="form.email"
                    type="email"
                    required
                    autocomplete="username"
                    :placeholder="$page.props.auth.user.email"
                />
                <label v-if="form.errors.email" class="label" for="email">
                    <span class="label-text text-error">
                        {{ form.errors.email }}
                    </span>
                </label>
            </div>
            <div
                class="col-span-6 sm:col-span-4"
                v-if="
                    $page.props.jetstream.hasEmailVerification &&
                    user.email_verified_at === null
                "
            >
                <p class="text-sm mt-2">
                    Su dirección de correo electrónico no está verificada.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="text-sm link"
                        @click.prevent="sendEmailVerification"
                    >
                        Haga clic aquí para volver a enviar el correo
                        electrónico de verificación.
                    </Link>
                </p>
                <div
                    v-show="verificationLinkSent"
                    class="mt-2 font-medium text-sm text-success"
                >
                    Se ha enviado un nuevo enlace de verificación a su dirección
                    de correo electrónico.
                </div>
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
            <ActionMessage :on="form.recentlySuccessful" class="ml-5">
                Guardado.
            </ActionMessage>
        </template>
    </FormSection>
</template>
