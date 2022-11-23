<template>
<div class="text-h6 pa-4">Admin Dashboard</div>
</template>

<script>

export default {
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
