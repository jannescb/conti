<template>
    <div>
        <label for="" v-if="attribute.label">
            {{ attribute.label }}
        </label>
        <select v-model="value" v-if="attribute.type == 'select'">
            <option v-if="attribute.placeholder" :selected="!value" disabled>
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
        <input :type="attribute.type" v-else v-model="value" />
    </div>
</template>
<script setup lang="ts">
import { PropType, defineEmits, ref, watch, computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import { Attribute } from './../index';
const props = defineProps({
    modelValue: {
        type: Array as PropType<any>,
        required: true,
    },
    attribute: {
        type: Object as PropType<Attribute>,
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
