<script setup>
    import {ref} from "vue";
    const props = defineProps({
        plan_expired: {
            default: ''
        }
    })
    let appendDate = ref('')
    let interval = ref(null)
    const getExpiryCounter = () => {
        let timer = new Date(props.plan_expired).getTime() - new Date().getTime();
        let day = timer / 1000 / 60 / 60 / 24;
        let hour = (day % 1) * 24;
        let min = (hour % 1) * 60;
        let sec = (min % 1) * 60;
        if (timer < 0){
            appendDate.value = 'Plan expired'
            clearInterval(interval.value)
        } else {
            appendDate.value = 'Plan Expired in ' +  Math.floor(day) + 'D ' + Math.floor(hour) + ':' + Math.floor(min) + ':' + Math.floor(sec) + ''
        }
    }
    interval.value = setInterval(function() {
        getExpiryCounter();
    }, 1000)
</script>

<template>
    <div class="text-gray-500 font-bold text-sm">
        {{ appendDate }}
    </div>
</template>

<style scoped>

</style>