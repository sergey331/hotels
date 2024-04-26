import {createStore} from "vuex";
import register from "@/store/modules/register.js";
import countries from "@/store/modules/countries.js";
const store = createStore({
    modules: {
        register,
        countries
    }
})

export default store;