<template>
    <div class="pb-8 pl-8">
        <AttributeWrapper>
            <Attribute
                v-for="attribute in section.attributes"
                :attribute="attribute"
                v-model="attribute.value"
            />
        </AttributeWrapper>
        <div v-if="section.sections" class="pt-4">
            <SectionsWrapper :section="section">
                <Sections
                    v-model="section.sections"
                    :group="section.uuid"
                    :footer="section.footer"
                    :pool="section.pool"
                />
            </SectionsWrapper>
            <Pool
                :pool="section.pool"
                :group="section.uuid"
                v-if="!section.footer"
            />
        </div>
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
