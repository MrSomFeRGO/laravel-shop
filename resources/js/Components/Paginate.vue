<script setup lang="ts">
import {onMounted, PropType, ref} from "vue";
import {Link} from "@inertiajs/vue3";
import PaginateLinksData = App.Data.PaginateLinksData;

const props = defineProps({
    links: Array as PropType<PaginateLinksData[]>,
    current_page: Number,
    quarry_params: String,
})
const linksRef = ref<PaginateLinksData[]>([]);
const quarryParams = props.quarry_params == undefined ? '' : props.quarry_params;
onMounted(() => {

    if (props.links!.length <= 5) {
        linksRef.value = props.links!;
        linksRef.value[0] = {
            url: linksRef.value[0].url,
            label: '<<<',
            active: false,
        };
        linksRef.value[linksRef.value.length - 1] = {
            url: linksRef.value[linksRef.value.length - 1].url,
            label: '>>>',
            active: false,
        };
        return;
    }
    linksRef.value.push(props.links![0])
    for (let i = 1; i <= props.links!.length - 2; i++) {
        if (props.current_page == 1) {
            linksRef.value.push(props.links![1])
            linksRef.value.push(props.links![2])
            linksRef.value.push(props.links![3])
            linksRef.value.push({
                url: null,
                label: '...',
                active: false,
            })
            break
        } else if (props.current_page == props.links!.length - 2) {
            linksRef.value.push({
                url: null,
                label: '...',
                active: false,
            })
            linksRef.value.push(props.links![props.links!.length - 4])
            linksRef.value.push(props.links![props.links!.length - 3])
            linksRef.value.push(props.links![props.links!.length - 2])
            break
        } else {
            if (i == (props.current_page! - 1)) {
                if ((i - 2) > -1) {
                    linksRef.value.push({
                        url: null,
                        label: '...',
                        active: false,
                    })
                }
                linksRef.value.push(props.links![i])
            } else if (i == (props.current_page!)) {
                linksRef.value.push(props.links![i])
            } else if (i == (props.current_page! + 1)) {
                linksRef.value.push(props.links![i])
                if (i < props.links!.length - 2) {
                    linksRef.value.push({
                        url: null,
                        label: '...',
                        active: false,
                    })
                }
            }
        }
    }
    linksRef.value.push(props.links![props.links!.length - 1])

    linksRef.value[0] = {
        url: linksRef.value[0].url,
        label: '<<<',
        active: false,
    };
    linksRef.value[linksRef.value.length - 1] = {
        url: linksRef.value[linksRef.value.length - 1].url,
        label: '>>>',
        active: false,
    };
})
</script>

<template>
    <div class="flex flex-row justify-center">
        <Link v-for="link in linksRef" :href="link.url ? link.url + quarryParams : ''">
            <div class="text-xl rounded-sm py-2 px-5 mx-2 border-2"
                 :class="{'border-0':link.active,'text-black': !link.active ,'text-white': link.active ,'bg-red-500': link.active}">
                {{ link.label }}
            </div>
        </Link>
    </div>
</template>

<style scoped>

</style>
