import Vue from "vue";
import AppStore from "./AppStore";


const state = Vue.observable({
    teachers: [],
});


const actions = {
    async getTeachers() {
        let url = `${AppStore.state.siteUrl}teachers/getTeachers`;
        state.teachers = [];
        try {
            let response = await axios.get(url);
            state.teachers = response.data;
        } catch (error) {
            AppStore.toast(error, 2500,'error');
        }
    },

};


export default {
    state,
    ...actions
};
