import Vue from "vue";
import AppStore from "./AppStore";


const state = Vue.observable({
    sys: [],
    activeSY: {
        id: null,
        sy: ''
    },
});


const actions = {
    async getSchoolYears() {
        AppStore.state.topLoadingCtr++;
        let url = `${AppStore.state.siteUrl}sys/getSchoolYears`;
        state.sys = [];
        try {
            let response = await axios.get(url);
            state.sys = response.data;
        } catch (error) {
            AppStore.toast(error, 2500,'error');
        } finally {
            AppStore.state.topLoadingCtr--;
        }
    },

    async getActiveSchoolYear() {
        AppStore.state.topLoadingCtr++;
        let url = `${AppStore.state.siteUrl}sys/getActiveSchoolYear`;
        try {
            let response = await axios.get(url);
            state.activeSY.id = response.data.id;
            state.activeSY.sy = response.data.sy;
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
