<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    type: '',
    first_name: '',
    last_name: '',
    phone: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <section class="gradient-form h-full ">
            <div class="container h-full p-10">
                <div
                    class="g-6 flex h-full flex-wrap items-center justify-center text-neutral-800 dark:text-neutral-200">
                    <div class="w-full">
                        <div
                            class="block rounded-lg bg-white shadow-lg dark:bg-neutral-800">
                            <div class="g-0 lg:flex lg:flex-wrap">
                                <!-- Left column container-->
                                <div class="px-4 md:px-0 lg:w-6/12">
                                    <div class="md:mx-6 md:p-12">
                                        <!--Logo-->
                                        <div class="text-center">
                                            <img
                                                class="mx-auto w-48"
                                                src="https://tecdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                                                alt="logo"/>
                                            <h4 class="mb-12 mt-1 pb-1 text-xl font-semibold">
                                                We are The Lotus Team
                                            </h4>
                                        </div>

                                        <form @submit.prevent="submit">
                                            <p class="mb-4">Please sign up to your account</p>

                                            <div class="relative mb-4" data-te-input-wrapper-init>
                                                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                                <select
                                                    id="type"
                                                    v-model="form.type"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                >
                                                    <option value="">Select Type</option>
                                                    <option value="creator">Creator</option>
                                                    <option value="employer">Employer</option>
                                                </select>

                                                <InputError class="mt-2" :message="form.errors.type"/>
                                            </div>
                                            <div class="relative mb-6" data-te-input-wrapper-init>
                                                <label
                                                    for="first_name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                >First name
                                                </label>
                                                <input
                                                    type="text"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    id="first_name"
                                                    placeholder="First name"
                                                    v-model="form.first_name"

                                                />
                                                <InputError class="mt-2" :message="form.errors.first_name"/>
                                            </div>
                                            <div class="relative mb-6" data-te-input-wrapper-init>
                                                <label
                                                    for="last_name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                >Last name
                                                </label>
                                                <input
                                                    type="text"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    id="last_name"
                                                    placeholder="First name"
                                                    v-model="form.last_name"

                                                />
                                                <InputError class="mt-2" :message="form.errors.last_name"/>
                                            </div>

                                            <div class="relative mb-6" data-te-input-wrapper-init>
                                                <label
                                                    for="phone"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                >Phone
                                                </label>
                                                <input
                                                    type="text"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    id="phone"
                                                    placeholder="Email"
                                                    v-model="form.phone"
                                                />
                                                <InputError class="mt-2" :message="form.errors.phone"/>
                                            </div>

                                            <div class="relative mb-6" data-te-input-wrapper-init>
                                                <label
                                                    for="exampleFormControlInput1"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                >Email
                                                </label>
                                                <input
                                                    type="text"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    id="exampleFormControlInput1"
                                                    placeholder="Email"
                                                    v-model="form.email"
                                                    required
                                                    autofocus
                                                />
                                                <InputError class="mt-2" :message="form.errors.email"/>
                                            </div>

                                            <!--Password input-->
                                            <div class="relative mb-6" data-te-input-wrapper-init>
                                                <label
                                                    for="password"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                >Password
                                                </label>
                                                <input
                                                    type="password"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    id="password"
                                                    placeholder="Password"
                                                    v-model="form.password"
                                                    required
                                                />
                                                <InputError class="mt-2" :message="form.errors.password"/>
                                            </div>

                                            <div class="relative mb-6" data-te-input-wrapper-init>
                                                <label
                                                    for="exampleFormControlInput11"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                >Confirm Password
                                                </label>
                                                <input
                                                    type="password"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    id="exampleFormControlInput11"
                                                    placeholder="Confirm Password"
                                                    v-model="form.password_confirmation"
                                                    required
                                                />
                                                <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                                            </div>

                                            <!--Submit button-->
                                            <div class="mb-12 pb-1 pt-1 text-center">
                                                <button
                                                    class="mb-3 inline-block w-full rounded px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_rgba(0,0,0,0.2)] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)] focus:outline-none focus:ring-0 active:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)]"
                                                    data-te-ripple-init
                                                    data-te-ripple-color="light"
                                                    style="
                                                    background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
                                                ">
                                                    Log in
                                                </button>

                                                <!--Forgot password link-->
                                                <Link v-if="canResetPassword"
                                                      :href="route('password.request')"
                                                >Forgot password?</Link>
                                            </div>

                                            <!--Register button-->
                                            <div class="flex items-center justify-between pb-6">
                                                <p class="mb-0 mr-2">You have an account?</p>
                                                <Link
                                                    :href="route('login')"
                                                    class="inline-block rounded border-2 border-danger px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-danger transition duration-150 ease-in-out hover:border-danger-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-danger-600 focus:border-danger-600 focus:text-danger-600 focus:outline-none focus:ring-0 active:border-danger-700 active:text-danger-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                                                    data-te-ripple-init
                                                    data-te-ripple-color="light">
                                                    Login
                                                </Link>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Right column container with background and description-->
                                <div
                                    class="flex items-center rounded-b-lg lg:w-6/12 lg:rounded-r-lg lg:rounded-bl-none"
                                    style="background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593)">
                                    <div class="px-4 py-6 text-white md:mx-6 md:p-12">
                                        <h4 class="mb-6 text-xl font-semibold">
                                            We are more than just a company
                                        </h4>
                                        <p class="text-sm">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing
                                            elit, sed do eiusmod tempor incididunt ut labore et
                                            dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exercitation ullamco laboris nisi ut aliquip ex
                                            ea commodo consequat.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>
