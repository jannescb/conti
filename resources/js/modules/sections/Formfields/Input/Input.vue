<template>
    <input
        v-model="value"
        type="text"
        class="w-full h-12 px-4 py-2 border border-gray-200 rounded"
    />
</template>
<script setup lang="ts">
import { computed, ref, PropType, watch } from 'vue';

const props = defineProps({
    modelValue: {
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
