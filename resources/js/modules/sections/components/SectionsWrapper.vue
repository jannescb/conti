<template>
    <div
        class="h-full sections-wrapper"
        :class="{
            'border border-gray-300 border-dashed rounded': sections.length < 1,
        }"
    >
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
