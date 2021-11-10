<template>
    <div class="pb-8 pl-8" v-if="show">
        <AttributeWrapper :class="getSectionClass(section)">
            <Attribute
                v-for="attribute in section.attributes"
                :attribute="attribute"
                :sectionKey="section.key"
                v-model="attribute.value"
            />
        </AttributeWrapper>
        <div v-if="section.sections" class="pt-4">
            <SectionsWrapper
                :section="section"
                :class="getSectionClass(section)"
            >
                <Sections
                    v-model="section.sections"
                    :group="section.uuid"
                    :section="section"
                />
            </SectionsWrapper>
        </div>
    </div>
</template>
<script setup lang="ts">
import { PropType, computed } from 'vue';
import {
    SectionInterface,
    Sections,
    Attribute,
    AttributeWrapper,
    SectionsWrapper,
    getSectionClass,
    getSectionByKey,
} from './../index';

const props = defineProps({
    section: {
        type: Object as PropType<SectionInterface>,
        required: true,
    },
    show: {
        type: Boolean,
        default: false,
    },
});

const show = computed(() => {
    if (props.show) {
        return true;
    }
    return !getSectionByKey(props.section.key)?.modal;
});
</script>
