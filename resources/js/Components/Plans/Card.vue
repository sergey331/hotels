<script setup>
import {router, useForm} from "@inertiajs/vue3";

let props = defineProps({
    plan: {
        type: Object
    }
})
const form = useForm({
    id: props.plan.id
})

const submit = () => {
    form.post(route('choose'))
}
</script>

<template>
    <div>
        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-4 text-xl font-medium text-gray-500 dark:text-gray-400">{{ plan.name }}</h5>
            <div class="flex items-baseline text-gray-900 dark:text-white mb-4">
                <span class="text-3xl font-semibold">$</span>
                <span class="text-5xl font-extrabold tracking-tight">{{ plan.price }}</span>
                <span class="ms-1 text-xl font-normal text-gray-500 dark:text-gray-400">/{{ plan.period }}</span>
            </div>
            <div class="mb-4">
                {{ plan.description }}
            </div>
            <form @submit.prevent="submit">

                <button
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">
                    Choose plan
                </button>
            </form>
        </div>

    </div>
</template>

<style scoped>

</style>