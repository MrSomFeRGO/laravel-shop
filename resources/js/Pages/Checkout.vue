<script setup lang="ts">
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-nocheck
import NavLayout from "@/Layouts/NavLayout.vue";
import {PropType, ref} from "vue";
import {Link, router} from "@inertiajs/vue3";
import AuthData = App.Data.AuthData;
import UserAddressData = App.Data.UserAddressData;
import CartData = App.Data.CartData;

const props = defineProps({
    auth: Object as PropType<AuthData>,
    user_addresses: Array as PropType<UserAddressData[]>,
    cart_items: Array as PropType<CartData[]>,
    total_price: Number,
})

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

const selectedAddress = ref(props.user_addresses![0] != undefined ? props.user_addresses![0].id : 0)
const selectedPayment = ref(0)
const additionalDetails = ref({
    currentAccount: '',
    bankAddress: '',
    bik: '',
    unp: '',
    okpo: '',
})
const deliveryPrice = 85;
const ndsPercent = 20;

function products() {
    let ids = []
    props.cart_items?.map((item) => {
        ids.push({
            id: item.product.id,
            quantity: item.quantity,
            totalPrice: (item.quantity * item.product.price).toFixed(2)
        })
    })
    return ids;
}

function cartIds() {
    let ids = []
    props.cart_items?.map((item) => {
        ids.push(item.id)
    })
    return ids;
}
</script>

<template>
    <NavLayout title="Оформление заказа" :auth="auth">
        <div class="bg-white px-16 shadow-md pb-16">

            <!--Крошки-->
            <p class="text-gray-400 pt-8">
                <Link :href="route('home.index')">Главная</Link>
                /
                <Link :href="route('cart.index')">Корзина</Link>
                /
                <span class="text-black">Оформление заказа</span>
            </p>

            <!--Описание-->
            <p class="pt-4 font-bold text-4xl">Оформление заказа</p>
            <div class="grid grid-cols-7 gap-16 mt-4">
                <div class="col-span-5">
                    <div class="border-t-2 pt-4 mb-4">
                        <p class="text-2xl font-semibold" v-if="user_addresses[0]">Получатель</p>
                        <div class="mt-4 flex justify-between" v-if="user_addresses[0]"
                             v-for="address in user_addresses">
                            <div>
                                <p>{{ address.fio }}, {{ address.phone_number }}</p>
                                <p>{{
                                        address.country + ', ' + address.region + ', ' + address.city
                                        + ', ' + address.address
                                    }}</p>
                            </div>
                            <input type="radio" :value="address.id" v-model="selectedAddress">
                        </div>
                        <div v-if="!user_addresses[0]" class="flex flex-col items-center">
                            <p class="text-center font-semibold text-xl">Похоже у вас нет адреса доставки</p>
                            <p class="text-center font-semibold text-xl">Вы можете добавить его в
                                <Link class="text-sky-500 underline hover:no-underline" :href="route('profile.index')">
                                    профиле
                                </Link>
                            </p>
                        </div>
                    </div>

                    <div class="border-t-2 pt-4 mb-4">
                        <p class="text-2xl font-semibold">Способ оплаты</p>
                        <div class="flex space-x-4 mt-4">
                            <div class="inline-flex items-center p-4 border-2">
                                <p>Наличными при получении</p>
                                <input class="ml-12 cursor-pointer" type="radio" value="0" v-model="selectedPayment">
                            </div>
                            <div class="inline-flex items-center p-4 border-2">
                                <p>Картой при получении</p>
                                <input class="ml-12 cursor-pointer" type="radio" value="1" v-model="selectedPayment">
                            </div>
                            <div class="inline-flex items-center p-4 border-2">
                                <p>Онлайн по реквизитам</p>
                                <input v-model="selectedPayment" class="ml-12 cursor-pointer" type="radio" value="2">
                            </div>
                        </div>
                    </div>

                    <div v-show="selectedPayment == 2" class="border-t-2 pt-4 mb-4">
                        <p class="text-2xl font-semibold">Укажите свои реквизиты</p>
                        <input v-model="additionalDetails.currentAccount" class="mt-4 w-full"
                               placeholder="Расчётный счёт" type="text"/>
                        <input v-model="additionalDetails.bankAddress" class="mt-4 w-full" placeholder="Адрес банка"
                               type="text"/>
                        <input v-model="additionalDetails.bik" class="mt-4 w-full" placeholder="БИК" type="text"/>
                        <input v-model="additionalDetails.unp" class="mt-4 w-full" placeholder="УНП" type="text"/>
                        <input v-model="additionalDetails.okpo" class="mt-4 w-full" placeholder="ОКПО" type="text"/>
                    </div>

                    <div class="border-t-2 pt-4 mb-4">
                        <p class="text-2xl font-semibold">Товары</p>
                        <div class="flex flex-col space-y-4 mt-4">
                            <div class="inline-flex space-x-4" v-for="cartItem in cart_items">
                                <img
                                    :src="cartItem.product?.productImages![0]?.imageUrl ?? 'https://imgholder.ru/600x600/8493a8/fff&text=NOT+FOUND'"
                                    class="w-32 rounded-sm"
                                    alt="">
                                <div>
                                    <p>{{ cartItem.product.title }}</p>
                                    <p class="text-gray-500 text-sm mt-2">Регион поставки: <span
                                        class="text-gray-900">{{
                                            cartItem.product.deliveryRegions.map(region => region.name).join(', ')
                                        }}</span>
                                    </p>

                                    <p class="text-gray-500 text-sm mt-2">Стандарт: <span
                                        class="text-gray-900">{{ cartItem.product.standard.name }}</span></p>
                                </div>
                                <div class="w-[8rem] font-semibold text-right text-gray-400">
                                    {{ cartItem.quantity + ' т.' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="border-t-2 pt-4 mb-4">
                        <div class="flex justify-between text-2xl font-semibold">
                            <p>Итого</p>
                            <p>{{ splitNumber(total_price + deliveryPrice + (total_price / 100 * ndsPercent)) }} р.</p>
                        </div>
                        <div class="flex justify-between text-xl mt-4">
                            <p>Товар</p>
                            <p>{{ splitNumber(total_price) }} р.</p>
                        </div>
                        <div class="flex justify-between text-xl">
                            <p>НДС {{ ndsPercent }}%</p>
                            <p>{{ splitNumber(total_price / 100 * ndsPercent) }} р.</p>
                        </div>
                        <div class="flex justify-between text-xl">
                            <p>Доставка</p>
                            <p>{{ splitNumber(deliveryPrice) }} р.</p>
                        </div>
                        <button type="button" class="mt-4 py-2 w-full font-semibold rounded-sm text-white"
                                :class="{'bg-red-500': user_addresses[0], 'bg-gray-500': !user_addresses[0]}"
                                :disabled="!user_addresses[0]"
                                @click="router.post(route('checkout.store'),{
                                addressId: selectedAddress,
                                paymentId: selectedPayment,
                                cartIds: cartIds(),
                                totalPrice: (total_price + deliveryPrice + (total_price / 100 * ndsPercent)).toFixed(2),
                                products: products(),
                                currentAccount: additionalDetails.currentAccount,
                                bankAddress: additionalDetails.bankAddress,
                                bik: additionalDetails.bik,
                                unp: additionalDetails.unp,
                                okpo: additionalDetails.okpo})">
                            Офформить заказ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </NavLayout>
</template>

<style scoped>

</style>
