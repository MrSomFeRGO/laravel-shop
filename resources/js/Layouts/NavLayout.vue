<script setup lang="ts">
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-nocheck
import {Head, Link} from "@inertiajs/vue3";
import {PropType} from "vue";
import FloatAlert from "@/Components/FloatAlert.vue";
import {ModalsContainer} from "vue-final-modal";
import AuthData = App.Data.AuthData;

const props = defineProps({
    title: String,
    auth: Object as PropType<AuthData>,
    isMain: Boolean | undefined,
})
</script>

<template>
    <div style="min-width: 1080px; min-height: 100vh;" :class="{'bg-gray-100': isMain == undefined}">
        <Head :title="title"></Head>
        <FloatAlert v-if="$page?.props.flash?.status" :status="$page?.props.flash?.status"/>

        <nav>
            <div class="w-full bg-white shadow-md py-2 z-50 relative">
                <div class="flex justify-between h-12m mx-auto max-w-7xl items-center px-4">
                    <Link
                        :href="route('home.index')"
                        class="text-2xl font-semibold text-white"
                    >
                        <img src="/img/logo.png" alt="" class="h-16">
                    </Link>
                    <div class="space-x-8">
                        <Link :href="route('home.index')"
                              class="text-2xl font-semibold text-base">
                            Главная
                        </Link>
                        <Link :href="route('catalog.index')"
                              class="text-2xl font-semibold text-base">
                            Каталог
                        </Link>
                        <Link :href="route('information.index')"
                              class="text-2xl font-semibold text-base">
                            Покупателям
                        </Link>
                        <Link :href="route('about.index')"
                              class="text-2xl font-semibold text-base">
                            О предприятии
                        </Link>
                        <Link :href="route('contacts.index')"
                              class="text-2xl font-semibold text-base">
                            Контакты
                        </Link>
                    </div>
                    <div class="space-x-4 inline-flex items-center">

                        <Link v-if="auth?.canEditOrders"
                              :href="route('edit.orders.index')"
                              class="text-2xl font-semibold text-base">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </svg>

                        </Link>
                        <Link :href="route('cart.index')"
                              class="text-2xl font-semibold text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                            </svg>
                        </Link>
                        <Link :href="route('login.index')"
                              v-if="!props.auth"
                              class="text-2xl font-semibold text-base bg-red-600 text-white p-2.5 rounded-sm">
                            Авторизация
                        </Link>
                        <Link :href="route('profile.index')"
                              v-if="props.auth"
                              class="text-2xl font-semibold text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>

                        </Link>
                        <Link :href="route('logout')"
                              v-if="props.auth"
                              class="text-2xl font-semibold text-base bg-red-600 text-white p-2.5 rounded-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
                            </svg>

                        </Link>
                    </div>

                </div>
            </div>
        </nav>
        <main :class="{'max-w-7xl xl:mx-auto': isMain == undefined}" class="min-h-[52rem]">
            <slot/>
        </main>
        <footer class="pt-16">
            <div class="max-w-7xl mx-auto flex justify-center space-x-8">
                <a class="border-2 px-6 py-2 flex space-x-4 items-center max-w-[340px]" href="https://president.gov.by/"
                   target="_blank">
                    <img alt="."
                         src="https://www.granit.by/bitrix/templates/html_dev/images/tmp/foot-additional-01.png">
                    <span class="hover:text-red-500 hover:underline">Портал президента Республики Беларусь</span>
                </a>
                <a class="border-2 px-6 py-2 flex space-x-4 items-center max-w-[340px]" href="http://mas.gov.by/"
                   target="_blank">
                    <img alt="."
                         src="https://www.granit.by/bitrix/templates/html_dev/images/tmp/foot-additional-02.png">
                    <span class="hover:text-red-500 hover:underline">Министерство архитектуры и строительства Республики Беларусь</span>
                </a>
                <a class="border-2 px-6 py-2 flex space-x-4 items-center max-w-[340px]"
                   href="https://www.government.by/ru/"
                   target="_blank">
                    <img alt="."
                         src="https://www.granit.by/bitrix/templates/html_dev/images/tmp/foot-additional-03.png">
                    <span class="hover:text-red-500 hover:underline">Правительство Республики Беларусь</span>
                </a>
            </div>
            <div class="bg-gray-200 mt-8">
                <div class="max-w-7xl mx-auto flex py-4 justify-between">
                    <p class="max-w-[340px]">© 2024, РУПП «Гранит», 225687, Брестская область, Лунинецкий район, г.
                        Микашевичи</p>
                    <a class="flex items-center space-x-2" href="tel:+375164743562">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                        <span class="hover:text-red-500 hover:underline">+375 (1647) 43-56-2</span>
                    </a>
                    <a class="flex items-center space-x-2" href="tel:+375164743586">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                        <span class="hover:text-red-500 hover:underline">+375 (1647) 43-58-6</span>
                    </a>
                    <a class="flex items-center space-x-2" href="https://vk.com/ruppgranit">
                        <svg height="24px" viewBox="0 0 48 48" width="24px" xmlns="http://www.w3.org/2000/svg">
                            <path d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5 V37z"
                                  fill="#000"/>
                            <path d="M35.937,18.041c0.046-0.151,0.068-0.291,0.062-0.416C35.984,17.263,35.735,17,35.149,17h-2.618 c-0.661,0-0.966,0.4-1.144,0.801c0,0-1.632,3.359-3.513,5.574c-0.61,0.641-0.92,0.625-1.25,0.625C26.447,24,26,23.786,26,23.199 v-5.185C26,17.32,25.827,17,25.268,17h-4.649C20.212,17,20,17.32,20,17.641c0,0.667,0.898,0.827,1,2.696v3.623 C21,24.84,20.847,25,20.517,25c-0.89,0-2.642-3-3.815-6.932C16.448,17.294,16.194,17,15.533,17h-2.643 C12.127,17,12,17.374,12,17.774c0,0.721,0.6,4.619,3.875,9.101C18.25,30.125,21.379,32,24.149,32c1.678,0,1.85-0.427,1.85-1.094 v-2.972C26,27.133,26.183,27,26.717,27c0.381,0,1.158,0.25,2.658,2c1.73,2.018,2.044,3,3.036,3h2.618 c0.608,0,0.957-0.255,0.971-0.75c0.003-0.126-0.015-0.267-0.056-0.424c-0.194-0.576-1.084-1.984-2.194-3.326 c-0.615-0.743-1.222-1.479-1.501-1.879C32.062,25.36,31.991,25.176,32,25c0.009-0.185,0.105-0.361,0.249-0.607 C32.223,24.393,35.607,19.642,35.937,18.041z"
                                  fill="#fff"/>
                        </svg>
                        <span class="hover:text-red-500 hover:underline">Группа ВК</span>
                    </a>
                    <a class="flex items-center space-x-2" href="https://www.facebook.com/ruppgranit/">
                        <svg height="24" viewBox="0 0 50 50" width="24" x="0px" xmlns="http://www.w3.org/2000/svg"
                             y="0px">
                            <path
                                d="M41,4H9C6.24,4,4,6.24,4,9v32c0,2.76,2.24,5,5,5h32c2.76,0,5-2.24,5-5V9C46,6.24,43.76,4,41,4z M37,19h-2c-2.14,0-3,0.5-3,2 v3h5l-1,5h-4v15h-5V29h-4v-5h4v-3c0-4,2-7,6-7c2.9,0,4,1,4,1V19z"></path>
                        </svg>
                        <span class="hover:text-red-500 hover:underline">Facebook</span>
                    </a>
                    <a class="flex items-center space-x-2" href="https://www.instagram.com/ruppgranit">
                        <svg height="24" viewBox="0 0 50 50" width="24" x="0px" xmlns="http://www.w3.org/2000/svg"
                             y="0px">
                            <path
                                d="M 16 3 C 8.83 3 3 8.83 3 16 L 3 34 C 3 41.17 8.83 47 16 47 L 34 47 C 41.17 47 47 41.17 47 34 L 47 16 C 47 8.83 41.17 3 34 3 L 16 3 z M 37 11 C 38.1 11 39 11.9 39 13 C 39 14.1 38.1 15 37 15 C 35.9 15 35 14.1 35 13 C 35 11.9 35.9 11 37 11 z M 25 14 C 31.07 14 36 18.93 36 25 C 36 31.07 31.07 36 25 36 C 18.93 36 14 31.07 14 25 C 14 18.93 18.93 14 25 14 z M 25 16 C 20.04 16 16 20.04 16 25 C 16 29.96 20.04 34 25 34 C 29.96 34 34 29.96 34 25 C 34 20.04 29.96 16 25 16 z"></path>
                        </svg>
                        <span class="hover:text-red-500 hover:underline">Instagram</span>
                    </a>

                </div>
            </div>
        </footer>
        <ModalsContainer/>
    </div>
</template>

<style scoped>

</style>
