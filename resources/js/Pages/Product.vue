<script setup lang="ts">

import {Link, useForm} from "@inertiajs/vue3";
import NavLayout from "@/Layouts/NavLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import NumInputWithButton from "@/Components/NumInputWithButton.vue";
import {PropType} from "vue";
import ProductData = App.Data.ProductData;
import AuthData = App.Data.AuthData;

const props = defineProps({
    product: Object as PropType<ProductData>,
    auth: Object as PropType<AuthData>,
})

const addCartForm = useForm({
    quantity: '1'
})
</script>

<template>
    <NavLayout title="Каталог" :auth="auth">
        <div class="bg-white px-16 shadow-md">
            <!--Крошки-->
            <p class="text-gray-400 pt-8">
                <Link :href="route('home.index')">Главная</Link>
                /
                <Link :href="route('catalog.index')">Каталог</Link>
                /
                <Link :href="route('catalog.index')" class="text-black">Нерудные материалы</Link>
            </p>

            <div class="grid grid-cols-7 gap-4 mt-8 pb-16">
                <img
                    :src="product?.productImages![0]?.imageUrl ?? 'https://imgholder.ru/600x600/8493a8/fff&text=NOT+FOUND'"
                    alt="" class="col-span-2 rounded-sm">
                <div></div>
                <div class="flex flex-col col-span-4">
                    <p class="font-bold text-2xl">{{ product!.title }}</p>
                    <table class="mt-2">
                        <tbody class="border-t-2">
                        <tr v-if="product?.certificateUrl">
                            <td class="py-2 font-semibold text-gray-700">Сертификат соответствия</td>
                            <td>
                                <Link class="underline inline-flex space-x-2"
                                      href=""
                                      target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                                    </svg>

                                    <span>{{ product.certificateUrl }}</span>
                                </Link>

                            </td>
                        </tr>
                        <tr class="border-t-2">
                            <td class="py-2 font-semibold text-gray-700">Регион поставки</td>
                            <td>{{ product!.deliveryRegions.map(region => region.name).join(', ') }}</td>
                        </tr>
                        <tr class="border-t-2">
                            <td class="py-2 font-semibold text-gray-700">Стандарт</td>
                            <td>{{ product!.standard.name }}</td>
                        </tr>
                        <tr class="border-t-2" v-if="product?.conformityDeclaration">
                            <td class="py-2 font-semibold text-gray-700">Декларация соответствия</td>
                            <td>{{ product!.conformityDeclaration }}</td>
                        </tr>
                        <tr class="border-t-2 border-b">
                            <td class="py-2 font-semibold text-gray-700">Цена</td>
                            <td>{{ product!.price + ' ' + product!.priceUnits }}</td>
                        </tr>

                        </tbody>
                    </table>
                    <p class="my-2 font-semibold text-gray-700">Количество</p>
                    <div class="inline-flex space-x-8">
                        <NumInputWithButton v-model="addCartForm.quantity"></NumInputWithButton>
                        <PrimaryButton class="rounded-r-sm bg-red-500"
                                       @click="addCartForm.post(route('cart.store', product?.id))">Добавить в корзину
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </div>
    </NavLayout>
</template>

<style scoped>

</style>
