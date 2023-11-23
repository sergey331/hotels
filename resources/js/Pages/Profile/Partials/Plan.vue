<script setup>
    import {usePage} from "@inertiajs/vue3";
    import Card from "@/Components/Plans/Card.vue";
    import moment from "moment";

    defineProps({
        plans: {
            type: Array
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
                <h2>Current plan: {{ user.plan.name }}</h2>
                <h2>Current expired: {{ expired }}</h2>
            </div>
        </div>
        <hr class="w-full">
        <div class="mt-6">
            <div>
                <h2>Choose new plan</h2>
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