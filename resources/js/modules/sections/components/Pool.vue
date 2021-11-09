<template>
    <draggable
        v-model="pool"
        :group="{
            name: group,
            pull: 'clone',
            put: false,
        }"
        :sort="false"
        :clone="cloneSection"
    >
        <template #item="{ element }">
            <SectionWrapper>
                <SectionHeader :section="element" :actions="actions" />
            </SectionWrapper>
        </template>
    </draggable>
</template>
<script setup lang="ts">
import { PropType } from 'vue';
import draggable from 'vuedraggable';
import { v4 } from 'uuid';
import {
    SectionInterface,
    SectionWrapper,
    SectionHeader,
    cloneSection,
} from './../index';

defineProps({
    pool: {
        type: Array as PropType<SectionInterface[]>,
        required: true,
    },
    group: {
        type: String,
        default: 'sections',
    },
    actions: {
        type: Boolean,
        default: false,
    },
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
    background: #c8ebfb;
}
.list-group {
    min-height: 20px;
}
.list-group-item {
    cursor: move;
}
.list-group-item i {
    cursor: pointer;
}
</style>
