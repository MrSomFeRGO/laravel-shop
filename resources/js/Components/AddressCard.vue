<script setup lang="ts">
import {PropType, Ref} from "vue";
import {router} from "@inertiajs/vue3";
import UserAddressData = App.Data.UserAddressData;

const props = defineProps({
    user_addresses: Array as PropType<UserAddressData[]>,
    selected_menu: Object as PropType<Ref>,
})
</script>

<template>
    <div class="w-full bg-gray-200 shadow-md rounded-sm p-2.5 flex-col flex" v-for="address in user_addresses">
        <div class="inline-flex space-x-1 items-center pt-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6 shrink-0 grow-0">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
            </svg>
            <p class="font-semibold text-sm">{{ address.fio + ', ' + address.phone_number }}</p>
        </div>
        <div class="inline-flex space-x-1  mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6 grow-0 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
            </svg>

            <div class="flex flex-col">
                <p class="text-sm">{{ address.address }}</p>
                <p class="text-sm">{{ address.city + ', ' + address.region + ', ' + address.zipcode }}</p>
            </div>
        </div>
        <div class="inline-flex mt-2">
            <div class="w-6 h-6"></div>
            <button type="button" class="pl-1 py-1 border underline"
                    @click="router.get(route('profile.address.index', address.id!))">Редактировать
            </button>
            <button type="button" class="pl-4 py-1 border underline"
                    @click="router.delete(route('profile.address.destroy',address.id!))">
                Удалить
            </button>
        </div>


    </div>
</template>

<style scoped>

</style>
