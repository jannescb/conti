<template>
    <div class="h-full py-4 sections-wrapper">
        <slot />
    </div>
</template>
<script setup lang="ts">
defineProps({
    sections: {
        type: Array,
        default: [],
    },
});
</script>

<style>
.sections-wrapper {
    min-height: 80px;
}
</style>
