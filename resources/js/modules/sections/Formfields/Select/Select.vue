<template>
    <select
        v-model="value"
        class="w-full h-12 px-4 py-2 border border-gray-200 rounded"
    >
        <option v-if="placeholder" :selected="!value" disabled>
            {{ placeholder }}
        </option>
        <option :value="id" v-for="(option, id) in options">
            {{ option }}
        </option>
    </select>
</template>

<script setup lang="ts">
import { ref, PropType, watch } from 'vue';
const props = defineProps({
    modelValue: {
        type: Array as PropType<any>,
        required: true,
    },
    options: {
        type: Array as PropType<any>,
        required: true,
    },
    placeholder: {
        type: String,
        default: null,
    },
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
</script>
