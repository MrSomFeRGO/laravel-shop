<script setup lang="ts">
import {PropType} from "vue";
import {OptionValue} from "@/types/main";

const model = defineModel<Number>({required: true});

const props = defineProps({
    options: Array as PropType<OptionValue[]>,
    label: String,
    formId: String,
})
</script>

<template>
    <div>
        <label :for="formId" class="block mb-2 text-md font-semibold text-black uppercase">{{ label }}</label>
        <select :id="formId" class="h-12 border border-gray-300 text-gray-900 text-sm rounded-sm block w-full p-2.5"
                v-model="model">

            <option v-for="option in options" :value="option.id">{{ option.name }}</option>
        </select>
    </div>
</template>

<style scoped>

</style>
