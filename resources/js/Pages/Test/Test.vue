<template>
    <div class="grid grid-cols-4">
        <div class="h-screen col-span-3 px-12 overflow-y-scroll bg-primary-50">
            <h1 class="pt-4">Home</h1>
            <Attribute
                v-model="form.content.h1"
                :attribute="{ key: 'H1', type: 'text' }"
            />
            <Attribute
                v-model="form.content.h2"
                :attribute="{ key: 'H2', type: 'text' }"
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
                <Pool
                    :pool="[
                        TextSection,
                        CardsSection,
                        HeroSection,
                        RelationsSection,
                    ]"
                    class="w-full col-span-1 space-y-2"
                />
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
    PageInterface,
    defineContent,
    SectionsWrapper,
    Attribute,
    fillPool,
} from '@/modules/sections';
import { useForm } from '@inertiajs/inertia-vue3';
import DeleteSection from '@/modules/sections/components/DeleteSection.vue';
import {
    HeroSection,
    CardsSection,
    TextSection,
    CardSection,
    RelationsSection,
} from './sections';

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

//HeroSection, CardsSection,
fillPool([
    TextSection,
    CardsSection,
    CardSection,
    HeroSection,
    RelationsSection,
]);

const form = useForm<PageInterface>({
    name: 'Home',
    route: 'home',
    content: defineContent(props.page, {
        h1: null,
        h2: null,
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
