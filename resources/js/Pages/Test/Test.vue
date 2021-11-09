<template>
    <div class="container flex justify-end pb-6">
        <button
            class="px-4 py-1 text-xs text-white rounded bg-green"
            :class="{
                'bg-opacity-25 pointer-events-none': !form.isDirty,
            }"
            @click="submit()"
        >
            Submit
        </button>
    </div>
    <div class="container grid grid-cols-4 gap-6">
        <Sections
            v-model="form.content.sections"
            class="col-span-3"
            v-if="form.content.sections"
        />
        <Pool :pool="pool" class="col-span-1" />
        <DeleteSection :sections="form.content.sections" />
    </div>
</template>
<script setup lang="ts">
import { PropType } from 'vue';
import {
    Sections,
    Pool,
    Section,
    Page,
    defineContent,
    defineAttribute,
} from '@/modules/sections';
import { useForm } from '@inertiajs/inertia-vue3';
import DeleteSection from '@/modules/sections/components/DeleteSection.vue';

const props = defineProps({
    page: {
        type: Object as PropType<Page>,
        default: null,
    },
    options: {
        type: Object as PropType<any>,
        default: null,
    },
});

const pool: Section[] = [
    {
        key: 'Hero',
        attributes: [
            defineAttribute({
                key: 'Title',
                type: 'text',
                value: 'foo',
            }),
            defineAttribute({
                key: 'Pages',
                type: 'select',
                value: null,
                options: 'pages',
                placeholder: 'Seite auswählen',
            }),
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

const form = useForm<Page>({
    name: 'Home',
    route: 'home',
    content: defineContent(props.page, {
        sections: [],
    }),
});

const submit = () => {
    if (!form.isDirty) {
        return;
    }
    form.post('/pages');
};
</script>
