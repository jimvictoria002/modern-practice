<script setup>
defineProps({
    value: {
        type: String,
    },
    isRequired:{
        type: Boolean,
        default: true
    }
});
</script>

<template>
    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">
        <span v-if="value">{{ value }}</span>
        <span v-if="isRequired" class="text-red-700"> *</span>
        <span v-else><slot /></span>
    </label>
</template>
