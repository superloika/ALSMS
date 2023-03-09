<template>
    <v-app>

        <v-container class="" fluid>

            <component v-bind:is="userTypeComponent"></component>

        </v-container>

        <!-- MISC -->
        <v-snackbar
            v-model="AppStore.state.snackBar.show"
            :timeout="AppStore.state.snackBar.timeout"
            bottom
            center
            :color="AppStore.state.snackBar.color"
        >
            {{ AppStore.state.snackBar.text }}
        </v-snackbar>

        <v-overlay
            :value="AppStore.state.overlay.show"
            z-index="999999"
            opacity="0.2"
        >
            <v-chip>
                <v-progress-circular
                    :value="64"
                    indeterminate
                    size="20"
                ></v-progress-circular>
                &nbsp;
                {{ AppStore.state.overlay.msg }}
            </v-chip>
        </v-overlay>
    </v-app>
</template>

<script>

export default {
    computed: {
        userTypeComponent() {
            if(this.AppStore.isAdmin() || this.AppStore.isSuperAdmin()) {
                return () => import('../pages/Admin/Base.vue');
            } else if(this.AppStore.isStudent()) {
                return () => import('../pages/Student/Base.vue');
            } else if(this.AppStore.isTeacher()) {
                return () => import('../pages/Teacher/Base.vue');
            }
        }
    },

    created() {
        this.SyStore.getActiveSchoolYear();
        this.SyStore.getSchoolYears();
        this.ProgramsStore.getPrograms();
        this.TeachersStore.getTeachers();
        this.ClcStore.getClcs();
    },

    mounted() {
        console.log("BaseComponent mounted");
    }
};
</script>

<style>
.search-field {
    border: 1px solid #f1f1f1;
}

/* .v-data-table__wrapper table tbody tr{

    } */
.v-data-table__wrapper table tbody tr td.text-start {
    /* color: #222222; */
    /* font-size: 12px; */
}

.theme--dark.v-data-table
    > .v-data-table__wrapper
    > table
    > tbody
    > tr:hover:not(.v-data-table__expanded__content):not(.v-data-table__empty-wrapper) {
    background-color: #000000;
}

div.v-tab {
    padding: 0px 5px;
}

.theme--light.v-text-field--filled > .v-input__control > .v-input__slot {
    background: #f7f7f7;
    /* border: 1px solid rgba(0, 0, 0, 0.38); */
    /* border-bottom-left-radius: 4px; */
    /* border-bottom-right-radius: 4px; */

    &:before {
        display: none;
    }
}

/* .v-input--is-focused .v-input__slot {
    border: 2px solid #00cca0 !important;
    border-bottom-color: rgba(0, 0, 0, 0.38) !important;
} */
</style>
