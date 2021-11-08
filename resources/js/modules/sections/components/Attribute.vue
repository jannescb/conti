<template>
    <div>
        <label for="">Label</label>
        <input :type="type" />
    </div>
</template>
<script setup lang="ts">
defineProps({
    type: {
        type: String,
        default: 'text',
    },
    name: {
        type: String,
        required: true,
    },
});
</script>
