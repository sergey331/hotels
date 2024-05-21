<script setup>
import {useStore} from "vuex";

let store = useStore();
import {computed} from "vue";

let general = computed(() => store.getters.getGeneral)
let address = computed(() => store.getters.getAddress)
let company = computed(() => store.getters.getCompany)

let countries = computed(() => store.getters.countries)
let states = computed(() => store.getters.states)
let cities = computed(() => store.getters.cities)

let statesCompany = computed(() => store.getters.statesCompany)
let citiesCompany = computed(() => store.getters.citiesCompany)

const getCountry = id => {
    return countries.value.find(item => item.id === id)?.name
}
const getState = id => {
    return states.value.find(item => item.id === id)?.name
}
const getCity = id => {
    return cities.value.find(item => item.id === id)?.name
}

const getCompanyState = id => {
    return statesCompany.value.find(item => item.id === id)?.name
}

const getCompanyCity = id => {
    return citiesCompany.value.find(item => item.id === id)?.name
}
</script>

<template>
    <div style="width: 70%;margin: 40px auto;">

        <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Confirm registration:</h2>

        <hr>

        <h4 class="mt-2">General</h4>
        <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
            <li>
               First Name - {{ general.first_name }}
            </li>
            <li>
                Last name - {{ general.last_name }}
            </li>
            <li>
                Email - {{ general.email }}
            </li>
            <li>
                Phone - {{ general.phone }}
            </li>
            <li>
                Date of birth - {{ general.dob }}
            </li>
        </ul>

        <hr class="mt-2">
        <h4 class="mt-2">Address</h4>
        <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
            <li>
                Address - {{ address.address }}
            </li>
            <li>
                Address 1 - {{ address.address1 }}
            </li>
            <li>
                Country - {{ getCountry(address.country_id) }}
            </li>
            <li>
                State - {{ getState(address.state_id) }}
            </li>
            <li>
                City - {{ getCity(address.city_id) }}
            </li>
            <li>
                Zip code  - {{ address.zip }}
            </li>
        </ul>
        <hr class="mt-2">
        <h4 class="mt-2">Company</h4>
        <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
            <li>
                Name - {{ company.company_name }}
            </li>
            <li>
                Email - {{ company.email }}
            </li>
            <li>
                Phone - {{ company.phone }}
            </li>
            <li>
                Address - {{ company.address }}
            </li>
            <li>
                Address 1 - {{ company.address1 }}
            </li>
            <li>
                Country - {{ getCountry(company.country_id) }}
            </li>
            <li>
                State - {{ getCompanyState(company.state_id) }}
            </li>
            <li>
                City - {{ getCompanyCity(company.city_id) }}
            </li>
            <li>
                Zip code  - {{ company.zip }}
            </li>
        </ul>

        <button
            type="button"
            class="py-2.5 px-5 mt-2 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
            @click="$emit('register')"
        >
            Register
        </button>
    </div>

</template>
