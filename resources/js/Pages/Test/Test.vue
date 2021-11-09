<template>
    <div class="grid grid-cols-4">
        <div class="h-screen col-span-3 px-12 overflow-y-scroll bg-primary-50">
            <h1 class="pt-4">Home</h1>

            <Attribute
                v-model="form.content.h1"
                :attribute="{ key: 'H1', type: 'text' }"
            />
            <SectionsWrapper>
                <Sections
                    v-model="form.content.sections"
                    class="space-y-2"
                    v-if="form.content.sections"
                />
            </SectionsWrapper>
        </div>
        <div
            class="sticky top-0 flex flex-col items-end justify-between h-screen col-span-1 px-8 py-4 bg-white "
        >
            <div class="space-x-2">
                <button
                    class="px-6 py-2 text-xs text-black bg-white border border-b rounded-sm "
                    :class="{
                        'bg-opacity-25 pointer-events-none': !form.isDirty,
                    }"
                    @click="reset()"
                >
                    Reset Changes
                </button>
                <button
                    class="px-6 py-2 text-xs text-white bg-black rounded-sm"
                    :class="{
                        'bg-opacity-25 pointer-events-none': !form.isDirty,
                    }"
                    @click="submit()"
                >
                    Save Changes
                </button>
            </div>
            <div class="flex items-center flex-1 w-full">
                <Pool :pool="pool" class="w-full col-span-1 space-y-2" />
            </div>
        </div>
        <DeleteSection :sections="form.content.sections" />
    </div>
</template>
<script setup lang="ts">
import { PropType } from 'vue';
import {
    Sections,
    Pool,
    SectionInterface,
    PageInterface,
    defineContent,
    defineAttribute,
    defineSection,
    SectionsWrapper,
    Attribute,
} from '@/modules/sections';
import { useForm } from '@inertiajs/inertia-vue3';
import DeleteSection from '@/modules/sections/components/DeleteSection.vue';

const props = defineProps({
    page: {
        type: Object as PropType<PageInterface>,
        default: null,
    },
    options: {
        type: Object as PropType<any>,
        default: null,
    },
});

const HeroSection = defineSection({
    key: 'Hero',
    attributes: [
        defineAttribute({
            key: 'Title',
            type: 'text',
            value: 'foo',
            colspan: 6,
        }),
        defineAttribute({
            key: 'Pages',
            type: 'select',
            value: null,
            options: 'pages',
            placeholder: 'Seite auswählen',
            colspan: 6,
        }),
    ],
});
const CardSection = defineSection({
    key: 'Cards',
    modal: true,
    footer: true,
    cols: 2,
    attributes: [
        defineAttribute({
            key: 'Title',
            type: 'text',
        }),
    ],
    pool: [
        {
            key: 'Card',
            attributes: [
                defineAttribute({
                    key: 'Title',
                    type: 'text',
                    value: 'foo',
                }),
            ],
        },
    ],
});
const TextSection = defineSection({
    key: 'Text',
    attributes: [
        defineAttribute({
            key: 'Text',
            type: 'text',
            value: 'Standardwert',
        }),
    ],
});

const pool: SectionInterface[] = [HeroSection, CardSection, TextSection];

const form = useForm<PageInterface>({
    name: 'Home',
    route: 'home',
    content: defineContent(props.page, {
        h1: null,
        sections: [],
    }),
});

const submit = () => {
    if (!form.isDirty) {
        return;
    }
    form.post('/pages');
};
const reset = () => {
    console.log('resetting');

    form.reset();
};
</script>
