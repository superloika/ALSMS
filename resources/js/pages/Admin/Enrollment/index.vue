<template>
    <div>
        <v-row>
            <v-col cols="12" md="3">
                <v-card>
                    <v-tabs vertical v-model="tabs">
                        <v-tab title="School Year" class="text-caption font-weight-bold">
                            Pending
                        </v-tab>
                        <v-tab title="Teachers" class="text-caption font-weight-bold">
                            Approved
                        </v-tab>
                    </v-tabs>
                </v-card>
            </v-col>
            <v-col cols="12" md="9">
                <v-card>
                    <v-tabs-items v-model="tabs" >
                        <v-tab-item>
                            <Pending></Pending>
                        </v-tab-item>
                        <v-tab-item>
                            <Approved></Approved>
                        </v-tab-item>
                    </v-tabs-items>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    components: {
        Pending: ()=>import('./Pending'),
        Approved: ()=>import('./Approved'),
    },
    data() {
        return {
            tabs: 0,
        }
    },

    created() {
        this.EnrollmentStore.getEnrollments(this.SyStore.state.activeSY.id,'Pending');
        this.EnrollmentStore.getEnrollments(this.SyStore.state.activeSY.id,'Approved');
    }
}
</script>
