<script setup lang="ts">
import {PropType, reactive, shallowReactive} from "vue";
import NavLayout from "@/Layouts/NavLayout.vue";
import {Link} from "@inertiajs/vue3";
import {Fade, Img, VueFlux} from 'vue-flux';
import AuthData = App.Data.AuthData;

const props = defineProps({
    auth: Object as PropType<AuthData>,
})
const options = reactive({
    allowFullscreen: false,
    allowToSkipTransition: false,
    autoplay: true,
    bindKeys: false,
    delay: 5000,
    enableGestures: false,
    infinite: true,
});

const rscs = shallowReactive([
    new Img('https://www.granit.by/upload/resize_cache/iblock/514/1920_580_101a9461d51526113595f057e89280f5a/sl_main_02.jpg', 'img 1'),
    new Img('https://www.granit.by/upload/resize_cache/iblock/abb/1920_580_101a9461d51526113595f057e89280f5a/sl_main_03.jpg', 'img 2'),
    new Img('https://www.granit.by/upload/resize_cache/iblock/3e3/1920_580_101a9461d51526113595f057e89280f5a/sl_main_01.jpg', 'img 3'),
    new Img('https://www.granit.by/upload/resize_cache/iblock/662/1920_580_101a9461d51526113595f057e89280f5a/bg_slider_2.jpg', 'img 4'),
    new Img('https://www.granit.by/upload/resize_cache/iblock/dcb/1920_580_101a9461d51526113595f057e89280f5a/bg_slider_3.jpg', 'img 5'),
    new Img('https://www.granit.by/upload/resize_cache/iblock/259/ima1mi7x5dfn1zujb5pd3axonzcv054l/1920_580_101a9461d51526113595f057e89280f5a/Banner_foto_.png', 'img 5'),
]);

const transitions = shallowReactive([
    Fade,
]);

</script>

<template>
    <NavLayout title="Главная" :auth="auth" :is-main="true">
        <!--Карусель-->
        <VueFlux
            :options="options"
            :rscs="rscs"
            :transitions="transitions"
            style="height: 580px"
        ></VueFlux>

        <!--Контент-->
        <div class="px-16 max-w-7xl xl:mx-auto">

            <!--Информация-->
            <div class="w-full mt-16">
                <img src="/img/about-us-2-bg.png" alt="bg" class="absolute z-[1]"/>
                <div class="z-[2] relative flex flex-col space-y-[17rem] w-full py-4 px-16">
                    <div class="block max-w-[54rem]">
                        <div class="font-bold text-[2.4rem] mb-4">Производим щебень фракций от 5 до 70 мм</div>
                        <div class="mb-4">Выпуск щебня различных фракций сориентирован на обеспечение
                            строительной отрасли Республики Беларусь высокопрочным материалом — щебнем из плотных горных
                            пород. Структуры щебня устойчивы против всех видов распадов. Прочность щебня по дробимости
                            характеризуется маркой 1400, по истираемости — И-1, морозостойкость — 300
                        </div>
                        <Link :href="route('catalog.index')"
                              class="uppercase bg-red-600 text-white px-6 py-2 inline-block
                              hover:bg-red-700 font-semibold tracking-wide rounded-sm">каталог продукции
                        </Link>
                    </div>
                    <div class="block max-w-[36rem] text-white">
                        <div class="font-bold text-[2.4rem] mb-4">Суровые условия — высокие показатели</div>
                        <div class="mb-4">Судьба каждого жителя г. Микашевичи так или иначе
                            связана<br> с предприятием. «Гранит» — это не только карьер и производственная
                            база, это коллектив рабочих, объединенных общим делом
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </NavLayout>
</template>

<style scoped>
</style>
