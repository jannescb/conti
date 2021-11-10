<template>
    <div :class="config('class')">
        <label class="block pb-1 text-sm font-bold">
            {{ config('label') || attribute.key }}
        </label>
        <div class="flex w-full text-gray-300">
            <component
                v-if="formField"
                :is="formField"
                v-model="value"
                :attribute="attribute"
                :options="options"
                :placeholder="config('placeholder')"
                :label="config('label') || attribute.key"
            />
            <div v-else class="text-xs text-primary">No Formfield defined.</div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { PropType, defineEmits, ref, watch, computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import { AttributeInterface, getAttribute } from './../index';

const props = defineProps({
    modelValue: {
        type: Array as PropType<any>,
        required: true,
    },
    attribute: {
        type: Object as PropType<AttributeInterface>,
        required: true,
    },
    sectionKey: {
        type: String,
        default: null,
    },
    as: {
        type: Object,
        default: null,
    },
});

const options: any = computed(() => {
    let optionsKey = config('relation');

    if (!optionsKey) {
        return;
    }

    const options: any = usePage().props.value.relations;

    return options[optionsKey];
});

const value = ref(props.modelValue);

const emit = defineEmits(['update:modelValue']);
watch(
    () => value,
    (state, prevState) => {
        emit('update:modelValue', value.value);
    },
    { deep: true }
);

const config = (key: string) => {
    if (!props.sectionKey || !props.attribute.key) {
        return;
    }
    let attr: any = getAttribute(props.sectionKey, props.attribute.key);

    return attr?.[key];
};

const formField = computed(() => {
    return config('as') || props.as;
});
</script>
