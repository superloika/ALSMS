import Vue from "vue";
import AppStore from "./AppStore";


const state = Vue.observable({
    clcs: []
});


const actions = {
    async getClcs() {
        let url = `${AppStore.state.siteUrl}clc/getClcs`;
        state.clcs = [];
        try {
            let response = await axios.get(url);
            state.clcs = response.data;
        } catch (error) {
            AppStore.toast(error, 2500,'error');
        }
    },
};


export default {
    state,
    ...actions
};
