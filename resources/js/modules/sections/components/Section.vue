<template>
    <SectionWrapper>
        <SectionHeader :section="section" :actions="true" />
        <SectionBody
            v-if="!section.modal"
            :section="section"
            class="pb-8 pl-8"
        />
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
