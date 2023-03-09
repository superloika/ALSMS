import Vue from "vue";
import AppStore from "./AppStore";


const state = Vue.observable({
    enrollment_pending: [],
    enrollment_approved: [],
});


const actions = {
    async getEnrollments(sy_id,status) {
        AppStore.state.topLoadingCtr++;
        let url = `${AppStore.state.siteUrl}enrollment/getEnrollments?sy_id=${sy_id}&status=${status}`;
        try {
            let response = await axios.get(url);
            if(status=='Pending') {
                state.enrollment_pending = [];
                state.enrollment_pending = response.data;
            } else if(status=='Approved') {
                state.enrollment_approved = [];
                state.enrollment_approved = response.data;
            }
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
