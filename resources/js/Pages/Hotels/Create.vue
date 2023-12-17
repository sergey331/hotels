<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Step1 from "@/Components/hotels/Step1.vue";
import Step2 from "@/Components/hotels/Step2.vue";
import Step3 from "@/Components/hotels/Step3.vue";
import {useStore} from "vuex";
import {computed, onMounted, ref} from "vue";

const store = useStore();
let step = computed({
    get() {
        return store.getters.getStep
    },
    set(next) {
        store.commit('setStep',next)
    }
})
// console.log(step.value += 1)

const nextStep = () => {
    step.value += 1
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="w-1/2 m-auto">
            <!-- start step indicators -->
            <div class="form-header flex gap-3 mb-4 text-xs text-center">
                <h1 class="stepIndicator flex-1 pb-8 relative">General info</h1>
                <h1 class="stepIndicator flex-1 pb-8 relative">Rooms</h1>
                <h1 class="stepIndicator flex-1 pb-8 relative">Services+</h1>
            </div>

            <div v-if="step === 1"  class="step-1" >
                <Step1/>
            </div>
            <div class="step-2" v-if="step === 2">
                <Step2/>
            </div>
            <div class="step-3" v-if="step === 3">
                <Step3/>
            </div>
            <div class="form-footer flex gap-3">
                <button
                    type="button"
                    class="flex-1 focus:outline-none border border-gray-300 py-2 px-5 rounded-lg shadow-sm text-center text-gray-700 bg-white hover:bg-gray-100 text-lg"
                >
                    Previous
                </button>
                <button
                    type="button"
                    @click="nextStep"
                    class="flex-1 border border-transparent focus:outline-none p-3 rounded-md text-center text-white bg-indigo-600 hover:bg-indigo-700 text-lg"
                >
                    Next
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>