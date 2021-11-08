export { default as Section } from './components/Section.vue'
export { default as Sections } from './components/Sections.vue'
export { default as Attribute } from './components/Attribute.vue'
export { default as Pool } from './components/Pool.vue'


export interface Attribute {
    key: string;
    type: string;
    value?: string | number | boolean;
}
export interface Section {
    key: string;
    attributes: Attribute[];
    sections?: Section[];
}