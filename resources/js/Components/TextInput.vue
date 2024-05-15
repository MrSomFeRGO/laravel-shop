<script setup lang="ts">
import {onMounted, ref} from 'vue';

const model = defineModel<string>({ required: true });

const input = ref<HTMLInputElement | null>(null);

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <input
        class="h-12 border border-gray-300 text-gray-900 text-sm rounded-sm block w-full p-2.5"
        v-model="model"
        ref="input"
    />
</template>

