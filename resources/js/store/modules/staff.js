import {toast} from "vue3-toastify";

const staff = {
    namespace: true,
    state: () => ({
        staffSuccess: false,
        form: {
            first_name: '',
            last_name: '',
            phone: '',
            email: '',
            password: '',
            address: '',
            address1: '',
            country_id: '',
            state_id: '',
            city_id: '',
            zip: '',
            avatar: '',

        }
    }),
    mutations:  {
        setStaffSuccess(state, success) {
            state.staffSuccess = success
        }
    },
    actions: {
        async saveStaff({commit},staffData) {
            await axios.post(route('staffs.store'),staffData)
                .then(({data}) => {
                    if(!data) {
                        toast('Error accorded',{
                            type: 'error'
                        })
                    } else {
                        commit('setStaffSuccess',data)
                    }
                })
        }
    },
    getters: {
        getStaffForm(state) {
            return state.form
        },
        getStaffSuccess(state) {
            return state.staffSuccess
        }
    }
}

export default staff;