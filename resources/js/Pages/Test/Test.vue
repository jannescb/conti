<template>
    <div class="grid grid-cols-4 gap-6">
        <Sections v-model="sections" class="col-span-3" />
        <Pool :pool="pool" class="col-span-1" />
    </div>
    <pre>{{ sections }}</pre>
</template>
<script setup lang="ts">
import { ref } from 'vue';
import { Sections, Pool, Section } from '@/modules/sections';

const pool: Section[] = [
    {
        key: 'Hero',
        attributes: [
            {
                key: 'Title',
                type: 'text',
                value: 'foo',
            },
            {
                key: 'Intro',
                type: 'text',
            },
        ],
    },
    {
        key: 'Cards',
        attributes: [
            {
                key: 'Title',
                type: 'text',
            },
        ],
        sections: [
            {
                key: 'Card',
                attributes: [
                    {
                        key: 'Title',
                        type: 'text',
                        value: 'foo',
                    },
                ],
            },
        ],
    },
];

const sections = ref<Section>();
</script>
