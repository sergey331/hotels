const countries = {
    namespace: true,
    state: () => ({
        countries: [],
        states: [],
        cities: [],
        statesCompany: [],
        citiesCompany: []
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
        setCompanyStates(state, states) {
            state.statesCompany = states
        },
        setCompanyCities(state, cities) {
            state.citiesCompany = cities
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
        },
        async getCompanyStates({commit},country_id) {
            await axios.get('/states/'+country_id)
                .then(({data}) => {
                    commit('setCompanyStates',data)
                })
        },
        async getCompanyCities({commit},state_id) {
            await axios.get('/cities/'+state_id)
                .then(({data}) => {
                    commit('setCompanyCities',data)
                })
        }
    },
    getters: {
        countries(state) {
            return state.countries;
        },
        states(state) {
            return state.states;
        },
        cities(state) {
            return state.cities;
        },
        statesCompany(state) {
            return state.statesCompany;
        },
        citiesCompany(state) {
            return state.citiesCompany;
        }
    }
}

export default countries