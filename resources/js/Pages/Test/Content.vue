<template>
    <div>
        <button @click="add(el)" class="p-2 border" v-for="el in pool">
            add {{ el.key }}
        </button>
        <div v-for="el in sections">
            <div v-for="attribute in el.attributes">
                <input
                    :type="attribute.type"
                    v-model="attribute.value"
                    class="border"
                />
            </div>
        </div>
        <pre class="text-xs">{{ sections }}</pre>
    </div>
</template>
<script setup lang="ts">
import { ref } from 'vue';
import { v4 } from 'uuid';
const pool = [
    {
        key: 'Hero',
        attributes: [
            {
                key: 'Title',
                type: 'text',
                value: 'foo',
            },
            {
                key: 'Intro',
                type: 'text',
            },
        ],
    },
    {
        key: 'Cards',
        attributes: [
            {
                key: 'Title',
                type: 'text',
            },
        ],
        sections: [
            {
                key: 'Card',
                attributes: [
                    {
                        key: 'Title',
                        type: 'text',
                        value: 'foo',
                    },
                ],
            },
        ],
    },
];

const sections = ref<any>([]);

const add = (el: any) => {
    let section = {
        uuid: v4(),
        key: el.key,
        attributes: el.attributes.map((attr: any) => {
            return { uuid: v4(), ...attr };
        }),
    };
    sections.value.push(section);
};
</script>
