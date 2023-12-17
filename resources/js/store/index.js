import {createStore} from "vuex";
import hotels from "@/store/modules/hotels.js";


const store = createStore({
    modules: {
        hotels
    }
})

export default store;