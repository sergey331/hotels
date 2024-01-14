<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import EditHotel from "@/Components/hotels/EditHotel.vue";

defineProps({
    hotel: {
        default: Object
    }
})
</script>

<template>
    <Head title="Hotels" />
    <AuthenticatedLayout>
        <EditHotel />
        <div class="mt-6 mb-6">
            <h1 class="text-center mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Hotel</span></h1>
        </div>
        <div class="w-3/4 m-auto mt-8 grid grid-cols-2 gap-6 bg-white p-5">
            <div  class="border p-5">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col"  class="px-6 py-3">Name</th>
                        <th scope="col"  class="px-6 py-3">City</th>
                        <th scope="col"  class="px-6 py-3">Address</th>
                        <th scope="col"  class="px-6 py-3">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ hotel.name }}</td>
                        <td class="px-6 py-4">{{ hotel.city }}</td>
                        <td class="px-6 py-4">{{ hotel.address }}</td>
                        <td class="px-6 py-4">
                            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                Toggle modal
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div  class="border p-5">
                sa
            </div>
            <div  class="border">
                sa
            </div>
            <div  class="border">
                sa
            </div>
            <div  class="border">
                sa
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>