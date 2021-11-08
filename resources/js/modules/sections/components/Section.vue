<template>
    <div class="px-4 py-1 rounded bg-gray-50">
        <span class="text-xs text-primary">
            {{ element.key }}
        </span>
        <div v-for="attribute in element.attributes">
            <input :type="attribute.type" v-model="attribute.value" />
        </div>
        <template v-if="element.sections">
            <Sections v-model="element.sections" :group="element.uuid" />
            <Pool :pool="element.pool" :group="element.uuid" />
        </template>
    </div>
</template>
<script setup lang="ts">
import Pool from './Pool.vue';
import Sections from './Sections.vue';

const props = defineProps({
    element: {
        type: Object,
        required: true,
    },
});
</script>
