<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import Card from "@/Components/Plans/Card.vue";

defineProps({
    plans: {
        default: [],
    }
})
</script>

<template>
    <Head title="Chose plan"/>
    <AuthenticatedLayout>
        <section class="gradient-form h-full ">
            <div class="container  h-full p-10 mx-auto">
                <div
                    class="g-6 flex m-auto h-full flex-wrap items-center justify-center text-neutral-800 dark:text-neutral-200"
                    style="width: 75%"
                >
                    <div class="w-full bg-white p-14">
                        <h2 class="text-gray-500 text-4xl mb-6">Choose Plan</h2>
                        <div class="flex gap-4">
                            <template v-if="plans.length" v-for="plan in plans" :key="plan.id">
                                <Card :plan="plan"/>
                            </template>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>