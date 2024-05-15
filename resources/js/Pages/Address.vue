<script setup lang="ts">

import {Link, useForm} from "@inertiajs/vue3";
import NavLayout from "@/Layouts/NavLayout.vue";
import {onMounted, PropType} from "vue";
import InputError from "@/Components/InputError.vue";
import UserAddressData = App.Data.UserAddressData;
import AuthData = App.Data.AuthData;

const props = defineProps({
    auth: Object as PropType<AuthData>,
    user_address: Object as PropType<UserAddressData>,
})
onMounted(function () {
    if (props.user_address) {
        userAddressForm.country = props.user_address.country;
        userAddressForm.region = props.user_address.region;
        userAddressForm.city = props.user_address.city;
        userAddressForm.address = props.user_address.address;
        userAddressForm.zipcode = props.user_address.zipcode;
        userAddressForm.fio = props.user_address.fio;
        userAddressForm.phone_number = props.user_address.phone_number;
    }
})

const userAddressForm = useForm({
    country: '',
    region: '',
    city: '',
    address: '',
    zipcode: '',
    fio: '',
    phone_number: '',
})

function addressAdd() {
    userAddressForm.post(route('profile.address.store'), {
        onSuccess: () => {
            userAddressForm.reset();
        },
    });
}

function addressUpdate() {
    userAddressForm.put(route('profile.address.update', props.user_address!.id!), {
        onSuccess: () => {
            userAddressForm.reset();
        },
    });
}
</script>

<template>
    <NavLayout title="Профиль" :auth="auth">
        <div class="bg-white px-16 min-h-screen shadow-md">
            <!--Крошки-->
            <p class="text-gray-400 pt-8">
                <Link :href="route('home.index')">Главная</Link>
                /
                <Link :href="route('profile.index')">Профиль</Link>
                /
                <Link :href="route('profile.address.index')" class="text-black">Адрес</Link>
            </p>

            <div class=" w-1/2">
                <p v-show="!user_address" class="pt-4 font-bold text-4xl">Добавление адреса</p>
                <p v-show="user_address" class="pt-4 font-bold text-4xl">Изменение адреса</p>

                <form v-if="!user_address" @submit.prevent="addressAdd" class=" mt-4 flex flex-col">

                    <p class="text-2xl font-bold">Получатель</p>
                    <input v-model="userAddressForm.fio" autocomplete="chrome-off"
                           class="mt-4 w-full rounded-sm"
                           placeholder="Фамилия Имя Отчество"/>
                    <InputError :message="userAddressForm.errors.fio"></InputError>
                    <input v-model="userAddressForm.phone_number" autocomplete="chrome-off"
                           class="mt-4 w-full rounded-sm" placeholder="Номер телефона"/>

                    <p class="pt-6 text-2xl font-bold">Адрес</p>
                    <input placeholder="Страна" v-model="userAddressForm.country" class="mt-4 w-full rounded-sm"
                           autocomplete="chrome-off"/>
                    <InputError :message="userAddressForm.errors.country"></InputError>
                    <input placeholder="Край/Область/Регион" v-model="userAddressForm.region"
                           class="mt-4 w-full rounded-sm"
                           autocomplete="chrome-off"/>
                    <InputError :message="userAddressForm.errors.region"></InputError>
                    <input placeholder="Город" v-model="userAddressForm.city" class="mt-4 w-full rounded-sm"
                           autocomplete="chrome-off"/>
                    <InputError :message="userAddressForm.errors.city"></InputError>
                    <div class="flex flex-row space-x-4">
                        <div class="flex flex-col  mt-4 w-3/4">
                            <input placeholder="Улица, дом и квартира" v-model="userAddressForm.address"
                                   class="w-full rounded-sm" autocomplete="chrome-off"/>
                            <InputError :message="userAddressForm.errors.address"></InputError>
                        </div>
                        <div class=" flex flex-col mt-4 w-1/4">

                            <input placeholder="Индекс" v-model="userAddressForm.zipcode" class="w-full rounded-sm"
                                   autocomplete="chrome-off"/>
                            <InputError :message="userAddressForm.errors.zipcode"></InputError>
                        </div>
                    </div>
                    <InputError :message="userAddressForm.errors.phone_number"></InputError>
                    <button type="submit" class="p-2 text-2xl rounded-sm bg-red-500 text-white mt-4">
                        Добавить адрес
                    </button>

                </form>
                <form v-if="user_address" @submit.prevent="addressUpdate" class=" mt-4 flex flex-col">
                    <input placeholder="Страна" v-model="userAddressForm.country" class="mt-4 w-full rounded-sm"
                           autocomplete="chrome-off"/>
                    <InputError :message="userAddressForm.errors.country"></InputError>
                    <input placeholder="Край/Область/Регион" v-model="userAddressForm.region"
                           class="mt-4 w-full rounded-sm"
                           autocomplete="chrome-off"/>
                    <InputError :message="userAddressForm.errors.region"></InputError>
                    <input placeholder="Город" v-model="userAddressForm.city" class="mt-4 w-full rounded-sm"
                           autocomplete="chrome-off"/>
                    <InputError :message="userAddressForm.errors.city"></InputError>
                    <div class="flex flex-row space-x-4">
                        <div class="flex flex-col  mt-4 w-3/4">
                            <input placeholder="Улица, дом и квартира" v-model="userAddressForm.address"
                                   class="w-full rounded-sm" autocomplete="chrome-off"/>
                            <InputError :message="userAddressForm.errors.address"></InputError>
                        </div>
                        <div class=" flex flex-col mt-4 w-1/4">

                            <input placeholder="Индекс" v-model="userAddressForm.zipcode" class="w-full rounded-sm"
                                   autocomplete="chrome-off"/>
                            <InputError :message="userAddressForm.errors.zipcode"></InputError>
                        </div>
                    </div>
                    <p class="pt-6 text-2xl font-bold">Получатель</p>
                    <input placeholder="Фамилия Имя Отчество" v-model="userAddressForm.fio"
                           class="mt-4 w-full rounded-sm"
                           autocomplete="chrome-off"/>
                    <InputError :message="userAddressForm.errors.fio"></InputError>
                    <input placeholder="Номер телефона" v-model="userAddressForm.phone_number"
                           class="mt-4 w-full rounded-sm" autocomplete="chrome-off"/>
                    <InputError :message="userAddressForm.errors.phone_number"></InputError>
                    <button type="submit" class="p-2 text-2xl rounded-sm bg-red-500 text-white mt-4">
                        Изменить адрес
                    </button>
                </form>
            </div>
        </div>
    </NavLayout>
</template>

<style scoped>

</style>
