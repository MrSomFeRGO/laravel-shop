<script lang="ts" setup>
import NavLayout from "@/Layouts/NavLayout.vue";
import {PropType} from "vue";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import AuthData = App.Data.AuthData;

const props = defineProps({
    auth: Object as PropType<AuthData>
})
const forgotForm = useForm({
    email: '',
})

function forgotSubmit() {
    forgotForm.post(route('password.email'), {
        onSuccess: () => {
            forgotForm.reset();
        },
        onFinish: () => {
            forgotForm.reset('email');
        },
    });
}
</script>

<template>
    <NavLayout :auth="auth" title="Восстановить пароль">
        <div class="mx-auto bg-white shadow-md p-4" style="margin-top: 20%; width: 30%">
            <form @submit.prevent="forgotSubmit">
                <p class="text-xl font-semibold text-center">Восстановление пароля</p>
                <input v-model="forgotForm.email" class="mt-4 w-full" placeholder="Почта" type="email"/>
                <InputError :message="forgotForm.errors.email"></InputError>
                <PrimaryButton :class="{ 'opacity-25': forgotForm.processing }"
                               :disabled="forgotForm.processing"
                               class="w-full mt-4"
                               type="submit">
                    Отправить письмо
                </PrimaryButton>
            </form>
        </div>
    </NavLayout>
</template>

<style scoped>

</style>
