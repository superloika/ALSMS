<template>
<v-sheet>
    <v-sheet v-if="AppStore.isStudent()">
        <DashboardStudent></DashboardStudent>
    </v-sheet>
    <v-sheet v-else>
        <DashboardAdmin></DashboardAdmin>
    </v-sheet>
</v-sheet>
</template>

<script>

export default {
    components: {
        DashboardAdmin: () => import('./DashboardAdmin.vue'),
        DashboardStudent: () => import('./DashboardStudent.vue')
    },

    data() {
        return {

        }
    },

    created() {
        // UnitStore.initUnits();
    },

    mounted() {
        console.log("DashboardPage component mounted.");
        console.log(this.AppStore.state.strDate);
    }
};
</script>
