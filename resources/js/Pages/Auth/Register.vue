<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {useStore} from "vuex";
import {computed, ref, watch} from "vue";
import General from "@/Components/register/General.vue";
import Address from "@/Components/register/Address.vue";
import Company from "@/Components/register/Company.vue";
import Finish from "@/Components/register/Finish.vue";

let store = useStore();

let register = () => {
    store.dispatch('register')
}

let success = computed(() => store.getters.getSuccess)
watch(
    () => success.value,
    () => {
        if (success.value) {
            window.location.href = '/login'
        }
    }
);
const step = computed(() => store.getters.getStep);
const next = id => {
    store.commit('setStep', id)
}
let steps = ref([
    {
        component: General
    },
    {
        component: Address
    },
    {
        component: Company
    },
    {
        component: Finish
    }
])

let st = ref([
    {
        id: 0,
        number: 1,
        name: 'General',
    },
    {
        id: 1,
        number: 2,
        name: 'Address',
    },
    {
        id: 2,
        number: 3,
        name: 'Company',
    }
])
</script>

<template>
    <GuestLayout>
        <div class="login_container"></div>
        <div class="p-12   mx-auto  mb-8 mt-14">
            <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                <li
                    v-for="s in st"
                    :key="s.id"
                    :class="{'text-blue-600 dark:text-blue-500': step === s.id}"
                    class="flex md:w-full items-center sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span
                        class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <svg
                            v-if="step === s.id"
                            class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span v-else class="me-2">{{ s.number }}</span>
                        <span class="hidden sm:inline-flex sm:ms-2">{{ s.name }}</span>
                    </span>
                </li>
                <li class="flex md:w-full items-center">
                    <span class="me-2">4</span>
                    <span class="hidden sm:inline-flex sm:ms-2">Finish</span>

                </li>

            </ol>

            <component
                v-bind:is="steps[step].component"
                @next="next"
                @register="register"
            />
        </div>

    </GuestLayout>
</template>


<style scoped>
.login_container {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: url('/images/login.gif') no-repeat;
    background-size: 100% 100%;
    z-index: -1;
}
</style>