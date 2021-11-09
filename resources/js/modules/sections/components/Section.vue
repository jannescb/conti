<template>
    <SectionWrapper>
        <div class="flex justify-between">
            <SectionTitle>
                {{ section.key }}
            </SectionTitle>
            <div>
                <button @click="prepareForDeletion(section)">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="-3 -2 24 24"
                        width="24"
                        fill="currentColor"
                    >
                        <path
                            d="M12 2h5a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h5V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1zm3.8 6l-.613 9.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.205 8H15.8zM7 9a1 1 0 0 0-1 1v7a1 1 0 0 0 2 0v-7a1 1 0 0 0-1-1zm4 0a1 1 0 0 0-1 1v7a1 1 0 0 0 2 0v-7a1 1 0 0 0-1-1z"
                        ></path>
                    </svg>
                </button>
            </div>
        </div>
        <div v-for="attribute in section.attributes">
            <Attribute :attribute="attribute" v-model="attribute.value" />
        </div>
        <template v-if="section.sections">
            <Sections v-model="section.sections" :group="section.uuid" />
            <Pool :pool="section.pool" :group="section.uuid" />
        </template>
    </SectionWrapper>
</template>
<script setup lang="ts">
import { PropType } from 'vue';
import Pool from './Pool.vue';
import SectionWrapper from './SectionWrapper.vue';
import SectionTitle from './SectionTitle.vue';
import Sections from './Sections.vue';
import Attribute from './Attribute.vue';
import { Section as SectionInterface, prepareForDeletion } from '../index';

defineProps({
    section: {
        type: Object as PropType<SectionInterface>,
        required: true,
    },
});
</script>
