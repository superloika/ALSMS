<template>
    <div>
        <v-row>
            <v-col cols="12" md="3" v-if="!AppStore.state.printMode">
                <v-card>
                    <v-tabs vertical v-model="tabs">
                        <v-tab title="List of Students" class="text-caption font-weight-bold">
                            List of Students
                        </v-tab>
                    </v-tabs>
                </v-card>
            </v-col>
            <v-col cols="12" md="9">
                <v-card>
                    <v-tabs-items v-model="tabs" >
                        <v-tab-item>
                            <Students></Students>
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
        Students: ()=>import('./Students'),

    },

    data() {
        return {
            tabs: 0,
        }
    },

    created() {
        this.ClassesStore.getClasses(this.SyStore.state.activeSY.id);
        this.ClcStore.getClcs();
    }
}
</script>
