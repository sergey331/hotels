<template>
    <AuthenticatedLayout>
        <div class="w-1/2 m-auto">
            <div v-if="errorMessage !== ''"
                 class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative flex gap-4"
                 role="alert">
                <strong class="font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                    </svg>
                </strong>
                <span class="block sm:inline uppercase">{{ errorMessage }}</span>
            </div>

            <div>
                <p class="text-md text-gray-700 leading-tight text-center mt-8 mb-5">New hotel</p>
                <div class="mb-6">
                    <input
                        type="text"
                        v-model="form.name"
                        placeholder="Name"
                        class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
                    />
                </div>
                <div class="mb-6">
                    <input type="text"
                           v-model="form.city"
                           placeholder="City"
                           class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
                    />
                </div>
                <div class="mb-6">
                    <input
                        type="text"
                        v-model="form.address"
                        placeholder="Address"
                        class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"
                    />
                </div>
            </div>
            <div class="form-footer flex gap-3">

                <button
                    type="button"
                    @click="save"
                    class="flex-1 border border-transparent focus:outline-none p-3 rounded-md text-center text-white bg-indigo-600 hover:bg-indigo-700 text-lg"
                >
                    Save
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useStore} from "vuex";
import {computed, onMounted, ref} from "vue";

const store = useStore();


let errorMessage = ref('');
let form = computed(() => {
    return store.getters.getForm
})

const save = () => {
    let valid = true;
    errorMessage.value = '';

    let valid_form = validateForm();
    if (!valid_form) {
        valid = false;
        errorMessage.value = 'fill all required fields'
    }

    if (!valid) return false;

    store.dispatch('saveHotel')
}

const validateForm = () => {
    let f = form.value
    if (f.name === '' || f.city === '' || f.address === '') return false;
    return true;
}

</script>
<style scoped>

</style>