<template>
    <Modal v-model="showModal" :title="label">
        <div>
            <progress
                v-if="form.progress"
                :value="form.progress.percentage"
                max="100"
            >
                {{ form.progress.percentage }}%
            </progress>
        </div>
        <FileExplorer :files="files" v-model="value">
            <img
                :src="`/storage/files/${selectedFile}`"
                class="rounded"
                v-if="selectedFile"
            />
            <template v-slot:drop>
                <Dropzone
                    @drop.prevent="dropFile"
                    @dragover.prevent
                    class="my-4"
                />
            </template>
        </FileExplorer>
    </Modal>
    <div
        class="w-full col-span-full"
        @click="showModal = true"
        @drop.prevent="dropOpen"
        @dragover.prevent
    >
        <img
            :src="`/storage/files/${selectedFile}`"
            class="rounded"
            v-if="selectedFile"
        />
        <Dropzone v-if="!selectedFile" />
    </div>
</template>

<script setup lang="ts">
import { computed, ref, PropType, watch } from 'vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import Modal from './../../components/Modal.vue';
import FileExplorer from './FileExplorer.vue';
import Dropzone from './Dropzone.vue';

const props = defineProps({
    modelValue: {
        type: Array as PropType<any>,
        required: true,
    },
    attribute: {
        type: Object as PropType<any>,
        required: true,
    },
    label: {
        type: String,
        required: true,
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

const form = useForm({
    file: null,
    route: 'home',
});

const id: any = computed(() => {
    let page: any = usePage().props.value?.page;
    return page?.id;
});
const submit = () => {
    form.post(`/pages/${id.value}/files`, {
        onSuccess: () => {
            form.reset();
        },
    });
};

const files: any = computed(() => {
    const page: any = usePage().props.value?.page;
    return page?.files;
});

const selectedFile: any = computed(() => {
    return files.value?.find((image: any) => image.id == value.value)?.filepath;
});

const showModal = ref(false);

const dropFile = (e: any) => {
    form.file = e.dataTransfer.files[0];
    submit();
};
const dropOpen = (e: any) => {
    form.file = e.dataTransfer.files[0];
    submit();
    showModal.value = true;
};
</script>

<style>
.square {
    padding-bottom: 100%;
}
</style>
