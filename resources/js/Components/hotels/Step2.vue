<script setup>

</script>

<template>
    <div class="step">
        <p class="text-md text-gray-700 leading-tight text-center mt-8 mb-5">Rooms</p>
        <div class="mb-6">
            <input
                type="number"
                placeholder="Price"
                class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
            />
        </div>
        <div class="mb-6">
            <select
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            >
                <option selected>Choose a currency</option>
                <option value="amd">Armenian dram</option>
                <option value="usd">Dollar</option>
                <option value="eur">Euro</option>
                <option value="rur">Rubly</option>
            </select>
        </div>
        <div class="mb-6"><input type="text" placeholder="Facebook" name="facebook"
                                 class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
                                 oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'"/>
        </div>
    </div>
</template>

<style scoped>

</style>