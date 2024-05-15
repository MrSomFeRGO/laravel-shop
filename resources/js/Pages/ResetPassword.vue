<script lang="ts" setup>
import NavLayout from "@/Layouts/NavLayout.vue";
import {PropType} from "vue";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import AuthData = App.Data.AuthData;

const props = defineProps({
    email: String,
    token: String,
    auth: Object as PropType<AuthData>
})
const resetForm = useForm({
    email: props.email,
    token: props.token,
    password: '',
    password_confirmation: '',
})

function resetSubmit() {
    resetForm.post(route('password.store'), {
        onSuccess: () => {
            resetForm.reset();
        },
        onFinish: () => {
            resetForm.reset('password', 'password_confirmation');
        },
    });
}
</script>

<template>
    <NavLayout :auth="auth" title="Изменить пароль">
        <div class="mx-auto bg-white shadow-md p-4" style="margin-top: 20%; width: 30%">
            <form @submit.prevent="resetSubmit">
                <p class="text-xl font-semibold text-center">Изменение пароля</p>
                <input v-model="resetForm.email" class="mt-4 w-full" placeholder="Почта" type="email"/>
                <InputError :message="resetForm.errors.email"></InputError>
                <input v-model="resetForm.password" class="mt-4 w-full" placeholder="Пароль" type="password"/>
                <InputError :message="resetForm.errors.password"></InputError>
                <input v-model="resetForm.password_confirmation" class="mt-4 w-full" placeholder="Повторите пароль"
                       type="password"/>
                <InputError :message="resetForm.errors.password_confirmation"></InputError>
                <PrimaryButton :class="{ 'opacity-25': resetForm.processing }"
                               :disabled="resetForm.processing"
                               class="w-full mt-4"
                               type="submit">
                    Изменить
                </PrimaryButton>
            </form>
        </div>
    </NavLayout>
</template>

<style scoped>

</style>
