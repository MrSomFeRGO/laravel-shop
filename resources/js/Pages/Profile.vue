<script setup lang="ts">
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-nocheck
import NavLayout from "@/Layouts/NavLayout.vue";
import {PropType, ref} from "vue";
import {Link, router} from "@inertiajs/vue3";
import AddressCard from "@/Components/AddressCard.vue";
import {VueFinalModal} from "vue-final-modal";
import AuthData = App.Data.AuthData;
import UserAddressData = App.Data.UserAddressData;
import OrderData = App.Data.OrderData;

const props = defineProps({
    auth: Object as PropType<AuthData>,
    user_addresses: Array as PropType<UserAddressData[]>,
    orders: Array as PropType<OrderData[]>,
})

// 1 -> Заказы
// 2 -> Адресса доставкич
const selectedMenu = ref(1)

const options = ref({
    teleportTo: 'body',
    modelValue: false,
    displayDirective: 'if',
    hideOverlay: false,
    overlayTransition: 'vfm-fade',
    contentTransition: 'vfm-fade',
    clickToClose: true,
    escToClose: true,
    background: 'non-interactive',
    lockScroll: true,
    reserveScrollBarGap: true,
    swipeToClose: 'none',
});

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
</script>

<template>
    <NavLayout title="Профиль" :auth="auth">
        <div class="bg-white px-16 min-h-screen shadow-md">
            <!--Крошки-->
            <p class="text-gray-400 pt-8">
                <Link :href="route('home.index')">Главная</Link>
                /
                <Link :href="route('profile.index')" class="text-black">Профиль</Link>
            </p>
            <!--Описание-->
            <p class="pt-4 font-bold text-4xl">Профиль пользователя</p>
            <!--Информация пользователя-->
            <div class=" mt-4 flex flex-col w-full">
                <p class=" pt-2 font-semibold text-gray-700 ">Почта</p>
                <p class="text-xl ">{{ auth!.email }}</p>
                <div class="inline-flex space-x-4 border-t-2 mt-2 pt-2">
                    <button type="button" class="p-2 text-2xl rounded-sm"
                            :class="{'bg-red-500': selectedMenu == 1, 'text-white': selectedMenu == 1, 'bg-gray-200': selectedMenu != 1}"
                            @click="selectedMenu = 1">
                        Заказы
                    </button>
                    <button type="button" class="p-2 text-2xl rounded-sm"
                            :class="{'bg-red-500': selectedMenu == 2, 'text-white': selectedMenu == 2, 'bg-gray-200': selectedMenu != 2}"
                            @click="selectedMenu = 2">
                        Адреса доставки
                    </button>
                </div>
            </div>
            <!--Заказы-->
            <div class="mt-8 w-full pb-16" v-if="selectedMenu == 1">

                <p class="font-bold text-2xl mb-2">Ваши заказы</p>
                <div class="border-2 rounded-sm pb-4 mb-8" v-for="order in orders">
                    <table class="w-full text-sm text-left">
                        <tbody>
                        <tr v-for="orderItem in order.order_items">
                            <th scope="row" class="px-6 py-4 font-medium ">
                                <div class="inline-flex space-x-4">
                                    <img
                                        :src="orderItem.product?.productImages![0]?.imageUrl ?? 'https://imgholder.ru/600x600/8493a8/fff&text=NOT+FOUND'"
                                        class="w-32 rounded-sm"
                                        alt="">
                                    <div class="">
                                        <p>{{ orderItem.product.title }}</p>
                                        <p class="text-gray-500 text-sm mt-2">Регион поставки: <span
                                            class="text-gray-900">
                                            {{
                                                orderItem.product.deliveryRegions.map(region => region.name).join(', ')
                                            }}
                                        </span>
                                        </p>

                                        <p class="text-gray-500 text-sm mt-2">Стандарт: <span
                                            class="text-gray-900">{{ orderItem.product.standard.name }}</span></p>
                                    </div>
                                </div>
                            </th>
                            <td class="px-6 py-4 w-1/6 font-semibold text-right text-gray-400">
                                {{ orderItem.quantity + ' т.' }}
                            </td>
                            <td class="px-6 py-4 w-1/6 font-semibold text-right">
                                {{ splitNumber(orderItem.product.price) + ' ' + orderItem.product.priceUnits }}
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <div class=" pt-4 border-t mx-6 flex justify-between">
                        <div class="flex flex-col">
                            <p class="font-semibold">Адрес доставки</p>
                            <p>{{
                                    order.address.country + ', ' + order.address.region + ', ' + order.address.city
                                    + ', ' + order.address.address
                                }}
                            </p>
                            <p class="font-semibold mt-2">Получатель</p>
                            <p>{{ order.address.fio }}</p>
                            <p>{{ order.address.phone_number }}</p>
                        </div>
                        <div class="flex space-x-8 text-right">
                            <div class="flex flex-col">
                                <span class="text-gray-400">Способ оплаты</span>
                                <span class="text-gray-400">Статус заказа</span>
                                <span class="text-gray-400">Итого</span>
                            </div>
                            <div class="flex flex-col">
                                <p class="font-semibold">{{ order.payment_method }}</p>
                                <p class="font-semibold">{{ order.status }}</p>
                                <p class="font-semibold">{{ splitNumber(order.total_price) + ' р.' }}</p>
                                <p v-if="order.payment_method == 'Онлайн по реквизитам'"
                                   class="font-semibold underline text-blue-500 cursor-pointer"
                                   @click="options.modelValue = true">Реквизиты для оплаты</p>
                                <a v-if="order.payment_method == 'Онлайн по реквизитам' && order.doc_url != null"
                                   :href="order.doc_url"
                                   class="font-semibold underline text-blue-500 cursor-pointer">Документ</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div v-if="!orders[0] && selectedMenu == 1" class="flex flex-col items-center mt-32">
                <p class="text-center font-semibold text-xl">Похоже у вас нет заказов</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-16 h-16 mt-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z"/>
                </svg>

            </div>


            <!--Адреса доставки-->
            <div class="flex justify-between mt-8 items-end" v-if="selectedMenu == 2">

                <p class="font-bold text-2xl">Адреса доставки</p>
                <button type="button" class="p-2 font-semibold rounded-sm bg-red-500 text-white"
                        @click="router.get(route('profile.address.index'))">
                    Добавить адрес
                </button>
            </div>
            <div v-if="!user_addresses[0] && selectedMenu == 2" class="flex flex-col items-center mt-32">
                <p class="text-center font-semibold text-xl">Похоже у вас нет адресов доставки</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-16 h-16 mt-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z"/>
                </svg>

            </div>
            <div class="grid grid-cols-2 gap-4 mt-4" v-if="selectedMenu == 2">
                <AddressCard :user_addresses="user_addresses" :selected_menu="selectedMenu"></AddressCard>
            </div>

            <VueFinalModal
                v-model="options.modelValue"
                :background="options.background"
                :click-to-close="options.clickToClose"
                :content-transition="options.contentTransition"
                :display-directive="options.displayDirective"
                :esc-to-close="options.escToClose"
                :hide-overlay="options.hideOverlay"
                :lock-scroll="options.lockScroll"
                :overlay-transition="options.overlayTransition"
                :reserve-scroll-bar-gap="options.reserveScrollBarGap"
                :swipe-to-close="options.swipeToClose"
                :teleport-to="options.teleportTo"
                class="flex justify-center items-center"
                content-class="max-w-5xl mx-4 p-4 bg-white rounded-sm space-y-4 flex flex-col"
            >
                <h1 class="text-xl text-center font-semibold">
                    Реквизиты для оплаты
                </h1>
                <p>Республика Беларусь, 225687 г. Микашевичи</p>
                <p>Лунинецкого р-на, Брестской обл.,</p>
                <p>р/сч BY80BAPB30122808000210000000</p>
                <p>ЦБУ 118 в г.Лунинец Региональная дирекция</p>
                <p>по Брестской области ОАО «Белагропромбанк»</p>
                <p>БИК: BAPBBY2X</p>
                <p>УНП 200161167, ОКПО 002950601000</p>
                <p>Е-mail: info@granit.by</p>
                <p>Маркетинг: 43-398, 43-462, 43-222</p>
                <p>Е-mail: contract@granit.by</p>
                <p>Сбыт: 43-241, 43-571, 43-591, 43-560</p>
                <p>Е-mail: otgr_blr@granit.by</p>
                <p>Бухгалтерия: 43-593, 43-389</p>
                <p>Финансовый: 43-225</p>
            </VueFinalModal>

        </div>
    </NavLayout>
</template>

<style scoped>

</style>
