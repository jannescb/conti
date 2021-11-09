<template>
    <div class="h-full py-4 sections-wrapper" :class="[cols]">
        <slot />
    </div>
</template>
<script setup lang="ts">
import { computed } from 'vue';
const props = defineProps({
    section: {
        type: Object,
        default: null,
    },
});
const cols = computed(() => {
    if (props.section?.cols) {
        return `grid gap-4 grid-cols-${props.section.cols}`;
    }
});
</script>

<style>
.sections-wrapper {
    min-height: 80px;
}
</style>
