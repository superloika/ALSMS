/**
 * (C) Kaloy (http://superloika.github.io)
 */

import axios from "axios";
import Vue from "vue";
import AppStore from "./AppStore";

const state = Vue.observable({
    units: [],
});


const actions = {
    async initUnits() {
        console.log('initUnits() invoked');
        await axios.get(
            `${AppStore.state.siteUrl}units`
        ).then(e=>{
            state.units = e.data;
        });
    }
};


// actions.initUnits();


export default {
    state,
    ...actions
};
