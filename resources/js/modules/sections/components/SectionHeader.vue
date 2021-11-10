<template>
    <div class="flex items-center justify-between">
        <div class="w-8">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                enable-background="new 0 0 24 24"
                viewBox="0 0 24 24"
                class="w-5 h-5 my-4 fill-current"
            >
                <g><rect fill="none" height="24" width="24" /></g>
                <g>
                    <g>
                        <g>
                            <path d="M20,9H4v2h16V9z M4,15h16v-2H4V15z" />
                        </g>
                    </g>
                </g>
            </svg>
        </div>
        <div class="flex-1 text-base font-bold text-black">
            {{ section.key }}
        </div>
        <div class="flex justify-end flex-1 space-x-4" v-if="actions">
            <button v-if="modal" @click="visible = true">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="-2.5 -2.5 24 24"
                    class="w-4 h-4 fill-current"
                >
                    <path
                        d="M12.238 5.472L3.2 14.51l-.591 2.016 1.975-.571 9.068-9.068-1.414-1.415zM13.78 3.93l1.414 1.414 1.318-1.318a.5.5 0 0 0 0-.707l-.708-.707a.5.5 0 0 0-.707 0L13.781 3.93zm3.439-2.732l.707.707a2.5 2.5 0 0 1 0 3.535L5.634 17.733l-4.22 1.22a1 1 0 0 1-1.237-1.241l1.248-4.255 12.26-12.26a2.5 2.5 0 0 1 3.535 0z"
                    ></path>
                </svg>
            </button>
            <button @click="prepareForDeletion(section)">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="-3 -2 24 24"
                    class="w-4 h-4 fill-current"
                >
                    <path
                        d="M12 2h5a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h5V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1zm3.8 6l-.613 9.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.205 8H15.8zM7 9a1 1 0 0 0-1 1v7a1 1 0 0 0 2 0v-7a1 1 0 0 0-1-1zm4 0a1 1 0 0 0-1 1v7a1 1 0 0 0 2 0v-7a1 1 0 0 0-1-1z"
                    ></path>
                </svg>
            </button>
        </div>
    </div>
    <Modal v-model="visible" :title="section.key">
        <SectionBody :section="section" :show="true" />
    </Modal>
</template>
<script setup lang="ts">
import { PropType, ref, computed } from 'vue';
import {
    SectionInterface,
    prepareForDeletion,
    SectionBody,
    getSectionByKey,
} from './../index';
import Modal from './Modal.vue';

const props = defineProps({
    section: {
        type: Object as PropType<SectionInterface>,
        required: true,
    },
    actions: {
        type: Boolean,
        default: false,
    },
});

const visible = ref(false);

const modal = computed(() => {
    return getSectionByKey(props.section.key)?.modal;
});
</script>
