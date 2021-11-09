<template>
    <draggable
        v-if="sections"
        v-model="sections"
        :group="group"
        itemKey="uuid"
        class="p-2 space-y-2 bg-white border border-gray-100 border-dashed rounded "
        :class="{
            'h-24': sections.length < 1,
        }"
    >
        <template #item="{ element }">
            <Section :section="element" />
        </template>
    </draggable>
</template>
<script setup lang="ts">
import { ref, watch, PropType } from 'vue';
import draggable from 'vuedraggable';
import Section from './Section.vue';
import { Section as SectionInterface } from './../index';

const emit = defineEmits(['update:modelValue']);

const props = defineProps({
    modelValue: {
        type: Array as PropType<SectionInterface[]>,
        required: true,
    },
    group: {
        type: String,
        default: 'sections',
    },
});

const sections = ref<SectionInterface[]>(props.modelValue);

watch(
    () => sections,
    (state, prevState) => {
        emit('update:modelValue', sections.value);
    },
    { deep: true }
);
</script>
