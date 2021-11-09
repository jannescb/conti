<template>
    <TransitionRoot appear :show="modelValue" as="template">
        <Dialog as="div" @close="closeModal">
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="min-h-screen px-4 text-center">
                    <DialogOverlay
                        class="fixed inset-0 bg-gray-900 opacity-30"
                    />

                    <span
                        class="inline-block h-screen align-middle"
                        aria-hidden="true"
                    >
                        &#8203;
                    </span>

                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <div
                            class="inline-block w-full max-w-3xl py-8 pr-8 my-8 overflow-hidden text-left align-middle transition-all transform bg-white rounded shadow-xl  r"
                        >
                            <DialogTitle
                                as="div"
                                class="mb-6 ml-8 text-base font-bold text-black"
                                v-if="title"
                            >
                                {{ title }}
                            </DialogTitle>
                            <div class="mt-2">
                                <slot />
                            </div>
                            <div class="flex justify-end">
                                <button
                                    class="px-6 py-2 text-xs text-white bg-black rounded-sm "
                                    @click="closeModal()"
                                >
                                    OK
                                </button>
                            </div>
                        </div>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup lang="ts">
import { defineEmits } from 'vue';
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogOverlay,
    DialogTitle,
} from '@headlessui/vue';

defineProps({
    modelValue: {
        type: Boolean,
        required: true,
    },
    title: {
        type: String,
        default: null,
    },
});

const emit = defineEmits(['update:modelValue']);

const closeModal = () => {
    emit('update:modelValue', false);
};
</script>
