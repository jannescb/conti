<template>
    <SectionWrapper>
        <SectionHeader :section="section" :actions="true" />
        <SectionBody v-if="!section.modal" :section="section" />
    </SectionWrapper>
</template>
<script setup lang="ts">
import { PropType } from 'vue';
import {
    SectionInterface,
    SectionWrapper,
    SectionBody,
    SectionHeader,
} from './../index';

defineProps({
    section: {
        type: Object as PropType<SectionInterface>,
        required: true,
    },
});
</script>
