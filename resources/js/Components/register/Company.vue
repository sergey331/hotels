<script setup>
import {useStore} from "vuex";
import {computed, onMounted} from "vue";

let store = useStore();
let emit = defineEmits();
onMounted(() => {
    store.dispatch('getCountries')
})

let countries = computed(() => store.getters.countries)
let states = computed(() => store.getters.states)
let cities = computed(() => store.getters.cities)
let company = computed(() => store.getters.getCompany)

const selectCountry = () => {
    let id = company.value.country_id;
    store.dispatch('getStates',id)
}
const selectState = () => {
    let id = company.value.state_id;
    store.dispatch('getCities',id)
}

const next = () => {
    emit('next', 3)
}
const prev = () => {
    emit('next', 1)
}
</script>

<template>
    <div style="width: 70%;margin: 40px auto;">

        <div class="mb-5">
            <label for="company_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company name</label>
            <input type="text" v-model="company.company_name" id="company_name"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>
        <div class="mb-5">
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
            <input type="text" v-model="company.phone" id="phone"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="text" v-model="company.email" id="email"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>
        <div class="mb-5">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
            <input type="text" v-model="company.address" id="address"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>

        <div class="mb-5">
            <label for="address1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address 1</label>
            <input type="text" v-model="company.address1" id="address1"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>
        <div class="mb-5">
            <label for="country_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
            <select v-model="company.country_id" id="country_id" @change="selectCountry">
                <option value="">Select Country</option>
                <option v-if="countries.length" v-for="country in countries" :key="country.id" :value="country.id" >{{ country.name }}</option>
            </select>
        </div>

        <div class="mb-5">
            <label for="country_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">State</label>
            <select v-model="company.state_id" id="country_id" @change="selectState">
                <option value="">Select State</option>
                <option v-if="states.length" v-for="state in states" :key="state.id" :value="state.id" >{{ state.name }}</option>
            </select>
        </div>

        <div class="mb-5">
            <label for="city_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
            <select v-model="company.city_id" id="country_id" >
                <option value="">Select city</option>
                <option v-if="cities.length" v-for="city in cities" :key="city.id" :value="city.id" >{{ city.name }}</option>
            </select>
        </div>

        <div class="mb-5">
            <label for="zip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zip code</label>
            <input type="text" v-model="company.zip" id="address1"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>
        <button
            type="button"
            @click="prev"
            class="py-2.5 px-5 mt-2 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
        >
            Prev
        </button>
        <button
            type="button"
            @click="next"
            class="py-2.5 px-5 mt-2 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
        >
            Next
        </button>

    </div>
</template>

<style scoped>

</style>