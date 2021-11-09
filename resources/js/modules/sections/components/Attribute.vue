<template>
    <div>
        <label for="" v-if="attribute.label">
            {{ attribute.label }}
        </label>
        <div
            class="w-full overflow-hidden text-gray-300 border-2 border-black rounded "
        >
            <select v-model="value" v-if="attribute.type == 'select'">
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
</script>
