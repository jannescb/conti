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
    </div>
    <div class="container mt-5">
        <!-- <pre>{{ page.content }}</pre> -->
        <pre>{{ form }}</pre>
    </div>
</template>
<script setup lang="ts">
import { onMounted } from 'vue';
import { Sections, Pool, Section } from '@/modules/sections';
import { useForm } from '@inertiajs/inertia-vue3';

interface Page {
    name: string;
    route: string;
    content: any;
}

const props = defineProps({
    page: {
        type: Object,
        default: null,
    },
});

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

const content = props.page ? { ...props.page.content } : { sections: [] };

const form = useForm<Page>({
    name: 'Home',
    route: 'home',
    content,
});

const submit = () => {
    if (!form.isDirty) {
        return;
    }
    form.post('/pages');
};
</script>
