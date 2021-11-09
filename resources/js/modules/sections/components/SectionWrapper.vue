<template>
    <div
        class="py-1 pl-4 pr-8 mb-2 bg-white border border-gray-200 rounded  bg-white-50"
    >
        <div class="flex">
            <div class="pt-1 pr-4 cursor-grab">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    enable-background="new 0 0 24 24"
                    viewBox="0 0 24 24"
                    class="w-5 h-5 my-2 fill-current"
                >
                    <g><rect fill="none" height="24" width="24" /></g>
                    <g>
                        <g>
                            <g>
                                <path d="M20,9H4v2h16V9z M4,15h16v-2H4V15z" />
                            </g>
                        </g>
                    </g>
                </svg>
            </div>
            <div class="flex-1">
                <slot />
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
//
</script>
