<script setup>
import {onMounted, ref, watch} from "vue";
import axios from "axios";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Header from "@/Components/Header.vue";
import DropdownMenu from 'v-dropdown-menu'
import 'v-dropdown-menu/css'
import {toast} from "vue3-toastify";
let columns = ref([
    "id",
    "price",
    "currency",
    "number"
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


watch(page, () => {
    getRooms();
});
watch(perPage, () => {
    getRooms();
});

watch(filters.value, () => {
    getRooms();
});


let currencies = ['amd', 'rub', 'usd'];

onMounted(() => {
    getRooms();
})

const deleteRoom = id => {
   axios.delete(route('hotel.delete_room_data',id))
       .then(({data}) => {
           if (data.success) {
               getRooms();
               toast.success('Room deleted successfully', {
                   position: toast.POSITION.TOP_CENTER,
                   pauseOnFocusLoss: false,
               });
           }
       })
}

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
                        <th scope="col" class="px-6 py-3" >Action</th>
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
                        <td scope="col" class="px-6 py-3">{{ room.number }}</td>
                        <td scope="col" class="px-6 py-3">{{ room.room_count }}</td>
                        <td scope="col" class="px-6 py-3">
                            <a href="#">
                                Count - {{ room.images.length }}
                            </a>
                        </td>
                        <td scope="col" class="px-6 py-3 relative">
                            <dropdown-menu>
                                <template #trigger>
                                    <svg class="w-5 h-5" aria-hidden="true" style="cursor:pointer" xmlns="http://www.w3.org/2000/svg"
                                         fill="currentColor" viewBox="0 0 16 3">
                                        <path
                                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"
                                        />
                                    </svg>
                                </template>

                                <template #body>
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                        <li>
                                            <a
                                                :href="route('hotel.edit_room',room.id)"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            >
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-red-800 text-red-800"
                                                @click="deleteRoom(room.id)"
                                            >
                                                Delete
                                            </a>
                                        </li>
                                    </ul>
                                </template>
                            </dropdown-menu>
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