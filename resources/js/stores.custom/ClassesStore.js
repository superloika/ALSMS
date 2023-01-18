import Vue from "vue";
import AppStore from "./AppStore";


const state = Vue.observable({
    classes: [],
    teacherClasses: [],
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

    async getTeacherClasses(sy_id, teacher_id) {
        let url = `${AppStore.state.siteUrl}teacher/classes/getTeacherClasses`;
        state.teacherClasses = [];
        try {
            let response = await axios.post(url,{
                sy_id: sy_id,
                teacher_id: teacher_id,
            });
            state.teacherClasses = response.data;
        } catch (error) {
            AppStore.toast(error, 2500,'error');
        }
    },

};


export default {
    state,
    ...actions
};
