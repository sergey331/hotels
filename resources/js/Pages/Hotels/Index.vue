<template>
    <Head title="Hotels" />
    <AuthenticatedLayout>
        <EditHotel />
        <div class=" m-auto mt-6 mb-6 flex justify-between " >
            <Header>Hotel - {{ hotel.name }}</Header>
            <SecondaryButton v-if="!editable" @click="editable = true">Edit</SecondaryButton>
            <div v-else class="flex gap-4">
                <SecondaryButton @click="editable = false">Cancel</SecondaryButton>
                <SecondaryButton @click = "save">Save</SecondaryButton>
            </div>
        </div>
        <div class=" m-auto mt-8 grid grid-cols-2 gap-6 bg-white p-5">
            <div  class="border p-5">
                <h4 class="mb-4">Rooms</h4>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" v-if="!editable">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">id</th>
                            <th scope="col" class="px-6 py-3">Price</th>
                            <th scope="col" class="px-6 py-3">Currency</th>
                            <th scope="col" class="px-6 py-3">Count</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        v-if="hotel.rooms.length"
                    >
                    </tr>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        v-else
                    >
                        <td colspan="4" align="center" class="px-6 py-4">No Rooms</td>
                    </tr>
                    </tbody>
                </table>

                <div v-else>
                    <SecondaryButton @click="addRoom">Add room</SecondaryButton>
                    <div v-if="hotel.rooms.length">
                        <div v-for="(room,index) in hotel.rooms" :key="index" class="mt-6">
                            <h5>Room</h5>
                            <div class="mb-3">
                                <input-label>Price</input-label>
                                <TextInput v-model="room.price" type="number"></TextInput>
                            </div>
                            <div class="mb-3">
                                <input-label>Currency</input-label>
                                <TextInput v-model="room.currency" ></TextInput>
                            </div>
                            <div class="mb-3">
                                <input-label>Count Room</input-label>
                                <TextInput v-model="room.room_count" type="number"></TextInput>
                            </div>
                            <div class="mb-3">
                                <input-label>Images</input-label>

                                <input
                                    type="file"
                                    multiple
                                    class="form-input"
                                    @change="onChangeRoomImage"
                                    :data-index="index"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="border p-5">
                <h4 class="mb-4">Service</h4>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" v-if="!editable">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">id</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3">Currency</th>
                        <th scope="col" class="px-6 py-3">Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        v-if="hotel.rooms.length"
                    >
                    </tr>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        v-else
                    >
                        <td colspan="4" align="center" class="px-6 py-4">No Rooms</td>
                    </tr>
                    </tbody>
                </table>
                <div v-else>
                    <SecondaryButton @click="addService">Add service</SecondaryButton>
                    <div v-if="hotel.services.length">
                        <div v-for="(service,index) in hotel.services" :key="index" class="mt-6">
                            <h5>Service</h5>
                            <div class="mb-3">
                                <input-label>Name</input-label>
                                <TextInput v-model="service.name" ></TextInput>
                            </div>
                            <div class="mb-3">
                                <input-label>Description</input-label>
                                <TextInput v-model="service.description" ></TextInput>
                            </div>
                            <div class="mb-3">
                                <input-label>Time</input-label>
                                <VueDatePicker v-model="service.time" :format="format"></VueDatePicker>
                            </div>
                            <div class="mb-3">
                                <input-label>Image</input-label>
                                <input
                                    type="file"
                                    class="form-input"
                                    @change="onChangeServiceImage"
                                    :data-index="index"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import EditHotel from "@/Components/hotels/EditHotel.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Header from "@/Components/Header.vue";
import {ref} from "vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import axios from "axios";

let props = defineProps({
    hotel: {
        default: Object
    }
})

let time = ref(new Date());

const addRoom = () => {
    let room = {
        id: null,
        price: 0,
        currency: '',
        room_count: 0,
        room_images: []
    }

    props.hotel.rooms.push(room)
}
const addService = () => {
    let service = {
        id: null,
        name: '',
        description: '',
        image: null,
        time: '',
    }

    props.hotel.services.push(service)
}

const editable = ref(false)
// const formattedDate = ref();
const format = (date) => {
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();
    const hour = date.getHours();
    const min = date.getMinutes();
    const sec = date.getSeconds();

    return `${year}-${month}-${day} ${hour}:${min}:${sec}`;
}

let isDragging = ref(false)

const onChangeRoomImage = (e) => {
    let index = e.target.getAttribute('data-index');
    let files = e.target.files;
    for (let i = 0; i < files.length;i++) {
        props.hotel.rooms[index].room_images.push(files[i])
    }
}

const onChangeServiceImage = e => {
    let index = e.target.getAttribute('data-index');
    let files = e.target.files;
    props.hotel.services[index].image  = files[0]
}

const save = () => {


    console.log('data',props.hotel)
    let formData = new FormData();

    props.hotel.rooms.forEach(item => {
        formData.append('rooms[id][]',item.id)
        formData.append('rooms[price][]',item.price)
        formData.append('rooms[room_count][]',item.room_count)
        formData.append('rooms[currency][]',item.currency)

       if (item.room_images !== undefined) {
           item.room_images.forEach(i => {
               formData.append('rooms[room_images][][]',i)
           })
       }

    })

    props.hotel.services.forEach(item => {
        formData.append('services[id][]',item.id)
        formData.append('services[name][]',item.name)
        formData.append('services[description][]',item.description)
        formData.append('services[image][]',item.image)
        formData.append('services[time][]',item.time)

    })

    axios.post(route('hotel.save'),formData,{
        headers: {
            'Content-Type' : 'multipart/form-data'
        }
    })
}
</script>

<style scoped>
    input {
        width: 100%;
    }
</style>