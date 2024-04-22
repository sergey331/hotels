import {createStore} from "vuex";
import register from "@/store/modules/register.js";

const store = createStore({
    modules: {
        register
    }
})

export default store;