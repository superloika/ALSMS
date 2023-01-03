import Vue from "vue";
import AppStore from "./AppStore";


const state = Vue.observable({
    classes: [],
});


const actions = {
    async getClasses(sy_id) {
        let url = `${AppStore.state.siteUrl}classes/getClasses?sy_id=${sy_id}`;
        state.classes = [];
        try {
            let response = await axios.get(url);
            state.classes = response.data;
        } catch (error) {
            AppStore.toast(error, 2500,'error');
        }
    },

};


export default {
    state,
    ...actions
};
