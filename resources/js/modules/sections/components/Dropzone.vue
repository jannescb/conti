<template>
    <Modal v-model="showModal">
        <div>
            <progress
                v-if="form.progress"
                :value="form.progress.percentage"
                max="100"
            >
                {{ form.progress.percentage }}%
            </progress>
        </div>
        <div class="grid gap-4 grid-cols-121">
            <div
                v-for="img in gallery"
                class="relative col-span-6"
                @click="value = img.id"
            >
                <img
                    :src="`/storage/files/${img.filepath}`"
                    :class="{
                        'border-black border-2': value == img.id,
                        'border border-gray-200': value != img.id,
                    }"
                />
            </div>
        </div>
        <input type="file" @input="form.file = $event.target.files[0]" />
        <button @click="submit">Submit</button>
    </Modal>
    <div class="w-full col-span-full" @click="showModal = true">
        <img :src="`/storage/files/${img}`" class="" v-if="img" />
        <div
            class="flex items-center justify-center w-full h-48 text-gray-300 bg-gray-200 rounded "
            v-else
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="-2 -4 24 24"
                width="24"
                class="w-12 h-12 fill-current"
            >
                <path
                    d="M20 10.536l-4.416-4.44a3 3 0 0 0-4.69.582L5.072 16H3a3 3 0 0 1-3-3V3a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v7.536zm-.011 2.724A3 3 0 0 1 17 16H7.64l4.969-8.293a1 1 0 0 1 1.563-.195l5.817 5.748zM6 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"
                ></path>
            </svg>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed, ref, PropType, watch } from 'vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import Modal from './Modal.vue';

const props = defineProps({
    modelValue: {
        type: Array as PropType<any>,
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

const gallery: any = computed(() => {
    const page: any = usePage().props.value?.page;
    return page?.files;
});

const img: any = computed(() => {
    return gallery.value?.find((image: any) => image.id == value.value)
        ?.filepath;
});

const showModal = ref(false);

const submit = () => {
    form.post(`/pages/${id.value}/files`, {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<style>
.square {
    padding-bottom: 100%;
}
</style>
