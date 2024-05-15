<script setup lang="ts">

import NavLayout from "@/Layouts/NavLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Link, useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import {PropType} from "vue";
import AuthData = App.Data.AuthData;

const props = defineProps({
    auth: Object as PropType<AuthData>,
})
const loginForm = useForm({
    email: '',
    password: '',
    confirmPassword: '',
})

function loginSubmit() {
    loginForm.post(route('login.store'), {
        onSuccess: () => {
            loginForm.reset();
        },
        onFinish: () => {
            loginForm.reset('password');
        },
    });
}
</script>

<template>
    <NavLayout title="Авторизация" :auth="auth">
        <div class="mx-auto bg-white shadow-md p-4" style="margin-top: 20%; width: 30%">
            <form @submit.prevent="loginSubmit">
                <p class="text-xl font-semibold text-center">Авторизация</p>
                <input placeholder="Почта" v-model="loginForm.email" class="mt-4 w-full" type="email"/>
                <InputError :message="loginForm.errors.email"></InputError>
                <input placeholder="Пароль" v-model="loginForm.password" class="mt-4 w-full" type="password"/>
                <InputError :message="loginForm.errors.password"></InputError>
                <PrimaryButton class="w-full mt-4"
                               :class="{ 'opacity-25': loginForm.processing }"
                               :disabled="loginForm.processing"
                               type="submit">
                    Войти
                </PrimaryButton>
                <p class="text-center mt-4">Нет аккаунта?
                    <Link :href="route('register.index')" class="underline">Создать</Link>
                </p>
                <p class="text-center mt-4">Забыли пароль?
                    <Link :href="route('password.request')" class="underline">Восстановить</Link>
                </p>
            </form>
        </div>
    </NavLayout>
</template>

<style scoped>

</style>
