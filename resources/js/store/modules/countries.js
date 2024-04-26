const countries = {
    namespace: true,
    state: () => ({
        countries: [],
        states: [],
        cities: []
    }),
    mutations: {
        setCountries(state, countries) {
            state.countries = countries
        },
        setStates(state, states) {
            state.states = states
        },
        setCities(state, cities) {
            state.cities = cities
        },
    },
    actions: {
        async getCountries({commit}) {
            await axios.get('/counties')
                .then(({data}) => {
                    commit('setCountries',data)
                })
        },
        async getStates({commit},country_id) {
            await axios.get('/states/'+country_id)
                .then(({data}) => {
                    commit('setStates',data)
                })
        },
        async getCities({commit},state_id) {
            await axios.get('/cities/'+state_id)
                .then(({data}) => {
                    commit('setCities',data)
                })
        }
    },
    getters: {
        countries(state) {
            return state.countries;
        }
    }
}

export default countries