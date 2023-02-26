import Vue from "vue";
import AppStore from "./AppStore";


const state = Vue.observable({
    announcements: [],
});


const actions = {
    async getAnnouncements(class_id) {
        AppStore.state.topLoadingCtr++;
        let url = `${AppStore.state.siteUrl}announcements/getAnnouncements?class_id=${class_id}`;
        state.announcements = [];
        try {
            let response = await axios.get(url);
            state.announcements = response.data;
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
