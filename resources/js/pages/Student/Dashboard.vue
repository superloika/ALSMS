<template>
    <div>
        <v-row>
            <v-col cols="12" md="4" lg="3">
                <v-card color="info" dark>
                    <v-card-title>Active School Year</v-card-title>
                    <v-card-text>
                        <h1>{{ activeSchoolYear }}</h1>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" md="4" lg="3" xl="2">
                <v-card color="info" dark>
                    <v-card-title>
                        Enrolled Program
                    </v-card-title>
                    <v-card-text>
                        <h1>
                            0
                        </h1>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" md="4" lg="3" xl="2">
                <v-card color="primary" dark>
                    <v-card-title>
                        Programs Completed
                    </v-card-title>
                    <v-card-text>
                        <h1>
                            0
                        </h1>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" md="4" lg="3" xl="2">
                <v-card color="warning" dark>
                    <v-card-title>
                        Pending Application
                    </v-card-title>
                    <v-card-text>
                        <h1>
                            0
                        </h1>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>


<script>
export default {
    data() {
        return {

        }
    },

    computed: {
        activeSchoolYear() {
            return this.SyStore.state.activeSY.sy;
        }
    },
}
</script>
