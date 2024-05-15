<script setup lang="ts">

import NavLayout from "@/Layouts/NavLayout.vue";
import {Link, router, usePage} from "@inertiajs/vue3";
import SelectInput from "@/Components/SelectInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ProductCard from "@/Components/ProductCard.vue";
import {PropType, ref} from "vue";
import Paginate from "@/Components/Paginate.vue";
import PaginateProductData = App.Data.PaginateProductData;
import StandardData = App.Data.StandardData;
import DeliveryRegionData = App.Data.DeliveryRegionData;
import AuthData = App.Data.AuthData;

const props = defineProps({
    products: Object as PropType<PaginateProductData>,
    standards: Array as PropType<StandardData[]>,
    delivery_regions: Array as PropType<DeliveryRegionData[]>,
    auth: Object as PropType<AuthData>,
})

const selectDelivery = ref(getSelectValue(true))
const selectStandard = ref(getSelectValue(false))

function getQuarryParams() {
    if (usePage().url.indexOf('?') == -1) {
        return ''
    }
    let params = ''
    usePage().url.split('?')[1].split('&').forEach(val => {
        if (val.indexOf('page') == -1) {
            params += '&' + val
        }
    })
    return params
}

function getSelectValue(is_delivery: Boolean) {
    if (usePage().url.indexOf('?') == -1) {
        return 1
    }
    let num = 1
    usePage().url.split('?')[1].split('&').forEach(val => {
        if (val.indexOf(is_delivery ? 'delivery' : 'standard') >= 0) {
            num = Number(val.split('=')[1])
        }
    })
    return num
}

function applyFilter() {
    router.get(route(route().current()!, {
        delivery: selectDelivery.value,
        standard: selectStandard.value,
    }))
}

function removeFilter() {
    router.get(route(route().current()!))
}

</script>

<template>
    <NavLayout title="Каталог" :auth="auth">
        <div class="bg-white px-16 shadow-md">
            <!--Крошки-->
            <p class="text-gray-400 pt-8">
                <Link :href="route('home.index')">Главная</Link>
                /
                <Link :href="route('catalog.index')" class="text-black">Каталог</Link>
            </p>

            <!--Описание-->
            <p class="pt-4 font-bold text-4xl">Нерудные материалы</p>
            <p class="pt-4">Выпуск друзу розных фракцый зарыентаваны на забеспячэнне будаўнічай галіны Рэспублікі
                Беларусь
                высокатрывалым матэрыялам – друзам са шчыльных горных парод. Структуры друзу ўстойлівыя супраць усіх
                відаў распадаў. Трываласць друзу па драбімасці характарызуецца маркай 1400, 1600, па сціральнасці - И-1,
                марозаўстойлівасць - 300.</p>

            <!--Фильтры-->
            <div class="flex flex-row border-t-2 pt-4 mt-4 space-x-4 ">
                <SelectInput v-model="selectDelivery" :options="delivery_regions" label="Регион поставки"
                             form-id="regions"
                             class="w-full"></SelectInput>
                <SelectInput v-model="selectStandard" :options="standards" label="Стандарт"
                             form-id="standards"
                             class="w-full"></SelectInput>
                <PrimaryButton class="mt-auto h-12" style="min-width: 16rem" @click="applyFilter">Применить фильтры
                </PrimaryButton>
                <SecondaryButton class="mt-auto h-12" style="min-width: 11rem" @click="removeFilter">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" clip-rule="evenodd" stroke-linejoin="round"
                              d="M6 18 18 6M6 6l12 12"/>
                    </svg>
                    Убрать фильтр
                </SecondaryButton>
            </div>

            <!--Каталог-->
            <div class="grid grid-cols-4 gap-8 mt-4">
                <ProductCard v-for="product in products?.data" :product="product"></ProductCard>
            </div>

            <div class="h-8"></div>

            <!--Пагинация-->
            <Paginate v-if="(products?.links.length || 0) > 3" :current_page="products?.current_page"
                      :links="products?.links"
                      :quarry_params="getQuarryParams()" class="pb-8"></Paginate>
        </div>
    </NavLayout>
</template>

<style scoped>

</style>
