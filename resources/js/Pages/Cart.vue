<script setup lang="ts">
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-nocheck
import NavLayout from "@/Layouts/NavLayout.vue";
import {Link, router} from "@inertiajs/vue3";
import NumInputWithButton from "@/Components/NumInputWithButton.vue";
import {PropType, ref} from "vue";
import AuthData = App.Data.AuthData;
import CartData = App.Data.CartData;

const props = defineProps({
    auth: Object as PropType<AuthData>,
    cart_items: Array as PropType<CartData[]>,
})

const selectedItems = ref([]);
const isAllSelected = ref(false);
const totalPrice = ref(0)

function splitNumber(num: Number) {
    let str = num.toFixed(2).toString().split('.');
    if (str[0].length >= 4) {
        str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1 ');
    }
    if (str[1] && str[1].length >= 5) {
        str[1] = str[1].replace(/(\d{3})/g, '$1 ');
    }
    return str.join(',');
}

function countTotalPrice() {
    totalPrice.value = 0;
    props.cart_items?.map(function (value) {
        selectedItems.value.map(function (value2) {
            if (value2 == value.id) {
                totalPrice.value += value.product.price * value.quantity
            }
        })
    })
}
</script>

<template>
    <NavLayout title="Корзина" :auth="auth">
        <div class="bg-white px-16 min-h-screen shadow-md">
            <!--Крошки-->
            <p class="text-gray-400 pt-8">
                <Link :href="route('home.index')">Главная</Link>
                /
                <Link :href="route('cart.index')" class="text-black">Корзина</Link>
            </p>

            <!--Описание-->
            <p class="pt-4 font-bold text-4xl">Корзина товаров</p>

            <!--Таблица корзины-->
            <table class="w-full text-sm text-left rtl:text-right text-gray-900 mt-4" v-if="cart_items?.length > 0">
                <thead class="text-xs uppercase border-t-2 border-b-2">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Наиминование товара
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Количество
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Цена за всё
                    </th>
                    <th scope="col" class="px-6" v-if="auth">
                        <input v-model="isAllSelected" type="checkbox" @click="selectedItems.length > 0 ? selectedItems.length = 0 : cart_items?.forEach(function(value) {
                            selectedItems.push(value.id)
                        })" @change="countTotalPrice()">
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="border-b-2" v-for="cartItem in cart_items">

                    <th scope="row" class="px-6 py-4 font-medium ">
                        <div class="inline-flex space-x-4">
                            <img
                                :src="cartItem.product?.productImages![0]?.imageUrl ?? 'https://imgholder.ru/600x600/8493a8/fff&text=NOT+FOUND'"
                                alt="" class="w-32 rounded-sm">
                            <div class="">
                                <p>{{ cartItem.product.title }}</p>
                                <p class="text-gray-500 text-sm mt-2">Регион поставки: <span class="text-gray-900">{{
                                        cartItem.product.deliveryRegions.map(region => region.name).join(', ')
                                    }}</span>
                                </p>

                                <p class="text-gray-500 text-sm mt-2">Стандарт: <span
                                    class="text-gray-900">{{ cartItem.product.standard.name }}</span></p>
                            </div>
                        </div>
                    </th>
                    <td class="px-6 py-4 w-1/5">
                        <div class="text-center">
                            <NumInputWithButton v-model="cartItem.quantity" show-remove-btn
                                                @remove="router.delete(route('cart.destroy', cartItem.id), {preserveScroll: true})"
                                                @update:model-value="countTotalPrice(); router.put(route('cart.update',cartItem.id), {quantity: Number(cartItem.quantity)},{preserveScroll: true})"></NumInputWithButton>
                            <p class="text-gray-500 pt-2">
                                {{ splitNumber(cartItem.product.price) + ' ' + cartItem.product.priceUnits }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4 w-1/6">
                        {{ splitNumber(cartItem.product.price * cartItem.quantity) + ' р.' }}
                    </td>
                    <td class="px-6" v-if="auth">
                        <input type="checkbox" :value="cartItem.id" v-model="selectedItems"
                               @change="!isAllSelected ? isAllSelected = true : isAllSelected = selectedItems.length != 0; countTotalPrice()">
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="px-6 py-4 border-b-2 flex justify-between items-center" v-if="cart_items?.length > 0 && auth">
                <p>Оформите заказ</p>
                <div class="flex items-center space-x-6">
                    <p>К оплате: {{ splitNumber(totalPrice) + ' р.' }}</p>
                    <Link :class="{'bg-red-500': selectedItems.length != 0, 'bg-gray-500':selectedItems.length == 0}"
                          :disabled="selectedItems.length == 0"
                          :href="route('checkout.index', {
                              cartIds: selectedItems.toString().replaceAll(',','-'),
                              totalPrice: totalPrice})"
                          as="button"
                          class="p-2 font-semibold rounded-sm text-white"
                          type="button">
                        {{ selectedItems.length == 0 ? 'Выберите хотя бы один товар' : 'К оформлению' }}
                    </Link>
                </div>
            </div>
            <div v-if="cart_items?.length == 0 || !cart_items" class="flex flex-col items-center mt-32">
                <p class="text-center font-semibold text-xl">Корзина пуста</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-16 h-16 mt-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z"/>
                </svg>

            </div>
            <p v-if="cart_items?.length > 0 && !auth" class="mt-4 text-center font-semibold text-xl">Для оформления
                заказа требуется авторизироваться</p>
            <div class="py-8"></div>


        </div>
    </NavLayout>
</template>

<style scoped>

</style>
