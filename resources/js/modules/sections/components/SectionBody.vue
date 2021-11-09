<template>
    <div class="pb-8 pl-8">
        <AttributeWrapper>
            <Attribute
                v-for="attribute in section.attributes"
                :attribute="attribute"
                v-model="attribute.value"
            />
        </AttributeWrapper>
        <template v-if="section.sections">
            <SectionsWrapper :sections="section.sections">
                <Sections v-model="section.sections" :group="section.uuid" />
            </SectionsWrapper>
            <Pool :pool="section.pool" :group="section.uuid" actions />
        </template>
    </div>
</template>
<script setup lang="ts">
import { PropType } from 'vue';
import {
    SectionInterface,
    Pool,
    Sections,
    Attribute,
    AttributeWrapper,
    SectionsWrapper,
} from './../index';

defineProps({
    section: {
        type: Object as PropType<SectionInterface>,
        required: true,
    },
});
</script>
