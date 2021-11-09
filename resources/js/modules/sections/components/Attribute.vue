<template>
    <div :class="[colspan]">
        <label class="block pb-1 text-sm font-bold">
            {{ attribute.label || attribute.key }}
        </label>
        <div
            class="flex w-full h-12 overflow-hidden text-gray-300 border border-gray-300 rounded "
        >
            <select
                v-model="value"
                v-if="attribute.type == 'select'"
                class="w-full px-4 py-2"
            >
                <option
                    v-if="attribute.placeholder"
                    :selected="!value"
                    disabled
                >
                    {{ attribute.placeholder }}
                </option>
                <option
                    :value="id"
                    v-for="(option, id) in options[attribute.options]"
                    v-if="attribute.options"
                >
                    {{ option }}
                </option>
            </select>
            <input
                :type="attribute.type"
                v-else
                v-model="value"
                class="w-full px-4 py-2"
            />
        </div>
    </div>
</template>
<script setup lang="ts">
import { PropType, defineEmits, ref, watch, computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import { AttributeInterface } from './../index';
const props = defineProps({
    modelValue: {
        type: Array as PropType<any>,
        required: true,
    },
    attribute: {
        type: Object as PropType<AttributeInterface>,
        required: true,
    },
});

const options: any = computed(() => usePage().props.value.options);

const value = ref(props.modelValue);

const emit = defineEmits(['update:modelValue']);
watch(
    () => value,
    (state, prevState) => {
        emit('update:modelValue', value.value);
    },
    { deep: true }
);

const colspan = computed(() => {
    if (props.attribute.colspan) {
        return `col-span-${props.attribute.colspan}`;
    }
    return 'col-span-full';
});
</script>
