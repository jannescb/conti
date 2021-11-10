<template>
    <div v-for="(option, id) in options">
        <input type="checkbox" :id="option" :value="id" v-model="value" />
        <label :for="option">{{ option }}</label>
    </div>
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
