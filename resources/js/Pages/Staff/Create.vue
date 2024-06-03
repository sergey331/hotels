<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useStore} from "vuex";
import {computed, onMounted, watch} from "vue";
import {toast} from "vue3-toastify";
import staff from "@/store/modules/staff.js";

let store = useStore();

onMounted(() => {
    store.dispatch('getCountries')
})
let form = computed(() => store.getters.getStaffForm);
let countries = computed(() => store.getters.countries)
let states = computed(() => store.getters.states)
let cities = computed(() => store.getters.cities)

const selectCountry = () => {
    let id = form.value.country_id;
    store.dispatch('getStates',id)
}
const selectState = () => {
    let id = form.value.state_id;
    store.dispatch('getCities',id)
}

const selectAvatar = e => {
    form.value.avatar = e.target.files[0]
}

let success = computed(() => store.getters.getStaffSuccess)
watch(
    () => success.value,
    () => {
        if (success.value) {
            window.location.href = '/staffs'
        }
    }
);

const save = () => {
    let validated = validate();
    if (validated) {
        let validateData = new FormData()
        let forms = form.value;
         validateData.append('first_name',forms.first_name)
         validateData.append('last_name',forms.last_name)
         validateData.append('phone',forms.phone)
         validateData.append('email',forms.email)
         validateData.append('password',forms.password)
         validateData.append('address',forms.address)
         validateData.append('country_id',forms.country_id)
         validateData.append('state_id',forms.state_id)
         validateData.append('city_id',forms.city_id)
         validateData.append('zip',forms.zip)
        if (forms.avatar !== '') {
            validateData.append('avatar',forms.avatar)
        }

        store.dispatch('saveStaff',validateData)
    } else {
        toast('Error accorded',{
            type: 'error'
        })
    }
}


const validate = () => {
    let check = true;
    let forms = form.value;
    if (
        forms.first_name === '' ||
        forms.last_name === '' ||
        forms.phone === '' ||
        forms.email === '' ||
        forms.password === '' ||
        forms.address === '' ||
        forms.country_id === '' ||
        forms.state_id === '' ||
        forms.city_id  === '' ||
        forms.zip === ''
    ) {
        check = false;
    }

    return check;
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="my-3">
                        <h3>New Customer</h3>
                    </div>
                    <hr>
                    <div class="mt-3">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label
                                    for="first_name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    First name
                                </label>
                                <input
                                    type="text"
                                    id="first_name"
                                    v-model="form.first_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <div>
                                <label
                                    for="last_name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    Last name
                                </label>
                                <input
                                    type="text"
                                    v-model="form.last_name"
                                    id="last_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <div>
                                <label for="email"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    Email
                                </label>
                                <input
                                    type="text"
                                    v-model="form.email"
                                    id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <div>
                                <label
                                    for="phone"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    Phone number
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                            <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        v-model="form.phone"
                                        id="phone"
                                        aria-describedby="helper-text-explanation"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                                    />
                                </div>
                            </div>
                            <div>
                                <label
                                    for="address"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    Address
                                </label>
                                <input
                                    type="text"
                                    v-model="form.address"
                                    id="address"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <div>
                                <label
                                    for="address1"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    Address 1
                                </label>
                                <input
                                    type="text"
                                    v-model="form.address1"
                                    id="address1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <div>

                                <label for="country_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                                <select
                                    v-model="form.country_id"
                                    id="country_id"
                                    @change="selectCountry"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                    <option value="">Select Country</option>
                                    <option v-if="countries.length" v-for="country in countries" :key="country.id" :value="country.id" >{{ country.name }}</option>
                                </select>
                            </div>
                            <div>
                                <label
                                    for="state_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    State
                                </label>
                                <select
                                    v-model="form.state_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    id="state_id"
                                    @change="selectState"
                                >
                                    <option value="">Select State</option>
                                    <option v-if="states.length" v-for="state in states" :key="state.id" :value="state.id" >{{ state.name }}</option>
                                </select>
                            </div>
                            <div>
                                <label
                                    for="city_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    City
                                </label>
                                <select
                                    v-model="form.city_id"
                                    id="city_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                    <option value="">Select city</option>
                                    <option v-if="cities.length" v-for="city in cities" :key="city.id" :value="city.id" >{{ city.name }}</option>
                                </select>
                            </div>
                            <div>
                                <label
                                    for="zip"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    Zip
                                </label>
                                <input
                                    type="text"
                                    v-model="form.zip"
                                    id="zip"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <div>
                                <label
                                    for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    Password
                                </label>
                                <input
                                    type="password"
                                    v-model="form.password"
                                    id="zip"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <div>
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="avatar"
                                >
                                    Avatar
                                </label>
                                <input
                                    type="file"
                                    @change="selectAvatar"
                                    class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="default_size"
                                >
                            </div>
                        </div>



                        <button
                            type="button"
                            @click="save"
                            class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                        >
                            Save
                        </button>



                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>