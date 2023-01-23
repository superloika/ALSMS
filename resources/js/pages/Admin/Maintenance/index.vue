<template>
    <div>
        <v-row>
            <v-col cols="12" md="3">
                <v-card>
                    <v-tabs vertical v-model="tabs">
                        <v-tab title="School Year" class="text-caption font-weight-bold">
                            School Year
                        </v-tab>
                        <v-tab title="Teachers" class="text-caption font-weight-bold">
                            Teachers
                        </v-tab>
                        <v-tab class="text-caption font-weight-bold">
                            Learning Programs
                        </v-tab>
                        <v-tab class="text-caption font-weight-bold">
                            CLC
                        </v-tab>
                        <v-tab class="text-caption font-weight-bold">
                            Classes
                        </v-tab>
                    </v-tabs>
                </v-card>
            </v-col>
            <v-col cols="12" md="9">
                <v-card>
                    <v-tabs-items v-model="tabs" >
                        <v-tab-item>
                            <SchoolYear></SchoolYear>
                        </v-tab-item>
                        <v-tab-item>
                            <Teachers></Teachers>
                        </v-tab-item>
                        <v-tab-item>
                            <Programs></Programs>
                        </v-tab-item>
                        <v-tab-item>
                            <Clc></Clc>
                        </v-tab-item>
                        <v-tab-item>
                            <Classes></Classes>
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
        Teachers: ()=>import('./Teachers'),
        SchoolYear: ()=>import('./SchoolYear'),
        Programs: ()=>import('./Programs'),
        Clc: ()=>import('./Clc'),
        Classes: ()=>import('./Classes'),
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
