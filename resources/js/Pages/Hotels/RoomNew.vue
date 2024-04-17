<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Header from "@/Components/Header.vue";
import {ref} from "vue";
import axios from "axios";
import {toast} from "vue3-toastify";

let form = ref({
    'price': '',
    'currency': '',
    'room_count': '',
    'number': '',
    'images': []
})

const onChangeRoomImage = (e) => {
    let images = e.target.files

    for (let i = 0; i < images.length; i++) {
        form.value.images.push(images[i])
    }
}

const save = () => {
    let formData = new FormData();
    let item = form.value
    formData.append('price', item.price)
    formData.append('room_count', item.room_count)
    formData.append('currency', item.currency)
    formData.append('number', item.number)

    if (item.images.length) {
        item.images.forEach(i => {
            if (i instanceof File) {
                formData.append('images[]', i)
            }
        })
    }


    axios.post(route('hotel.create_room_data'), formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(({data}) => {
            if (data.success) {
                toast.success('Room created successfully', {
                    position: toast.POSITION.TOP_CENTER,
                    pauseOnFocusLoss: false,
                });
                setTimeout(()=>{
                    window.location.href = '/hotel/rooms'
                },1500);
            }
        })
}
</script>

<template>
    <authenticated-layout>
        <Header>New Room</Header>
        <div class=" m-auto mt-8 bg-white p-5">
            <div class="max-w-md mx-auto">
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="text"
                        v-model="form.price"
                        id="price"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=""
                    />
                    <label for="price"
                           class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                    >
                        Price
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="text"
                        v-model="form.number"
                        id="number"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=""
                    />
                    <label for="number"
                           class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                    >
                        Number
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="currency" class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Select
                        currency</label>
                    <select
                        id="currency"
                        v-model="form.currency"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                        <option value="amd">amd</option>
                        <option value="usd">usd</option>
                        <option value="rub">rub</option>
                    </select>

                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="text"
                        v-model="form.room_count"
                        id="room_count"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" "
                    />
                    <label for="room_count"
                           class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                    >
                        Room count
                    </label>
                </div>


                <div class="max-w-lg mb-5 mx-auto">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="images">Images</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="images_help"
                        id="images"
                        type="file"
                        multiple
                        @change="onChangeRoomImage"
                    >
                </div>

                <button
                    type="button"
                    @click="save"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    Save
                </button>
            </div>

        </div>
    </authenticated-layout>
</template>

<style scoped>

</style>