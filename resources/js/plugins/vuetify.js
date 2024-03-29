// src/plugins/vuetify.js

import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";

Vue.use(Vuetify);

const opts = {
    theme: {
        light: true,
        // dark: true,
        variations: false,

        themes: {
            light: {
                error: '#FF5252',
                info: '#2196F3',
                success: '#4CAF50',
                primary: '#2196F3',
                // primary: '#ed532d',
                // warning: "#FF5722",
                // accent: "#7dd663",
            },
        }
    }
};

export default new Vuetify(opts);
