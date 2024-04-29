const register = {
    namespace: true,
    state: () => ({
        step: 0,
        general: {
            first_name: null,
            last_name: null,
            phone: null,
            email: null,
            password: null,
            dob: null,
        },
        address: {
            address: null,
            address1: null,
            country_id: null,
            state_id: null,
            city_id: null,
            zip: null,
        },
        company: {
            company_name: null,
            phone: null,
            email: null,
            address: null,
            address1: null,
            country_id: null,
            state_id: null,
            city_id: null,
            zip: null,
        }
    }),
    mutations:  {
        setStep(state,step) {
            state.step = step
        },
        setGeneral(state,general) {
            state.general = general
        }
    },
    actions: {
        async register({state}) {
            await axios.post('/hotel/store',state.form )
        }
    },
    getters: {
        getStep(state) {
            return state.step;
        },
        getGeneral(state) {
            return state.general
        },
        getAddress(state) {
            return state.address
        },
        getCompany(state) {
            return state.company
        }
    }
}

export default register