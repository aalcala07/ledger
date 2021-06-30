<template>
    <div class="bg-white rounded p-4">
        <div class="flex flex-row justify-between">
            <h3 class="mb-4 text-green-500 border-green-500 border-b pr-8 inline-block">{{ card.title }}</h3>
            <options-dropdown v-if="'options' in card" :options="card.options" @clickedOption="action($event)"></options-dropdown>
        </div>

        <div v-if="'table' in card">
            <table class="w-full text-gray-700">
                <tr v-for="(row, index) in card.table.rows" :key="index">
                    <td v-for="(cell, cellIndex) in row" :key="cellIndex">{{ cell }}</td>
                </tr>
            </table>
        </div>
        <div v-else-if="'stat' in card" class="text-3xl font-bold text-gray-700">
            {{ card.stat }}
        </div>
    </div>
</template>

<script>
export default {
    props: ['card'],
    data() {
        return {

        }
    },
    methods: {
        action(action) {
            console.log('action: ' + action)

            switch (action) {
                case "externalAccounts.manage": 
                    // go to external accounts page
                    location.href = this.$root.getPath('externalAccounts');
                    break;
            }
        }
    }
}
</script>

<style scoped>

table td:not(:last-child) {
    padding-right: 1rem;
}
</style>