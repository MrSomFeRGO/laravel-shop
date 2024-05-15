<script setup>
import {onMounted, onUpdated} from 'vue';
const props = defineProps({
    status: Object
});

function showSwal() {
    Swal.fire(
        {
            toast: !0,
            position: "top-end",
            showConfirmButton: !1,
            timer: 3e3,
            icon: props.status.icon,
            text: props.status.text,
        }
    )
}

onMounted(() => {
    if (props.status) {
        showSwal()
    }
})

onUpdated(() => {
    if (props.status) {
        showSwal()
    }
})
</script>
<template></template>
