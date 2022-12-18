import Vue from "vue";
import AppStore from "./AppStore";


const state = Vue.observable({
    programs: []
});


const actions = {
    async getPrograms() {
        let url = `${AppStore.state.siteUrl}student/programs/getPrograms`;
        state.programs = [];
        try {
            let response = await axios.get(url);
            state.programs = response.data;
        } catch (error) {
            AppStore.toast(error, 2500,'error');
        }
    },
};


export default {
    state,
    ...actions
};
