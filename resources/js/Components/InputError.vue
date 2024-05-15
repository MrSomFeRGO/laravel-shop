<script lang="ts" setup>
defineProps<{
    message?: string;
    showIcon?: boolean;
}>();
</script>

<template>
    <div v-show="message" class="pt-2 inline-flex space-x-1 items-center">
        <svg v-show="showIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                              class="text-red-500 w-8 grow-0 shrink-0">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/>
        </svg>

         <p class="text-md text-red-500">
            {{ message }}
        </p>
    </div>
</template>
