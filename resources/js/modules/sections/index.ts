import {ref} from 'vue'
import { v4 } from 'uuid';

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
    colspan?: number;
}
export declare interface SectionInterface {
    uuid?: string;
    key: string;
    attributes: AttributeInterface[];
    sections?: SectionInterface[];
    pool?: any[];
    modal?: boolean;
    footer?: boolean;
    cols?: number;
}

export declare interface PoolInterface extends SectionInterface {
    uuid: string;
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

export const cloneSection: any = (el: SectionInterface) => {
    // we create a new pool and empty sections for nested sections
    let sections = {
        sections: el.pool ? [] : null,
        pool: el.pool?.map((pool: SectionInterface) => {
            return cloneSection(pool);
        }),
    };
    return {
        uuid: v4(),
        key: el.key,
        modal: el.modal,
        footer: el.footer,
        cols: el.cols,
        attributes: el.attributes.map((attr: any) => {
            return { uuid: v4(), ...attr };
        }),
        ...sections,
    };
};
