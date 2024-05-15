<script setup lang="ts">
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-nocheck
import {onMounted, ref} from 'vue';

const model = defineModel<string>({required: true});

const input = ref<HTMLInputElement | null>(null);

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});
const emit = defineEmits(['remove']);
const props = defineProps({
    showRemoveBtn: Boolean,
})
defineExpose({focus: () => input.value?.focus()});
</script>

<template>
    <div class="flex" :class="{'max-w-[180px]': showRemoveBtn, 'max-w-[9rem]': !showRemoveBtn}">
        <button
            @click="$emit('update:modelValue',  modelValue = (Number(modelValue) - 1) < 1 ? '1' : String(Number(modelValue) - 1))"
            type="button" class="rounded-l-lg p-3 h-11 border-2 border-gray-300">
            <svg class="w-3 h-3 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 18 2">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 1h16"/>
            </svg>
        </button>
        <input type="text" v-model="model"
               @input="$emit('update:modelValue', $event.target.value.replace(/[^0-9.]/g, ''))" :maxlength="4"
               class="text-center w-full border-x-0 border-y-2 border-gray-300 focus:border-gray-300 focus:outline-0 focus:ring-0 focus:outline-none"
               required/>
        <button
            @click="$emit('update:modelValue',  modelValue = (Number(modelValue) + 1) > 9999 ? '9999' : String(Number(modelValue) + 1))"
            type="button" class="rounded-r-lg p-3 h-11 border-2 border-gray-300">
            <svg class="w-3 h-3 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 1v16M1 9h16"/>
            </svg>
        </button>
        <button class="p-2 text-gray-500" v-if="showRemoveBtn" type="button" @click="emit('remove')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
            </svg>

        </button>
    </div>
</template>

<style scoped>

</style>
