<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const token = document.head.querySelector('meta[name="csrf-token"]').content;
</script>

<template>
    <GuestLayout>
        <div class="login_container"></div>

        <div class="w-1/4 p-6 border-2 " style="margin-top: 200px">
            <h2>Login</h2>
            <div class="mt-2">
                <form :action="route('login.store')" method="post">
                    <input type="hidden" name="_token" :value="token" />
                    <div class="mt-2">
                        <label for="email"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="text" name="email" id="email"
                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    </div>
                    <div class="mt-2">
                        <label for="password"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password"
                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>


<style scoped>
.login_container {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: url('/images/login.gif') no-repeat;
    background-size: 100% 100%;
    z-index: -1;
}
</style>