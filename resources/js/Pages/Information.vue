<script setup lang="ts" xmlns="http://www.w3.org/1999/html">
import {PropType, ref} from "vue";
import NavLayout from "@/Layouts/NavLayout.vue";
import {Link} from "@inertiajs/vue3";
import {DocFile} from "@/types/main";
import AuthData = App.Data.AuthData;

const props = defineProps({
    auth: Object as PropType<AuthData>,
})

// 0 => Сертификаты
// 1 => Декларации
// 2 => Торговый объект
// 3 => Договор
const selectedCategory = ref(0);
const certificates: DocFile[] = [
    {
        title: 'АКТ ЭКСПЕРТИЗЫ БелТПП',
        url: 'https://www.granit.by/upload/iblock/600/nm6uuqi6eorgnnpkucvgux165padtvlv/Akt-ekspertizy-BelTPP.pdf'
    },
    {
        title: 'СЕРТИФИКАТ продукции собственного производства БТПП',
        url: 'https://www.granit.by/upload/iblock/848/thkg297twug3jc2wdytfgx0zywgwgvtc/Sertifikat-sobstvennogo-proizvodstva-BelTPP.pdf'
    },
    {
        title: 'BY 112 02.01. ТР013 052.01 00084 Щебень из пл. горных пород ГОСТ 8267-93',
        url: 'https://www.granit.by/upload/iblock/589/3d8b58p1gejwwioimslpbrx5fzq18zj2/BY-112-02.01.-TR013-052.01-00084-SHCHeben-10_15_-15_20_-40_70_-70_120-GOST-8267_93.pdf'
    },
    {
        title: 'BY 112 02.01. ТР013 120.01 00329 Кубовидный щебень 5-10 2сорт СТБ 1311-2002',
        url: 'https://www.granit.by/upload/iblock/0b1/xvcaexat6bf1abaapv3ipsfsdohs1dv2/BY-112-02.01.-TR013-120.01-00329-Kubovidnyy-shcheben-5_10-2sort-STB-1311_2002.pdf'
    },
    {
        title: 'BY 112 02.01. ТР013 120.01 00330 Щебень 5-10, 10-20, 5-20, 20-40, 40-70 ГОСТ 8267-93',
        url: 'https://www.granit.by/upload/iblock/d3e/2me1i879a2xatchepw02ie5660dtmouk/BY-112-02.01.-TR013-120.01-00330-SHCHeben-5_10_-10_20_-5_20_-20_40_-40_70-GOST-8267_93.pdf'
    },
    {
        title: 'BY 112 02.01. ТР013 120.01 00331 Щебень 5-10, 10-20, 5-20, 20-40, 40-70 ГОСТ 8267-93',
        url: 'https://www.granit.by/upload/iblock/53b/03fnykeqk0hoj19w1xe1iax5osh0bye5/BY-112-02.01.-TR013-120.01-00331-SHCHeben-5_10_-10_20_-5_20_-20_40_-40_70-GOST-8267_93.pdf'
    },
    {
        title: 'BY 112 03.12.120.01 00009 Заполнители 4-8, 4-16, 8-16, 16-22, 16-32 СТБ EN 12620',
        url: 'https://www.granit.by/upload/iblock/d22/31uiru98poijuy2022wihl56qbs34brt/BY-112-03.12.120.01-00009-Zapolniteli-4_8_-4_16_-8_16_-16_22_-16_32-STB-EN-12620.pdf'
    },
    {
        title: 'BY 112 03.12.120.01 00010 Крупный заполнитель 2-4 FL35 новый по категориям',
        url: 'https://www.granit.by/upload/iblock/0b6/oo5c44dzgmw9in1d2v1yedidxlsl5or7/BY-112-03.12.120.01-00010-Krupnyy-zapolnitel-2_4-FL35-novyy-po-kategoriyam.pdf'
    },
    {
        title: 'BY 112 03.12.052.01 00009 ЩПС С5, С6, СТБ 2318-2013',
        url: 'https://www.granit.by/upload/iblock/059/xiagftlttkghgjywg3rg46y6z2t0lq75/VU112-03.12.-052.01-00016-SHCHPS-S5_-S6-STB-2318_2013.pdf'
    },
    {
        title: 'ЕАЭС BY/112 02.01. ТР003 064.01 00165 Щебень из плотных горных пород для балластного слоя железtiодорожного пути фракции 25-60 мм II категории ГОСТ 7392-2014',
        url: 'https://www.granit.by/upload/iblock/552/rcfgqt4ubqdb6r3uver9zq3eep9lpzke/EAES-BY-112-02.01.-TP003-064.01-00165-SHCHeben-25_60-II-kategorii.pdf'
    },
    {
        title: 'ТУ BY 200161 167.003-2010 Отсев из материалов дробления горных пород',
        url: 'https://www.granit.by/upload/iblock/739/TU-BY-200161-167.003_2010-Otsev-iz-materialov-drobleniya-gornykh-porod.pdf'
    },
    {
        title: 'ТУ BY 200161167.004-2013 Отсев фракционированный из материалов дробления горных пород',
        url: 'https://www.granit.by/upload/iblock/9a1/t8bwlamqafmvbk3rekb56nniskvm1exi/TU-BY-202161167_004_2013.pdf'
    },
    {
        title: 'ТУ BY 200161 167.005-2015 Породы скальные переработанные',
        url: 'https://www.granit.by/upload/iblock/668/TU-BY-200161-167.005_2015-Porody-skalnye-pererabotannye.pdf'
    }
];
const declarations: DocFile[] = [
    {
        title: 'Щебень из горных пород для дорожного строительства фракций 16-22,4 мм Л10 Марки 85/20 и 16-31,5 мм Л15 Марки 85/15',
        url: 'https://www.granit.by/upload/iblock/667/_-BY-112-11.01._014-052_01-00064-_-_-_-_-16_22_4_-_10_-_-85_20_-16_31_5_-_15_-_-85_15..pdf'
    },
    {
        title: 'Щебень из плотных горных пород для строительных работ фракций: 5-10мм 1 гр; 5-20мм 2 гр, 10-20мм 1 гр, 20-40мм 2 гр, 40-70мм 2 гр',
        url: 'https://www.granit.by/upload/iblock/dd5/_-BY-112-11-01.-_014-052.01-00055-_-_-_-_-_.pdf'
    },
    {
        title: 'Щебень из плотных горных пород для балластного слоя железнодорожного пути фракции 25-60 мм II категории',
        url: 'https://www.granit.by/upload/iblock/759/BY_112_11.01.TP003_064.01_00077-25_60.pdf'
    },
    {
        title: 'Щебень из плотных горных пород фракций: 8-11,2мм Л10 Марки 85/20, 4-8 мм Л10 Марки 85/20',
        url: 'https://www.granit.by/upload/iblock/c23/_-BY-112-11.01.TP014-052.01-00061-_-_-_-_-_-4_8_-8_11_-_-85_20.pdf'
    },
    {
        title: 'Щебень из плотных горных пород для балластного слоя железнодорожного пути фракции 31,5/63 мм FL15, 31,5/50 мм FL15',
        url: 'https://www.granit.by/upload/iblock/07a/_-_BY-112-11.01-_003-064.01-00005-_-_-_-_-_.pdf'
    },
    {
        title: 'Щебень из гранитов и диоритов для дорожного строительства фракций 4/16мм, 8/16мм',
        url: 'https://www.granit.by/upload/iblock/d91/_-_BY-112-11.01-_014-052-00400-_-_-_-_.pdf'
    },
    {
        title: 'Щебень из гранитов и диоритов для дорожного строительства фракций 16/31,5мм, 31,5/63мм',
        url: 'https://www.granit.by/upload/iblock/e56/_-_BY-112-11.01-_014-052-00401-_-_-_-_.pdf'
    },
    {
        title: 'Щебень из горных пород фракций 4-16мм Л25; 8-16мм Л25',
        url: 'https://www.granit.by/upload/iblock/dec/_-_BY-112-11.01-_014-052-00518-_-_-_-_.pdf'
    },
    {
        title: 'Щебень из горных пород фракций 40-70мм 4 группы, 10-20мм 3группы, 5-20мм 3группы',
        url: 'https://www.granit.by/upload/iblock/523/_-_BY-112-11.01-_014-052-00519-_-_-_-_.pdf'
    },
    {
        title: 'Щебень из горных пород фракций 4-8мм Л10; 4-8мм Л25; 4-16мм Л30; 8-11,2мм Л10',
        url: 'https://www.granit.by/upload/iblock/1b1/_-_BY-112-11.01-_014-052-00530-_-_-_-_.pdf'
    },
    {
        title: 'Щебень из плотных горных пород фракций: 5-10мм 3 гр., 5- 20мм 1 гр., 10-15мм 1 гр., 5-20мм 4 гр., 20-40мм 3 гр., 40-70мм 3 гр.',
        url: 'https://www.granit.by/upload/iblock/4d6/_-_BY-112-11.01-_014-052-00531-_-_-_.-_-_.pdf'
    },
    {
        title: 'Щебень кубовидный из плотных горных пород фракции 5-10мм II сорта',
        url: 'https://www.granit.by/upload/iblock/178/_-_BY-112-11.01-_014-052-00532-_-_.pdf'
    },
    {
        title: 'Щебень из горных пород фракции 16-22,4мм',
        url: 'https://www.granit.by/upload/iblock/bc6/_-_BY-112-11.01-_014-094-00007-_-_-_-_.pdf'
    },
    {
        title: 'Крупный заполнитель (щебень) для бетона фракций: 2/4мм FL35; 4/8мм FL15 и FL35; 4/16мм FL15 и FL35; 8/16мм FL15 и FLзs; 16/22мм FL15; 16/32мм FL15',
        url: 'https://www.granit.by/upload/iblock/f0c/_-_BY-112-11.01.-_014-052.01-00046-_-_-_-_.pdf'
    }
];

</script>

<template>
    <NavLayout title="Покупателям" :auth="auth">
        <div class="bg-white px-16 shadow-md pb-16">

            <!--Крошки-->
            <p class="text-gray-400 pt-8">
                <Link :href="route('home.index')">Главная</Link>
                /
                <Link :href="route('about.index')" class="text-black">О предприятии</Link>
            </p>

            <!--Описание-->
            <p class="pt-4 font-bold text-4xl">Покупателям</p>

            <!--Переключение категорий-->
            <div class="flex mt-4 space-x-4 pb-4 border-b-2">
                <button class="py-4 rounded-l-sm text-xl font-semibold w-full border-2"
                        @click="selectedCategory = 0"
                        :class="{'text-white bg-red-600 border-red-600': selectedCategory == 0,
                        'border-gray-300': selectedCategory != 0}">
                    Сертификаты
                </button>
                <button class="py-4 text-xl font-semibold w-full border-2"
                        @click="selectedCategory = 1"
                        :class="{'text-white bg-red-600 border-red-600': selectedCategory == 1,
                        'border-gray-300': selectedCategory != 1}">
                    Декларации
                </button>
                <button class="py-4 text-xl font-semibold w-full border-2"
                        @click="selectedCategory = 2"
                        :class="{'text-white bg-red-600 border-red-600': selectedCategory == 2,
                        'border-gray-300': selectedCategory != 2}">
                    Торговый объект
                </button>
                <button :class="{'text-white bg-red-600 border-red-600': selectedCategory == 3,
                        'border-gray-300': selectedCategory != 3}"
                        class="py-4 text-xl font-semibold w-full border-2"
                        @click="selectedCategory = 3">
                    Договор
                </button>
            </div>

            <!--Сертификаты-->
            <div class="mt-4 grid grid-cols-3 gap-4" v-show="selectedCategory == 0">
                <a :href="docFile.url" class="p-2 flex items-center" target="_blank" v-for="docFile in certificates">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="min-w-16 min-h-16 max-w-16 max-h-16 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                    </svg>
                    <div class="block">
                        <p class="font-semibold">{{ docFile.title }}</p>
                    </div>
                </a>
            </div>

            <!--Декларации-->
            <div class="mt-4 grid grid-cols-3 gap-4" v-show="selectedCategory == 1">
                <a :href="docFile.url" class="p-2 flex items-center" target="_blank" v-for="docFile in declarations">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="min-w-16 min-h-16 max-w-16 max-h-16 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                    </svg>
                    <div class="block">
                        <p class="font-semibold">{{ docFile.title }}</p>
                    </div>
                </a>
            </div>

            <!--Торговый объект-->
            <div class="mt-4" v-show="selectedCategory == 2">
                <p class="text-red-500 text-center text-2xl font-bold">УВАЖАЕМЫЙ ПОКУПАТЕЛЬ!</p>
                <p class="mt-4 text-center text-2xl font-bold">ИНФОРМАЦИЯ ПО ОТПУСКУ ПРОДУКЦИИ ПО ОБРАЗЦАМ В ТОРГОВОМ
                    ОБЪЕКТЕ
                    РУПП «ГРАНИТ»</p>
                <p class="mt-8 text-center text-4xl font-bold">телефон для справок: <span class="text-red-500">+375 1647 43635</span>
                </p>
                <p class="mt-8 text-center text-2xl font-bold">Для приобретения щебня через торговый объект по образцам
                    физическим лицам необходимо предоставлять решение органов государственного управления о выделении
                    земельного участка под застройку.</p>

                <p class="mt-4 text-xl font-semibold">С отпускными ценами на нерудные строительные материалы, песок
                    вскрышной производства РУПП «Гранит» Вы можете ознакомиться в прейскурантах:</p>
                <ul class="list-disc">
                    <li class="ml-4 text-sky-500 underline hover:no-underline font-semibold"><a
                        href="https://granit.by/upload/iblock/d99/gag2rt37ht566f0i40co47n5srwqvfil/107.pdf"
                        target="_blank">ПРЕЙСКУРАНТ №107 отпускных цен на товары, продукцию собственного производства
                        для торговли по образцам</a></li>
                </ul>

                <img class="mt-8" src="/img/schedule.jpg" alt="Расписание"/>
                <p class="text-center text-red-500 mt-4">Просим учесть, что запуск автомобильного транспорта <br> на
                    территорию предприятия для погрузки
                    продукции осуществляется <br> <span class="font-bold text-2xl">до 18<sup>00</sup>ч.</span></p>
                <p class="text-center mt-4">C 02.11.2020 автотранспорт, следующий под погрузку готовой продукции РУПП
                    «Гранит» без наличия
                    приспособлений (тента) для укрытия груза, загружаться не будет, согласно пункту 69 <a
                        class="text-sky-500 underline hover:no-underline"
                        href="https://etalonline.by/document/?regnum=C20800970">Правил
                        автомобильных перевозок грузов,</a> утвержденных Постановлением Совета Министров Республики
                    Беларусь №
                    970 от 30.06.2008.</p>

                <p class="text-center mt-4">В рамках действующего договора просим оформлять <a
                    class="text-sky-500 underline hover:no-underline"
                    href="https://drive.google.com/file/d/1JoSmAa1VwnlATjrQq-ca_HMMo5QA5fgp/view">доверенность согласно
                    типовой форме.</a></p>
            </div>

            <!--Договор-->
            <div v-show="selectedCategory == 3" class="mt-4 grid grid-cols-3 gap-4">
                <a class="p-2 flex items-center" href="/doc/contract_rb.doc" target="_blank">
                    <svg class="min-w-16 min-h-16 max-w-16 max-h-16 text-red-600" fill="none" stroke="currentColor" stroke-width="1.5"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    <div class="block">
                        <p class="font-semibold">Договор на поставку нерудных строительных материалов</p>
                    </div>
                </a>
            </div>
        </div>
    </NavLayout>
</template>

<style scoped>

</style>
