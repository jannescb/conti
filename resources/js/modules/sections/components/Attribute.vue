<template>
    <div :class="config('class')">
        <label class="block pb-1 text-sm font-bold">
            {{ config('label') || attribute.key }}
        </label>
        <div
            class="flex w-full h-12 overflow-hidden text-gray-300 border border-gray-300 rounded "
        >
            <select
                v-model="value"
                v-if="config('type') == 'select'"
                class="w-full px-4 py-2"
            >
                <option
                    v-if="config('placeholder')"
                    :selected="!value"
                    disabled
                >
                    {{ config('placeholder') }}
                </option>
                <option :value="id" v-for="(option, id) in options">
                    {{ option }}
                </option>
            </select>
            <div v-else-if="config('type') == 'checkbox'">
                <div v-for="(option, id) in options">
                    <input
                        type="checkbox"
                        :id="option"
                        :value="id"
                        v-model="value"
                    />
                    <label :for="option">{{ option }}</label>
                </div>
            </div>
            <input
                :type="config('type')"
                v-else
                v-model="value"
                class="w-full px-4 py-2"
                :placeholder="config('placeholder')"
            />
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
    type: {
        type: String,
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
</script>
