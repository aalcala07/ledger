<template>
    <div>
        <div v-show="expanded" class="bg-white h-screen w-screen fixed md:relative z-20 md:w-64 p-4">
            <div class="flex justify-end p-2">
                <button class="text-gray-700" @click="expanded = false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </button>
            </div>
            <nav>
                <ul class="text-gray-700">
                    <li><a :href="$root.getPath('dashboard')">Dashboard</a></li>
                    <li><a :href="$root.getPath('accounts')">Accounts</a></li>
                    <li><a :href="$root.getPath('entries')">Entries</a></li>
                </ul>
            </nav>
        </div>
        <div v-show="!expanded" class="bg-white fixed w-screen md:w-auto md:relative md:h-screen p-1 z-20">
            <button class="p-2 text-gray-700" @click="expanded = true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            expanded: false
        }
    }
}
</script>

<style>

</style>