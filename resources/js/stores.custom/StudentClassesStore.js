import Vue from "vue";
import AppStore from "./AppStore";


const state = Vue.observable({
    classes: [],
});


const actions = {
    async all(sy_id) {
        let url = `${AppStore.state.siteUrl}student/classes/all?sy_id=${sy_id}`;
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
