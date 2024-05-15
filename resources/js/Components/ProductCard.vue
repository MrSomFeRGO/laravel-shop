<script setup lang="ts">
import {Link, router} from "@inertiajs/vue3";
import {PropType} from "vue";
import ProductData = App.Data.ProductData;

const props = defineProps({
    product: Object as PropType<ProductData>,

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
</script>

<template>
    <Link class="w-full bg-gray-200 shadow-md rounded-sm p-2.5 flex flex-col justify-between"
          :href="route('catalog.product.index', product?.slug)">
        <div>
            <img :src="product?.productImages![0]?.imageUrl ?? 'https://imgholder.ru/600x600/8493a8/fff&text=NOT+FOUND'"
                 alt="" class="rounded-sm mx-auto">
            <p class="focus:bg-gray-500 text-sm mt-2">{{ product!.standard.name }}</p>
            <p class="font-semibold leading-5 border-t border-black mt-2 pt-2">{{ product!.title }}</p>
        </div>
        <p class="mt-4 flex flex-row justify-between items-center text-center">
            {{ splitNumber(product!.price) + ' ' + product!.priceUnits }}
            <button class="inline-flex p-2 bg-red-500 rounded-sm z-50"
                    @click.prevent="router.post(route('cart.store',product!.id), {quantity: 1},{preserveScroll: true})">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                     stroke="white" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                     stroke="white" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                </svg>
            </button>
        </p>
    </Link>
</template>

<style scoped>

</style>
