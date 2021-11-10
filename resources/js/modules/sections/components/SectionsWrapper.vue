<template>
    <div class="grid gap-4 py-4 sections-wrapper">
        <slot />
    </div>
</template>
<script setup lang="ts">
defineProps({
    section: {
        type: Object,
        default: null,
    },
});
</script>

<style>
.sections-wrapper {
    min-height: 80px;
}
</style>
