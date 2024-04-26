<script setup>
import Datepicker from 'flowbite-datepicker/Datepicker';

import {computed, onMounted, watch} from "vue";
import {useStore} from "vuex";
import {toast} from "vue3-toastify";

let store = useStore();

const emit = defineEmits()

let general = computed(() => store.getters.getGeneral)

watch(general.value, () => {
    store.commit('setGeneral', general.value)
})
const next = () => {
    let validate = validateGeneral();
    if (validate) {
        emit('next', 1)
    } else {
        toast('Error accorded',{
            type: 'error'
        })
    }
}


const validateGeneral = () => {
    // let data = general.value
    let valid = true;
    // if (data.first_name === '' || data.first_name === null || data.last_name === '' || data.last_name === null || data.password === '' || data.password === null) {
    //     valid = false;
    // }
    // let validEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/.test(data.email)
    // if (!validEmail) {
    //     valid = false;
    // }
    return valid;
}
onMounted(() => {
    const datepickerElement = document.getElementById('datepicker');
    new Datepicker(datepickerElement, {
        format: 'yyyy-mm-dd'
    });
})
</script>

<template>
    <div style="width: 70%;margin: 40px auto;">
        <div class="mb-5">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                name</label>
            <input type="text" v-model="general.first_name" id="first_name"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>
        <div class="mb-5">
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                name</label>
            <input type="text" v-model="general.last_name" id="last_name"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
            <input type="email" v-model="general.email" id="email"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>
        <div class="mb-5">
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
            <input type="text" v-model="general.phone" id="phone"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>
        <div class="mb-5">
            <div class="relative max-w-sm">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input
                    id="datepicker"
                    type="text"
                    v-model="general.dob"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Select date of births">
            </div>
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >Password</label>
            <input type="password" v-model="general.password" id="password" placeholder="••••••••"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>
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