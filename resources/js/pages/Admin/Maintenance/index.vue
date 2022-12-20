<template>
    <div>
        <v-row>
            <v-col cols="12" md="3">
                <v-card>
                    <v-tabs vertical v-model="tabs">
                        <v-tab>
                            Programs
                        </v-tab>
                        <v-tab title="Community Learning Centers">
                            CLC
                        </v-tab>
                        <v-tab>
                            LARAVEL
                        </v-tab>
                    </v-tabs>
                </v-card>
            </v-col>
            <v-col cols="12" md="9">
                <v-tabs-items v-model="tabs" >
                    <v-tab-item>
                        <Programs></Programs>
                    </v-tab-item>
                    <v-tab-item>
                        <Clc></Clc>
                    </v-tab-item>
                </v-tabs-items>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    components: {
        Programs: ()=>import('./Programs'),
        Clc: ()=>import('./Clc'),
    },
    data() {
        return {
            tabs: 0,
        }
    }
}
</script>
