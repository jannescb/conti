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
