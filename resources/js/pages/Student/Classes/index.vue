<template>
    <div>
        <v-row>
            <v-col cols="12" md="3">
                <v-card>
                    <v-tabs vertical v-model="tabs">
                        <v-tab title="School Year" class="text-caption font-weight-bold">
                            Available
                        </v-tab>
                        <v-tab class="text-caption font-weight-bold">
                            Pending
                        </v-tab>
                        <v-tab title="Teachers" class="text-caption font-weight-bold">
                            Enrolled
                        </v-tab>
                    </v-tabs>
                </v-card>
            </v-col>
            <v-col cols="12" md="9">
                <v-card>
                    <v-tabs-items v-model="tabs" >
                        <v-tab-item>
                            <Available></Available>
                        </v-tab-item>
                        <v-tab-item>
                            <Requested></Requested>
                        </v-tab-item>
                        <v-tab-item>
                            <Enrolled></Enrolled>
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
        Available: ()=>import('./Available'),
        Enrolled: ()=>import('./Enrolled'),
        Requested: ()=>import('./Requested'),
    },
    data() {
        return {
            tabs: 0,
        }
    },

    created() {
        this.StudentClassesStore.all(this.SyStore.state.activeSY.id);
    },
}
</script>
