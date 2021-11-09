import {ref} from 'vue'

export { default as Section } from './components/Section.vue'
export { default as Sections } from './components/Sections.vue'
export { default as Attribute } from './components/Attribute.vue'
export { default as Pool } from './components/Pool.vue'


export interface Attribute {
    uuid?: string;
    key: string;
    type: string;
    label?: string | null;
    value?: string | number | boolean | null;
    options?: string;
    placeholder?: string;
}
export interface Section {
    uuid?: string;
    key: string;
    attributes: Attribute[];
    sections?: Section[];
}

export interface Page {
    name: string;
    route: string;
    content: any;
}

export const defineContent = (page: Page, content: any) => {
    return page ? { ...page.content } : content
}

export const defineAttribute = (attribute:  Attribute) => {
    return attribute
}

export const deletionQueue = ref<string[]>([])

export const prepareForDeletion = (section: Section) => {
    if(section.uuid){
        deletionQueue.value.push(section.uuid)
    }
};

