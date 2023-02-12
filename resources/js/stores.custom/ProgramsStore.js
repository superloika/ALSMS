import Vue from "vue";
import AppStore from "./AppStore";


const state = Vue.observable({
    programs: [],
    editProgramDlg: null,
    editProgramObj: {}
});


const actions = {
    async getPrograms() {
        AppStore.state.topLoadingCtr++;
        let url = `${AppStore.state.siteUrl}learning-programs/getPrograms`;
        state.programs = [];
        try {
            let response = await axios.get(url);
            state.programs = response.data;
        } catch (error) {
            AppStore.toast(error, 2500,'error');
        } finally {
            AppStore.state.topLoadingCtr--;
        }
    },
};


export default {
    state,
    ...actions
};
