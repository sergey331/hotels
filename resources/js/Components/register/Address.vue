<script setup>
import {useStore} from "vuex";
import {computed, onMounted} from "vue";

let store = useStore();

onMounted(() => {
    store.dispatch('getCountries')
})

let countries = computed(store.getters.countries)
let address = computed(store.getters.getAddress)

// console.log(countries)
</script>

<template>
    <div style="width: 70%;margin: 40px auto;">
        <div class="mb-5">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
            <input type="text" v-model="address.address" id="address"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>

        <div class="mb-5">
            <label for="address1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address 1</label>
            <input type="text" v-model="address.address1" id="address1"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>
    </div>
</template>

<style scoped>

</style>