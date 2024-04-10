<script setup>
import {onMounted, ref, watch} from "vue";
import axios from "axios";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Header from "@/Components/Header.vue";
import Dropdown from "@/Components/Dropdown.vue";

let columns = ref([
    "id",
    "price",
    "currency"
]);

const sortKey = ref('');
const sortOrder = ref('asc');

const sortBy = key => {
    if (sortKey.value === key) {
        sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc';
    } else {
        sortKey.value = key;
        sortOrder.value = 'asc';
    }
    getRooms()
}
let filters = ref({
    currency: '',
    search: ''
})
let rooms = ref([])

let page = ref(1);
let perPage = ref(10);
let totalPages = ref(0);
let total = ref(0);

const getRooms = () => {

    let params = {
        "page": page.value,
        "per_page": perPage.value,
        "search": filters.value.search,
        "currency": filters.value.currency
    }

    if (sortKey.value !== '') {
        let sortK = sortKey.value
        let s = {}
        s[sortK] = sortOrder.value
        params['sort'] = s
    }

    axios.get(`/hotel/get-room-data`, {
        'params': params
    })
        .then(({data}) => {
            if (data.success) {
                rooms.value = data.rooms
                page.value = data.pagination.current_page
                perPage.value = data.pagination.per_page
                totalPages.value = data.pagination.total_pages
                total.value = data.pagination.total
            }
        })
}


watch(page, (newValue, oldValue) => {
    getRooms();
});
watch(perPage, (newValue, oldValue) => {
    getRooms();
});

watch(filters.value, (newValue, oldValue) => {
    getRooms();
});


let currencies = ['amd', 'rub', 'usd'];

onMounted(() => {
    getRooms();
})

</script>

<template>
    <authenticated-layout>
        <Header>Rooms</Header>
        <div class=" m-auto mt-8  gap-6 bg-white p-5">
            <div class="border p-5">
                <div class=" m-auto mt-6 mb-6  flex justify-between">
                    <div class=" flex gap-4">
                        <input type="text" v-model="filters.search" class="form-control" placeholder="Search">

                        <select v-model="perPage">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <select v-model="filters.currency">
                            <option value="">Currency</option>
                            <option v-for="currency in currencies" :key="currency" :value="currency">{{
                                    currency
                                }}
                            </option>
                        </select>

                    </div>
                    <a href="/hotel/rooms/new">New</a>
                </div>

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th scope="col" class="px-6 py-3" v-for="(column,index) in columns" :key="index">
                            <button class="flex items-center" @click="sortBy(column)">
                                <span style="text-transform: uppercase">{{ column }}</span>
                                <i v-if="sortKey === column && sortOrder === 'asc'"
                                   class="ml-2 fa-solid fa-sort-up"></i>
                                <i v-if="sortKey === column && sortOrder === 'desc'"
                                   class="ml-2 fa-solid fa-sort-down"></i>
                            </button>
                        </th>
                        <th scope="col" class="px-6 py-3">Count</th>
                        <th scope="col" class="px-6 py-3">Image</th>
                        <th scope="col" class="px-6 py-3" align="center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        v-if="rooms.length"
                        v-for="room in rooms"
                        :key="room.id"
                    >
                        <td scope="col" class="px-6 py-3">{{ room.id }}</td>
                        <td scope="col" class="px-6 py-3">{{ room.price }}</td>
                        <td scope="col" class="px-6 py-3">{{ room.currency }}</td>
                        <td scope="col" class="px-6 py-3">{{ room.room_count }}</td>
                        <td scope="col" class="px-6 py-3">
                            <a href="#">
                                Count - {{ room.images.length }}
                            </a>
                        </td>
                        <td scope="col" class="px-6 py-3 relative">
                            <Dropdown class="inline" popper-class="w-64 bg-white border rounded-lg shadow-md">
                                <button class="dropdown-trigger inline-block px-6 py-3
                leading-tight
                rounded
                transition
                duration-150
                ease-in-out
"
                                        type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                         fill="currentColor" viewBox="0 0 16 3">
                                        <path
                                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                    </svg>
                                </button>

                                <template #popper="{ hide }">
                                    <ul class="py-1 text-gray-70">
                                        <li>
                                            <a href="#"
                                               class="block py-2 px-4 hover:bg-gray-100 focus:bg-gray-100 outline-none"
                                               @click="hide">Click me to close</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                               class="block py-2 px-4 hover:bg-gray-100 focus:bg-gray-100 outline-none">Menu
                                                item</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                               class="block py-2 px-4 hover:bg-gray-100 focus:bg-gray-100 outline-none">Another
                                                menu item</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                               class="block py-2 px-4 hover:bg-gray-100 focus:bg-gray-100 outline-none">Something
                                                else</a>
                                        </li>
                                    </ul>
                                </template>
                            </Dropdown>

                        </td>
                    </tr>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        v-else
                    >
                        <td colspan="6" align="center" class="px-6 py-4">No Rooms found</td>
                    </tr>
                    </tbody>
                </table>

                <div class="mt-6 flex justify-end">
                    <pagination
                        v-if="rooms.length"
                        v-model="page" :total-pages="totalPages" :slice-length="4" :showIcons="true" :per-page="perPage"
                        :total-items="total"
                    />
                </div>

            </div>
        </div>
    </authenticated-layout>
</template>

<style scoped>
.hidden {
    display: none !important;
}
</style>