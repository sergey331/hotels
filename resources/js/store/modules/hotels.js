const hotels = {
    namespace: true,
    state: () => ({
        step: 1,
        form: {

        },
        errors: {

        }
    }),
    mutations: {
        setStep(state,step) {
            state.step = step
        }
    },
    actions: {

    },
    getters: {
        getStep(state) {
            return state.step
        }
    }
}

export default hotels