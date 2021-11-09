import {ref} from 'vue'

export { default as Section } from './components/Section.vue'
export { default as Sections } from './components/Sections.vue'
export { default as Attribute } from './components/Attribute.vue'
export { default as AttributeWrapper } from './components/AttributeWrapper.vue'
export { default as Pool } from './components/Pool.vue'
export { default as SectionWrapper } from './components/SectionWrapper.vue'
export { default as SectionsWrapper } from './components/SectionsWrapper.vue'
export { default as DeleteSection } from './components/DeleteSection.vue'
export { default as SectionHeader } from './components/SectionHeader.vue'
export { default as SectionBody } from './components/SectionBody.vue'


export declare interface AttributeInterface {
    uuid?: string;
    key: string;
    type: string;
    label?: string | null;
    value?: string | number | boolean | null;
    options?: string;
    placeholder?: string;
}
export declare interface SectionInterface {
    uuid?: string;
    modal?: boolean;
    key: string;
    attributes: AttributeInterface[];
    sections?: SectionInterface[];
    pool?: any[];
}

export declare interface PageInterface {
    name: string;
    route: string;
    content: any;
}

export const defineContent = (page: PageInterface, content: any) => {
    return page ? { ...JSON.parse(JSON.stringify(page.content)) } : content
}

export const defineSection = (section:  SectionInterface) => {
    return section
}
export const defineAttribute = (attribute:  AttributeInterface) => {
    return attribute
}

export const deletionQueue = ref<string[]>([])

export const prepareForDeletion = (section: SectionInterface) => {
    if(section.uuid){
        deletionQueue.value.push(section.uuid)
    }
};

