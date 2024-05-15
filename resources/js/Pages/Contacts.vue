<script setup lang="ts">
import {PropType} from "vue";
import NavLayout from "@/Layouts/NavLayout.vue";
import {Link} from "@inertiajs/vue3";
import AuthData = App.Data.AuthData;

const props = defineProps({
    auth: Object as PropType<AuthData>,
})
</script>

<template>
    <NavLayout title="Контакты" :auth="auth">
        <div class="bg-white px-16 shadow-md pb-16">

            <!--Крошки-->
            <p class="text-gray-400 pt-8">
                <Link :href="route('home.index')">Главная</Link>
                /
                <Link :href="route('about.index')" class="text-black">Контакты</Link>
            </p>

            <!--Описание-->
            <p class="pt-4 font-bold text-4xl">Контакты</p>

            <!--Карта-->
            <iframe class="mt-4 rounded-sm"
                    src="https://yandex.ru/map-widget/v1/?um=constructor%3A98fcba0d0f29abdbfe8f3c2151459c146498b9e861ed2f42b4a0cbd2d3938e99&amp;source=constructor"
                    width="100%" height="500"></iframe>

            <p class="mt-4 text-2xl font-bold">РУПП «Гранит»</p>

            <p class="mt-4 text-xl font-bold">Контактная информация:</p>
            <p class="mt-2 font-bold">Адрес:</p>
            <p class="mt-1">225687, г. Микашевичи, Лунинецкий район, Брестская область</p>

            <p class="mt-4 text-xl font-bold">GLN <span class="text-red-500">4814589900004</span></p>
            <p class="mt-4 text-xl font-bold">EDI-провайдер: <span class="text-red-500">ООО "Современные технологии торговли"</span>
            </p>

            <p class="mt-4 text-xl font-semibold">Общий отдел:</p>
            <p class="mt-1 font-semibold">Тел: +375 (1647) 43-56-2</p>

            <p class="mt-4 text-xl font-bold">Банковские реквизиты:</p>
            <p class="mt-4 font-bold">ОАО «Белагропромбанк»</p>
            <div class="ml-12">
                <p class="mt-2">р/сч: BY80BAPB30122808000210000000</p>
                <p class="mt-1">ЦБУ 118 в г. Лунинце Региональной дирекции по Брестской области</p>
                <p class="mt-1">225644 г. Лунинец, ул. Советская, 7.</p>
                <p class="mt-1">БИК: BAPBBY2X</p>
            </div>
            <p class="mt-4 font-bold">ОАО «АСБ Беларусбанк»</p>
            <div class="ml-12">
                <p class="mt-2">р/сч: BY45AKBB30120001920581200000</p>
                <p class="mt-1">ОАО «АСБ Беларусбанк»ЦБУ №119 в г.Лунинце</p>
                <p class="mt-1">225644, Брестская область, г. Лунинец, ул. Гагарина, 31.</p>
                <p class="mt-1">BIC SWIFT – AKBBBY2X</p>
                <p class="mt-1">УНП банка - 100325912</p>
            </div>

            <p class="mt-4 text-xl font-bold">Режим работы</p>
            <p class="mt-2">Вторник – пятница: 10.00 - 16.00 и с 13.00 до 16.00.</p>
            <p class="mt-1">Обеденный перерыв: 12.00 - 13.00.</p>
            <p class="mt-1">Суббота: 12.30 - 18.00.</p>
            <p class="mt-1">Выходные дни: воскресенье, понедельник и праздничные дни</p>
            <p class="mt-1 font-semibold">Телефоны:</p>
            <p class="mt-1">+375 (1647) 43-647, +375 (44) 78-31-428 (А1).</p>

            <p class="mt-4 text-xl font-bold">Отдел маркетинга и договорной работы:</p>
            <p class="mt-2">По вопросам заключения договоров на поставку готовой продукции обращайтесь напрямую в отдел
                маркетинга и договорной работы (ОМиД).</p>
        </div>
    </NavLayout>
</template>

<style scoped>

</style>
