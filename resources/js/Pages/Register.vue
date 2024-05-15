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

const regForm = useForm({
    email: '',
    password: '',
    confirmPassword: '',
})

function registerSubmit() {
    regForm.post(route('register.store'), {
        onSuccess: () => {
            regForm.reset();
        },
        onFinish: () => {
            regForm.reset('password', 'confirmPassword');
        },
    });
}
</script>

<template>
    <NavLayout title="Регистрация" :auth="auth">
        <div class="mx-auto bg-white shadow-md p-4" style="margin-top: 20%; width: 30%">
            <form @submit.prevent="registerSubmit">
                <p class="text-xl font-semibold text-center">Регистрация</p>
                <input placeholder="Почта" v-model="regForm.email" class="mt-4 w-full" type="email"/>
                <InputError :message="regForm.errors.email"></InputError>
                <input placeholder="Пароль" v-model="regForm.password" class="mt-4 w-full" type="password"/>
                <InputError :message="regForm.errors.password"></InputError>
                <input placeholder="Подтвердите пароль" v-model="regForm.confirmPassword" class="mt-4 w-full"
                       type="password"/>
                <InputError :message="regForm.errors.confirmPassword"></InputError>
                <PrimaryButton class="w-full mt-4"
                               :class="{ 'opacity-25': regForm.processing }"
                               :disabled="regForm.processing"
                               type="submit">
                    Зарегистрироваться
                </PrimaryButton>
                <p class="text-center mt-4">Уже есть аккаунта?
                    <Link :href="route('login.index')" class="underline">Войти</Link>
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
