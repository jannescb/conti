<template>
    <div class="p-4 bg-white border-black rounded">
        <div v-if="editor" class="grid grid-cols-12">
            <button
                @click="editor.chain().focus().toggleBold().run()"
                :class="{ 'is-active': editor.isActive('bold') }"
            >
                bold
            </button>
            <button
                @click="editor.chain().focus().toggleItalic().run()"
                :class="{ 'is-active': editor.isActive('italic') }"
            >
                italic
            </button>
            <button
                @click="editor.chain().focus().toggleStrike().run()"
                :class="{ 'is-active': editor.isActive('strike') }"
            >
                strike
            </button>
            <button
                @click="editor.chain().focus().toggleCode().run()"
                :class="{ 'is-active': editor.isActive('code') }"
            >
                code
            </button>
            <button @click="editor.chain().focus().unsetAllMarks().run()">
                clear marks
            </button>
            <button @click="editor.chain().focus().clearNodes().run()">
                clear nodes
            </button>
            <button
                @click="editor.chain().focus().setParagraph().run()"
                :class="{ 'is-active': editor.isActive('paragraph') }"
            >
                paragraph
            </button>
            <button
                @click="
                    editor.chain().focus().toggleHeading({ level: 1 }).run()
                "
                :class="{
                    'is-active': editor.isActive('heading', { level: 1 }),
                }"
            >
                h1
            </button>
            <button
                @click="
                    editor.chain().focus().toggleHeading({ level: 2 }).run()
                "
                :class="{
                    'is-active': editor.isActive('heading', { level: 2 }),
                }"
            >
                h2
            </button>
            <button
                @click="
                    editor.chain().focus().toggleHeading({ level: 3 }).run()
                "
                :class="{
                    'is-active': editor.isActive('heading', { level: 3 }),
                }"
            >
                h3
            </button>
            <button
                @click="
                    editor.chain().focus().toggleHeading({ level: 4 }).run()
                "
                :class="{
                    'is-active': editor.isActive('heading', { level: 4 }),
                }"
            >
                h4
            </button>
            <button
                @click="
                    editor.chain().focus().toggleHeading({ level: 5 }).run()
                "
                :class="{
                    'is-active': editor.isActive('heading', { level: 5 }),
                }"
            >
                h5
            </button>
            <button
                @click="
                    editor.chain().focus().toggleHeading({ level: 6 }).run()
                "
                :class="{
                    'is-active': editor.isActive('heading', { level: 6 }),
                }"
            >
                h6
            </button>
            <button
                @click="editor.chain().focus().toggleBulletList().run()"
                :class="{ 'is-active': editor.isActive('bulletList') }"
            >
                bullet list
            </button>
            <button
                @click="editor.chain().focus().toggleOrderedList().run()"
                :class="{ 'is-active': editor.isActive('orderedList') }"
            >
                ordered list
            </button>
            <button
                @click="editor.chain().focus().toggleCodeBlock().run()"
                :class="{ 'is-active': editor.isActive('codeBlock') }"
            >
                code block
            </button>
            <button
                @click="editor.chain().focus().toggleBlockquote().run()"
                :class="{ 'is-active': editor.isActive('blockquote') }"
            >
                blockquote
            </button>
            <button @click="editor.chain().focus().setHorizontalRule().run()">
                horizontal rule
            </button>
            <button @click="editor.chain().focus().setHardBreak().run()">
                hard break
            </button>
            <button @click="editor.chain().focus().undo().run()">undo</button>
            <button @click="editor.chain().focus().redo().run()">redo</button>
        </div>

        <EditorContent :editor="editor" />
    </div>
</template>

<script setup lang="ts">
import { ref, PropType, watch, onMounted, defineEmits } from 'vue';
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';

const props = defineProps({
    modelValue: {
        type: String as PropType<string>,
        required: true,
    },
});

const emit = defineEmits(['update:modelValue']);

const editor = useEditor({
    content: props.modelValue,
    editorProps: {
        attributes: {
            class: 'p-4 border border-gray-200 rounded',
        },
    },
    extensions: [StarterKit],
    onUpdate: () => {
        emit('update:modelValue', editor.value.getHTML());
    },
});
</script>
