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
        activeSchoolYear() {
            return this.SyStore.state.activeSY.sy;
        },
        classesCount() {
            return this.ClassesStore.state.teacherClasses.length;
        }
    },

    created() {
        this.ClassesStore.getTeacherClasses(
            this.SyStore.state.activeSY.id,
            this.AuthUser.teacher_id
        );
    }
}
</script>
