<template>
    <div class="relative">
        <div @click="show = !show" class="text-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
            </svg>
        </div>
        <div v-show="show" class="absolute right-0 bg-white border border-green-700 py-3 z-10 w-64">
            <ul class="text-sm">
                <li v-for="(option, index) in options" :key="index">
                    <a :href="option.url ? option.url : 'javascript:void(0);'" class="p-3 hover:bg-green-200 cursor-pointer block" @click="option.action ? $emit('clickedOption', option.action) : null; show = false;">{{ option.label }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: ['options'],
    data() {
        return {
            show: false,
        }
    }
}
</script>

<style>

</style>