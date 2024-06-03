import {createStore} from "vuex";
import register from "@/store/modules/register.js";
import countries from "@/store/modules/countries.js";
import staff from "@/store/modules/staff.js";
const store = createStore({
    modules: {
        register,
        countries,
        staff
    }
})

export default store;