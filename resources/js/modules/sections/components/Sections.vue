<template>
    <draggable
        v-if="sections"
        v-model="sections"
        :group="group"
        itemKey="uuid"
        tag="transition-group"
        :component-data="{
            name: !drag ? 'flip-list' : null,
            wrap: true,
        }"
        @start="drag = true"
        @end="drag = false"
        v-bind="dragOptions"
    >
        <template #item="{ element }">
            <Section
                :section="element"
                class="list-group-item"
                :class="getSectionClass(element)"
            />
        </template>
        <template #footer v-if="children?.length > 0">
            <div class="col-span-full">
                <button
                    class="flex items-center px-6 py-2 text-sm text-black bg-white border border-black rounded-sm "
                    v-for="child in children"
                    @click="addSection(child)"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="-4.5 -4.5 24 24"
                        class="w-4 h-4 -ml-2 fill-current"
                    >
                        <path
                            d="M8.9 6.9v-5a1 1 0 1 0-2 0v5h-5a1 1 0 1 0 0 2h5v5a1 1 0 1 0 2 0v-5h5a1 1 0 1 0 0-2h-5z"
                        ></path>
                    </svg>
                    {{ child.key }}
                </button>
            </div>
        </template>
    </draggable>
</template>
<script setup lang="ts">
import { ref, watch, PropType, computed } from 'vue';
import draggable from 'vuedraggable';
import Section from './Section.vue';
import {
    SectionInterface,
    cloneSection,
    getSectionByKey,
    getSectionClass,
} from './../index';

const props = defineProps({
    modelValue: {
        type: Array as PropType<SectionInterface[]>,
        required: true,
    },
    group: {
        type: String,
        default: 'sections',
    },
    section: {
        type: Object as PropType<SectionInterface>,
        default: null,
    },
});
const emit = defineEmits(['update:modelValue']);

const drag = ref(false);
const dragOptions = ref({
    animation: 200,
    ghostClass: 'ghost',
});
const sections = ref<SectionInterface[]>(props.modelValue);

const addSection = (el: SectionInterface) => {
    sections.value.push(cloneSection(el));
};

watch(
    () => sections,
    (state, prevState) => {
        emit('update:modelValue', sections.value);
    },
    { deep: true }
);

const children = computed(() => {
    if (!props.section) {
        return;
    }
    return getSectionByKey(props.section.key)?.children;
});
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
    background: #dde0ee;
    border: none;
}
</style>
