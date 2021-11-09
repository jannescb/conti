<template>
    <draggable
        v-model="pool"
        :group="{
            name: group,
            pull: 'clone',
            put: false,
        }"
        :sort="false"
        :clone="clone"
    >
        <template #item="{ element }">
            <SectionWrapper>
                <SectionTitle>
                    {{ element.key }}
                </SectionTitle>
            </SectionWrapper>
        </template>
    </draggable>
</template>
<script setup lang="ts">
import { PropType } from 'vue';
import draggable from 'vuedraggable';
import { v4 } from 'uuid';
import { SectionInterface, SectionWrapper, SectionTitle } from './../index';

defineProps({
    pool: {
        type: Array as PropType<SectionInterface[]>,
        required: true,
    },
    group: {
        type: String,
        default: 'sections',
    },
});

const clone: any = (el: SectionInterface) => {
    // we create a new pool and empty sections for nested sections
    console.log(el);

    let sections = {
        sections: el.pool ? [] : null,
        pool: el.pool?.map((pool: SectionInterface) => {
            return clone(pool);
        }),
    };
    return {
        uuid: v4(),
        key: el.key,
        attributes: el.attributes.map((attr: any) => {
            return { uuid: v4(), ...attr };
        }),
        ...sections,
    };
};
</script>

<style>
.flip-list-move {
    transition: transform 0.5s;
}
.no-move {
    transition: transform 0s;
}
.ghost {
    opacity: 0.5;
    background: #c8ebfb;
}
.list-group {
    min-height: 20px;
}
.list-group-item {
    cursor: move;
}
.list-group-item i {
    cursor: pointer;
}
</style>
