<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
defineProps(
    {
        staffs: {
            default: []
        }
    }
)

</script>

<template>
    <Head title="Staff" />

    <AuthenticatedLayout>
        <div class="py-12">

            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <div class="flex mb-6 justify-between items-center">
                            <h2>Staff</h2>
                            <a :href="route('staffs.create')" class="text-amber-900 hover:text-gray-500 border-2 p-1 px-3">New staff user</a>
                        </div>
                        <hr>
                        <div class="mt-6">


                            <div class="relative overflow-x-auto">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            First name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Last name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Phone
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Address
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Address 1
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Country
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            State
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            City
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Zip
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr
                                        v-if="staffs.length"
                                        v-for="staff in staffs"
                                        :key="staff.id"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                    >

                                        <td class="px-6 py-4">
                                            {{ staff.id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ staff.first_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ staff.last_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ staff.phone }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ staff.email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ staff.address }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ staff.address1 }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ staff.country.name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ staff.state.name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ staff.city.name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ staff.zip }}
                                        </td>

                                    </tr>
                                    <tr
                                        v-else
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                    >
                                        <th
                                            colspan="10"
                                            align="center"
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            No staff
                                        </th>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>