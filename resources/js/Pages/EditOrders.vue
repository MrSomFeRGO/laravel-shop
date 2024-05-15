<script lang="ts" setup>
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-nocheck
import {onMounted, PropType, ref} from "vue";
import NavLayout from "@/Layouts/NavLayout.vue";
import {Link, router, useForm} from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AuthData = App.Data.AuthData;
import OrderData = App.Data.OrderData;

const props = defineProps({
    auth: Object as PropType<AuthData>,
    orders: Array as PropType<OrderData[]>,
})

const selected = ref("Все статусы")
const selectedArr = ref([])
const docForm = useForm({
    'doc': null,
})

onMounted(() => {
    for (let i = 0; i < props.orders?.length; i++) {
        selectedArr.value[i] = props.orders[i].status;
    }
})

function submitDoc() {
    docForm.post(route('edit.orders.upload'))
}

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

function updateStatus(id: Number, newStatus: String) {
    console.log(id, newStatus)
    router.post(route('edit.orders.store'), {
        id: id,
        newStatus: newStatus
    })
}
</script>

<template>
    <NavLayout :auth="auth" title="Редактирование заказов">
        <div class="bg-white px-16 min-h-screen shadow-md">
            <!--Крошки-->
            <p class="text-gray-400 pt-8">
                <Link :href="route('home.index')">Главная</Link>
                /
                <Link :href="route('edit.orders.index')" class="text-black">Редактирование заказов</Link>
            </p>
            <!--Описание-->
            <p class="pt-4 font-bold text-4xl">Редактирование и подтверждение заказов</p>
            <!--Фильтры-->
            <div class="flex flex-row border-t-2 pt-4 mt-4 space-x-4 ">
                <div class="w-[30rem]">
                    <label class="block mb-2 text-md font-semibold text-black uppercase" for="status">Статус
                        заказа</label>
                    <select id="status"
                            v-model="selected"
                            class="h-12 border border-gray-300 text-gray-900 text-sm rounded-sm block w-full p-2.5">

                        <option v-for="option in orders[0].allStatuses[0]" :value="option">{{ option }}</option>
                    </select>
                </div>
                <SecondaryButton class="mt-auto h-12" style="min-width: 11rem" @click="selected = 'Все статусы'">
                    <svg aria-hidden="true" class="w-6 h-6" stroke="currentColor" stroke-width="1.5"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" d="M6 18 18 6M6 6l12 12" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    Убрать фильтр
                </SecondaryButton>
            </div>

            <div v-for="(order, i) in orders" v-show="order.status == selected || selected == 'Все статусы'"
                 class="border-2 rounded-sm pb-4 my-8">
                <table class="w-full text-sm text-left">
                    <tbody>
                    <tr v-for="orderItem in order.order_items">
                        <th class="px-6 py-4 font-medium " scope="row">
                            <div class="inline-flex space-x-4">
                                <img
                                    :src="orderItem.product?.productImages![0]?.imageUrl ?? 'https://imgholder.ru/600x600/8493a8/fff&text=NOT+FOUND'"
                                    alt=""
                                    class="w-32 rounded-sm">
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
                            {{ splitNumber(orderItem.product.price) + ' р.' }}
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
                        <p v-if="order.payment_method == 'Онлайн по реквизитам'">
                            {{ 'р/сч ' + order.current_account }}</p>
                        <p v-if="order.payment_method == 'Онлайн по реквизитам'">
                            {{ 'Адрес банка ' + order.bank_address }}</p>
                        <p v-if="order.payment_method == 'Онлайн по реквизитам'">{{ 'БИК  ' + order.bik }}</p>
                        <p v-if="order.payment_method == 'Онлайн по реквизитам'">{{ 'УНП  ' + order.unp }}</p>
                        <p v-if="order.payment_method == 'Онлайн по реквизитам'">{{ 'ОКПО  ' + order.okpo }}</p>
                    </div>
                    <div class="flex space-x-8 text-right">
                        <div class="flex flex-col">
                            <span class="text-gray-400">Способ оплаты</span>
                            <span class="text-gray-400 h-[48px] leading-[48px]">Статус заказа</span>
                            <span class="text-gray-400">Итого</span>
                            <span v-if="order.payment_method == 'Онлайн по реквизитам'"
                                  class="text-gray-400 h-[48px] leading-[48px]">Прикрепить документ</span>
                        </div>
                        <div class="flex flex-col">
                            <p class="font-semibold">{{ order.payment_method }}</p>
                            <select id="status"
                                    v-model="selectedArr[i]"
                                    class="h-12 border border-gray-300 text-gray-900 text-sm rounded-sm block w-[16rem] p-2.5"
                                    @change="updateStatus(order.id, selectedArr[i])">

                                <option v-for="option in order.allStatuses[0].slice(1, order.allStatuses[0].length)"
                                        :value="option">{{ option }}
                                </option>
                            </select>
                            <p class="font-semibold">{{ splitNumber(order.total_price) + ' р.' }}</p>
                            <div v-if="order.payment_method == 'Онлайн по реквизитам'" class="relative w-full">
                                <button
                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 w-full inline-flex items-center">
                                    <svg fill="#FFF" height="18" viewBox="0 0 24 24" width="18"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
                                    </svg>
                                    <span class="ml-2">Загрузить документ</span><input
                                    class="cursor-pointer absolute block py-2 px-4 w-full opacity-0 pin-r pin-t"
                                    type="file"
                                    @change="docForm.post(route('edit.orders.upload', order.id))"
                                    @input="docForm.doc = $event.target.files[0]"/>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </NavLayout>
</template>

<style scoped>

</style>
