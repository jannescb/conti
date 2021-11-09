<template>
    <div class="h-full sections-wrapper">
        <div class="w-full my-4" v-if="sections.length < 1"></div>
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
