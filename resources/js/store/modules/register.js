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
        },
        success: false
    }),
    mutations:  {
        setStep(state,step) {
            state.step = step
        },
        setGeneral(state,general) {
            state.general = general
        },
        setSuccess(state,success) {
            state.success = success
        }
    },
    actions: {

        async register({state,commit}) {
            let form = {
                'general': state.general,
                'address': state.address,
                'company': state.company
            }
            await axios.post('/register',form )
                .then(({data}) => {
                    if (data.success) {
                        commit('setSuccess',data.success)
                    }
                })
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
        },
        getSuccess(state) {
            return state.success
        }
    }
}

export default register