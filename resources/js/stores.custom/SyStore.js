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
        let url = `${AppStore.state.siteUrl}sys/getSchoolYears`;
        state.sys = [];
        try {
            let response = await axios.get(url);
            state.sys = response.data;
        } catch (error) {
            AppStore.toast(error, 2500,'error');
        }
    },

    async getActiveSchoolYear() {
        let url = `${AppStore.state.siteUrl}sys/getActiveSchoolYear`;
        try {
            let response = await axios.get(url);
            state.activeSY.id = response.data.id;
            state.activeSY.sy = response.data.sy;
        } catch (error) {
            AppStore.toast(error, 2500,'error');
        }
    },
};


export default {
    state,
    ...actions
};
