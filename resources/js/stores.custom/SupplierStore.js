/**
 * (C) Kaloy (http://superloika.github.io)
 */

import axios from "axios";
import Vue from "vue";
import AppStore from "./AppStore";

const state = Vue.observable({
    suppliers: [],
});


const actions = {
    async initSuppliers() {
        console.log('initSuppliers() invoked');
        await axios.get(
            `${AppStore.state.siteUrl}suppliers`
        ).then(e=>{
            state.suppliers = e.data;
        });
    }
};


// actions.initSuppliers();


export default {
    state,
    ...actions
};
