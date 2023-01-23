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
            <v-col cols="12" md="4" lg="3">
                <v-card color="info" dark>
                    <v-card-title>Learning Centers</v-card-title>
                    <v-card-text>
                        <h1>{{ clcCount }}</h1>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" md="4" lg="3">
                <v-card color="info" dark>
                    <v-card-title>Teachers</v-card-title>
                    <v-card-text>
                        <h1>{{ teacherCount }}</h1>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" md="4" lg="3">
                <v-card color="info" dark>
                    <v-card-title>Learning Programs</v-card-title>
                    <v-card-text>
                        <h1>{{ programsCount }}</h1>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" md="4" lg="3">
                <v-card color="primary" dark>
                    <v-card-title>Classes</v-card-title>
                    <v-card-text>
                        <h1>{{ classesCount }}</h1>
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
        activeSchoolYear() {
            return this.SyStore.state.activeSY.sy;
        },
        classesCount() {
            return this.ClassesStore.state.classes.length;
        },
        clcCount() {
            return this.ClcStore.state.clcs.length;
        },
        teacherCount() {
            return this.TeachersStore.state.teachers.length;
        },
    },

    created() {

    }
}
</script>
