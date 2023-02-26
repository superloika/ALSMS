import Vue from "vue";

const host = `http://${window.location.host}/`;
// const localStorage = window.localStorage;

const state = Vue.observable({
    appName: 'ALSMS',
    appLongName: "ALS Management System",
    siteUrl: host,
    snackBar: {
        show: false,
        text: "",
        timeout: -1,
        color: 'secondary'
    },
    overlay: {
        show: false,
        msg: '',
    },
    errorBar: {
        show: true,
        msg: "Error"
    },
    guardMsgs: {
        accessDenied: "Access Denied",
    },
    showTopLoading: false,
    topLoadingCtr: 0,
    strDate: [new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10)],
    gLevels: ['K','G-1','G-2','G-3','G-4','G-5','G-6','G-7','G-8','G-9','G-10'],

    printMode: false,
});


const actions = {
    toast(text, timeout, color='secondary') {
        state.snackBar.show = true;
        state.snackBar.text = text;
        state.snackBar.timeout = timeout == null ? 3000 : timeout;
        state.snackBar.color = color;
    },

    overlay(show = true, text = "Loading...") {
        state.overlay.show = show;
        state.overlay.msg = text;
    },

    isSuperAdmin() {
        if(window.AuthUser.user_type == 'super_admin') {
            return true;
        }
        return false;
    },

    isAdmin() {
        if(window.AuthUser.user_type == 'admin') {
            return true;
        }
        return false;
    },

    isTeacher() {
        if(window.AuthUser.user_type == 'teacher') {
            return true;
        }
        return false;
    },

    isStudent() {
        if(window.AuthUser.user_type == 'student') {
            return true;
        }
        return false;
    },

    formatAsCurrency(number) {
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'PHP',
            // These options are needed to round to whole numbers if that's what you want.
            //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
            //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
        });

        return formatter.format(number).replace('php','').replace('₱','');
    },

    resetForm(obj) {
        let setAll = (obj, val) => Object.keys(obj).forEach(k => obj[k] = val);
        setAll(obj, "");
    },

    calculateAge(dob) {

        var diff_ms = Date.now() - new Date(dob).getTime();
        var age_dt = new Date(diff_ms);
        return Math.abs(age_dt.getUTCFullYear() - 1970);
    }

};

export default {
    state,
    // localStorage,
    ...actions
};
