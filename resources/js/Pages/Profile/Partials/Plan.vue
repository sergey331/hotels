<script setup>
    import {usePage} from "@inertiajs/vue3";
    import Card from "@/Components/Plans/Card.vue";
    import moment from "moment";

    defineProps({
        plans: {
            type: Array
        },
        plan: {
            type: Object
        },
        message: {
            type: String
        }
    })
    const user = usePage().props.auth.user;
    const expired = moment(user.plan_expired).format('YYYY-MM-DD')
</script>

<template>
    <div class="w-full">
        <div class="mb-6">
            <h1 class="text-2xl mb-3">Plan</h1>
            <div>
                <h2>Current plan: {{ plan.name }}</h2>
                <h2>Current expired: {{ expired }}</h2>
            </div>
        </div>
        <hr class="w-full">
        <div class="mt-6">
            <div>
                <h2>Choose new plan</h2>
            </div>
            <div v-if="message" class="p-4 mb-4 text-md text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">{{ message }}</span>
            </div>
            <div class="flex gap-4">
                <template v-if="plans.length" v-for="plan in plans" :key="plan.id">
                    <Card :plan="plan"/>
                </template>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>