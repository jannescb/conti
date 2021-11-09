<template>
    <div
        class="fixed top-0 left-0 flex items-center justify-center w-screen h-screen bg-gray-900 bg-opacity-25 "
        v-if="deletionQueue.length > 0"
    >
        <div class="p-8 bg-white rounded w-96">
            <div class="flex justify-end">
                <button
                    class="px-4 py-1 text-xs text-white rounded bg-red"
                    @click="deleteSection()"
                >
                    löschen
                </button>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { PropType } from 'vue';
import { Section, deletionQueue } from '../index';

defineProps({
    sections: {
        type: Array as PropType<Section[]>,
        required: true,
    },
});

const deleteSection = () => {
    // TODO:
    deletionQueue.value = [];
};
</script>
