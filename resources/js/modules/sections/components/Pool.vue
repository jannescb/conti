<template>
    <div>
        <draggable
            v-model="pool"
            :group="{
                name: group,
                pull: 'clone',
                put: false,
            }"
            :sort="false"
            :clone="clone"
            class="border border-gray-200 divide-y"
        >
            <template #item="{ element }">
                <div>
                    {{ element.key }}
                </div>
            </template>
        </draggable>
    </div>
</template>
<script setup lang="ts">
import { PropType } from 'vue';
import draggable from 'vuedraggable';
import { v4 } from 'uuid';
import { Section } from './../index';

defineProps({
    pool: {
        type: Array as PropType<Section[]>,
        required: true,
    },
    group: {
        type: String,
        default: 'sections',
    },
});

const clone: any = (el: Section) => {
    return {
        uuid: v4(),
        key: el.key,
        attributes: el.attributes.map((attr: any) => {
            return { uuid: v4(), ...attr };
        }),
        sections: el.sections ? [] : null,
        pool: el.sections?.map((section: Section) => {
            return clone(section);
        }),
    };
};
</script>
