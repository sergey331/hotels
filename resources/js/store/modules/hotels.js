const hotels = {
    namespace: true,
    state: () => ({
        form: {
            name: '',
            city: '',
            address: ''

        }
    }),
    actions: {
        async saveHotel({state}) {
            await axios.post('/hotels/store',state.form )
        }
    },
    getters: {
        getForm(state) {
            return state.form;
        }
    }
}

export default hotels