<template>
    <div>
        <v-row>
            <v-col cols="12" md="4" lg="3">
                <v-card color="primary" dark>
                    <v-card-title>Learning Programs</v-card-title>
                    <v-card-text>
                        <h1>{{ programsCount }}</h1>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" md="4" lg="3">
                <v-card color="primary" dark>
                    <v-card-title>Learning Centers</v-card-title>
                    <v-card-text>
                        <h1>{{ clcCount }}</h1>
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
        programsCount() {
            return this.ProgramsStore.state.programs.length;
        },
        clcCount() {
            return this.ClcStore.state.clcs.length;
        }
    },

    created() {
        this.ProgramsStore.getPrograms();
        this.ClcStore.getClcs();
    }
}
</script>
