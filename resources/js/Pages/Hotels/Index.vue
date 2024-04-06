<template>
    <Head title="Hotels" />
    <AuthenticatedLayout>
        <EditHotel />
        <div class=" m-auto mt-6 mb-6 flex justify-between " >
            <Header>Hotel - {{ hotel?.name }}</Header>
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
                            <th scope="col" class="px-6 py-3">Image</th>
                            <th scope="col" class="px-6 py-3" colspan="2" align="center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        v-if="hotel?.rooms.length"
                        v-for="room in hotel.rooms"
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
                        <td scope="col" class="px-6 py-3">
                            <SecondaryButton>Discount</SecondaryButton>
                        </td>
                        <td scope="col" class="px-6 py-3">
                            <DangerButton>remove</DangerButton>
                        </td>
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
                    <SecondaryButton class="mb-3" @click="addRoom">Add room</SecondaryButton>
                    <custom-scrollbar :style="{ width: '98%', maxHeight: '600px' }">
                        <div v-for="(room,index) in hotel?.rooms" :key="index" class="mt-6">
                            <div class="flex justify-between">
                                <h1 class="mb-2">Room <b>{{ index + 1 }}</b></h1>
                                <SecondaryButton @click="removeRoom(index)">Remove room</SecondaryButton>
                            </div>
                            <div class="mb-3">
                                <input-label>Price</input-label>
                                <TextInput v-model="room.price" type="number"></TextInput>
                            </div>
                            <div class="mb-3">
                                <input-label>Currency</input-label>
                                <VueSelect v-model="room.currency" :options="['amd', 'rub', 'usd']"></VueSelect>
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
                    </custom-scrollbar>
                </div>
            </div>

            <div  class="border p-5">
                <h4 class="mb-4">Service</h4>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" v-if="!editable">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">id</th>
                        <th scope="col" class="px-6 py-3">name</th>
                        <th scope="col" class="px-6 py-3">description</th>
                        <th scope="col" class="px-6 py-3">image</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        v-if="hotel?.services.length"
                        v-for="service in hotel?.services"
                        :key="service.id"
                    >
                        <th scope="col" class="px-6 py-3">{{ service.id }}</th>
                        <th scope="col" class="px-6 py-3">{{ service.name }}</th>
                        <th scope="col" class="px-6 py-3">{{ service.description }}</th>
                        <th scope="col" class="px-6 py-3">
                            <img v-if="service.image" :src="service.image" width="100" height="100"  alt="1"/></th>
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
                    <custom-scrollbar :style="{ width: '98%', maxHeight: '600px' }">
                        <div v-for="(service,index) in hotel.services" :key="index" class="mt-6">
                            <div class="flex justify-between">
                                <h1 class="mb-2">Service <b>{{ index + 1 }}</b></h1>
                                <SecondaryButton @click="removeService(index)">Remove service</SecondaryButton>
                            </div>
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
                                <ejs-timepicker step="60" v-model="service.time"></ejs-timepicker>
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
                    </custom-scrollbar>
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
import {onMounted, ref} from "vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import axios from "axios";
import { TimePickerComponent as EjsTimepicker } from "@syncfusion/ej2-vue-calendars";
const hotel = ref(null)
import DangerButton from "@/Components/DangerButton.vue";
import {toast} from "vue3-toastify";

let time = ref(new Date());
const addRoom = () => {
    let room = {
        id: null,
        price: 0,
        currency: '',
        room_count: 0,
        images: []
    }

    hotel.value.rooms.push(room)
}
const removeRoom = i => {
    if (hotel.value.rooms.length <= 1) return;
    hotel.value.rooms = hotel.value.rooms.filter((item,index) => index !== i)
}

onMounted(() => {
    getRoom();
})
const addService = () => {
    let service = {
        id: null,
        name: '',
        description: '',
        image: null,
        time: '',
    }

    hotel.value.services.push(service)
}
const removeService = i => {
    if (hotel.value.services.length <= 1) return;
    hotel.value.services = hotel.value.services.filter((item,index) => index !== i)
}

const editable = ref(false)
const format = (date) => {

    const hour = date.getHours();
    const min = date.getMinutes();
    const sec = date.getSeconds();

    return `${hour}:${min}:${sec}`;
}

let isDragging = ref(false)

const onChangeRoomImage = (e) => {
    let index = e.target.getAttribute('data-index');
    let files = e.target.files;
    for (let i = 0; i < files.length;i++) {
        hotel.value.rooms[index].images.push(files[i])
    }
}

const onChangeServiceImage = e => {
    let index = e.target.getAttribute('data-index');
    let files = e.target.files;
    hotel.value.services[index].image = files[0]
}

const save = () => {
    let formData = new FormData();
    hotel.value.rooms.forEach((item, index) => {
        formData.append('rooms[' + index + '][id]', item.id)
        formData.append('rooms[' + index + '][price]', item.price)
        formData.append('rooms[' + index + '][room_count]', item.room_count)
        formData.append('rooms[' + index + '][currency]', item.currency)

       if (item.images !== undefined) {
           item.images.forEach(i => {
               if (i instanceof File){
                   formData.append('rooms[' + index + '][images][]', i)
               }
           })
       }

    })

    hotel.value.services.forEach((item, index) => {

        formData.append('services[' + index + '][id]', item.id)
        formData.append('services[' + index + '][name]', item.name)
        formData.append('services[' + index + '][description]', item.description)
        if (item.image  instanceof File) {
            formData.append('services[' + index + '][image]', item.image)
        }
        formData.append('services[' + index + '][time]', item.time)

    })

    axios.post(route('hotel.save'),formData,{
        headers: {
            'Content-Type' : 'multipart/form-data'
        }
    })
        .then(({data}) => {
            if (data.status) {
                toast.success(data.message,{
                    position: toast.POSITION.TOP_CENTER,
                    pauseOnFocusLoss: false,
                });
                getRoom();
                editable.value = false;

            }
        })
}
</script>

<style scoped>
    input {
        width: 100%;
    }

    .he {
        max-height: 600px;
        overflow-y: scroll;
    }
</style>