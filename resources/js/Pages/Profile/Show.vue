<script setup>
import { Head } from "@inertiajs/vue3";
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
import LogoutOtherBrowserSessionsForm from "@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue";
import TwoFactorAuthenticationForm from "@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
  layout: AppLayout,
}
</script>

<template>
    <Head title="Perfil" />
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                <UpdateProfileInformationForm :user="$page.props.auth.user" />
                <hr
                    class="my-8 flex items-center justify-center border-none bg-white/20 h-[1px]"
                />
            </div>
            <div v-if="$page.props.jetstream.canUpdatePassword">
                <UpdatePasswordForm class="mt-10 sm:mt-0" />
                <hr
                    class="my-8 flex items-center justify-center border-none bg-white/20 h-[1px]"
                />
            </div>
            <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                <TwoFactorAuthenticationForm
                    :requires-confirmation="confirmsTwoFactorAuthentication"
                    class="mt-10 sm:mt-0"
                />
                <hr
                    class="my-8 flex items-center justify-center border-none bg-white/20 h-[1px]"
                />
            </div>
            <LogoutOtherBrowserSessionsForm
                :sessions="sessions"
                class="mt-10 sm:mt-0"
            />
            <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                <hr
                    class="my-8 flex items-center justify-center border-none bg-white/20 h-[1px]"
                />
                <DeleteUserForm class="mt-10 sm:mt-0" />
            </template>
        </div>
    </div>
</template>
