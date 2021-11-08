<template>
    <div class="grid grid-cols-3 gap-8 px-8">
        <div class="flex col-span-2 space-x-6">
            <div>
                <div class="py-4 bg-gray-100 rounded shadow">
                    <div class="border-t border-gray-200">
                        <draggable
                            v-model="sections"
                            :group="{
                                name: 'sections',
                                pull: 'clone',
                                put: false,
                            }"
                            :sort="false"
                            @start="drag = true"
                            @end="drag = false"
                        >
                            <template #item="{ element }">
                                <div class="px-6 border-b border-gray-200">
                                    {{ element.type }}
                                </div>
                            </template>
                        </draggable>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <draggable
                    v-model="content"
                    group="sections"
                    @start="drag = true"
                    @end="drag = false"
                    @change="change"
                    item-key="id"
                >
                    <template #item="{ element }">
                        <div class="px-4 py-1 mb-1 rounded bg-gray-50">
                            <span class="text-xs">
                                {{ element.type }}
                            </span>
                            <div v-for="attribute in element.attributes">
                                <input
                                    :type="attribute.type"
                                    v-model="attribute.value"
                                />
                            </div>
                        </div>
                    </template>
                </draggable>
                <button
                    @click="save()"
                    class="px-6 py-1 text-white rounded shadow bg-green"
                >
                    Save
                </button>
            </div>
        </div>
        <div
            class="col-span-1 p-6 space-y-4 text-xs bg-gray-900 rounded  text-green"
        >
            <pre>{{ sections }}</pre>
            <pre>{{ content }}</pre>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, PropType, onMounted } from 'vue';
import draggable from 'vuedraggable';
import axios from 'axios';
import * as _ from 'lodash';

interface Sortable {
    id?: number;
    class?: string;
    type?: string;
}

const props = defineProps({
    sections: {
        type: Array,
        required: true,
    },
    content: {
        type: Array as PropType<Sortable[]>,
        required: true,
    },
});

const drag = ref(false);

// const orderArray = computed(() => {
//     return props.content.map((section: any) => {
//         return {
//             id: section.id,
//             class: section.class,
//             type: section.type,
//             parent_id: section.parent_id,
//             parent_type: section.parent_type,
//             attributes: section.attributes,
//         };
//     });
// });

// const save = async () => {
//     const { data } = await axios.post('/order', orderArray.value);
// };

const change = (e: any) => {
    if (e.added) {
        e.added.element.id = -1;
    }
};
</script>
