import Vue from "vue";
import AppStore from "./AppStore";


const state = Vue.observable({
    classes: [],
    teacherClasses: [],
    classStudents: [],
    editClassDlg: null,
    editClassObj: {},
});


const actions = {
    async getClasses(sy_id) {
        AppStore.state.topLoadingCtr++;
        let url = `${AppStore.state.siteUrl}classes/getClasses?sy_id=${sy_id}`;
        state.classes = [];
        try {
            let response = await axios.get(url);
            state.classes = response.data;
        } catch (error) {
            AppStore.toast(error, 2500,'error');
        } finally {
            AppStore.state.topLoadingCtr--;
        }
    },

    async getTeacherClasses(sy_id, teacher_id) {
        AppStore.state.topLoadingCtr++;
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
        } finally {
            AppStore.state.topLoadingCtr--;
        }
    },

    async getClassStudents(class_id) {
        AppStore.state.topLoadingCtr++;
        let url = `${AppStore.state.siteUrl}teacher/classes/getClassStudents`;
        state.classStudents = [];
        try {
            let response = await axios.post(url,{
                class_id: class_id
            });
            state.classStudents = response.data;
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
