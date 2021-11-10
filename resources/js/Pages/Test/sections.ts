import { defineSection, defineAttribute } from "@/modules/sections";

export const CardSection = defineSection({
    key: 'Card',
    class: 'col-span-6 bg-gray-100',
    attributes: [
        defineAttribute({
            key: 'Title',
            type: 'text',
            value: 'foo',
        }),
    ],
});

export const HeroSection = defineSection({
    key: 'Hero',
    class: 'grid-cols-12',
    attributes: [
        defineAttribute({
            key: 'Title',
            type: 'text',
            value: 'foo',
            class: 'col-span-6',
        }),
        defineAttribute({
            key: 'Image',
            type: 'image',
            value: null,
            class: 'col-span-6',
        }),
        defineAttribute({
            key: 'Pages',
            type: 'select',
            value: null,
            class: 'col-span-6',
            relation: 'App\\Models\\Page',
            resource: 'App\\Http\\Resources\\PageResource',
            placeholder: 'Seite auswählen',
        }),
    ],
});
export const RelationsSection = defineSection({
    key: 'Realtions',
    class: 'grid-cols-12',
    attributes: [
        defineAttribute({
            key: 'Page',
            type: 'select',
            value: null,
            class: 'col-span-6',
            relation: 'App\\Models\\Page',
            resource: 'App\\Http\\Resources\\PageResource',
            placeholder: 'Seite auswählen',
        }),
        defineAttribute({
            key: 'Pages',
            type: 'checkbox',
            value: [],
            class: 'col-span-6',
            relation: 'App\\Models\\Page',
            resource: 'App\\Http\\Resources\\PageResource',
            placeholder: 'Seite auswählen',
        }),
    ],
});

export const CardsSection = defineSection({
    key: 'Cards',
    class: 'grid-cols-12',
    modal: true,
    attributes: [
        defineAttribute({
            key: 'Title',
            type: 'text',
            value: 'Modal Foo',
            class: 'col-span-10'
        }),
    ],
    children: [CardSection],
});

export const TextSection = defineSection({
    key: 'Text',
    class: 'grid-cols-12',
    attributes: [
        defineAttribute({
            key: 'Text',
            type: 'text',
            value: null,
            class: 'col-span-4'
        }),
        defineAttribute({
            key: 'Bar',
            type: 'text',
            value: null,
            class: 'col-span-8'
        }),
    ],
});