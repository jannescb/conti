<template>
    <draggable
        v-if="sections"
        v-model="sections"
        :group="group"
        itemKey="uuid"
        tag="transition-group"
        :component-data="{
            name: !drag ? 'flip-list' : null,
        }"
        @start="drag = true"
        @end="drag = false"
        v-bind="dragOptions"
    >
        <template #item="{ element }">
            <Section :section="element" class="list-group-item" />
        </template>
    </draggable>
</template>
<script setup lang="ts">
import { ref, watch, PropType, useAttrs } from 'vue';
import draggable from 'vuedraggable';
import Section from './Section.vue';
import { SectionInterface } from './../index';

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
const emit = defineEmits(['update:modelValue']);

const drag = ref(false);
const dragOptions = ref({
    animation: 200,
    ghostClass: 'ghost',
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

<style>
.flip-list-move {
    transition: transform 0.5s;
}
.no-move {
    transition: transform 0s;
}
.ghost {
    opacity: 0.5;
    background: #c8ebfb;
}
</style>
