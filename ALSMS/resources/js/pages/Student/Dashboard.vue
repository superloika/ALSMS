<template>
    <div>
        <v-row>
            <v-col cols="12" md="4" lg="3">
                <v-card color="success" dark>
                    <v-card-title>Active School Year</v-card-title>
                    <v-card-text>
                        <h1>{{ activeSchoolYear }}</h1>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" md="4" lg="3" xl="2">
                <v-card color="info" dark>
                    <v-card-title>
                        Enrolled Class
                    </v-card-title>
                    <v-card-text>
                        <h1>
                            {{ enrolledProgramsCount }}
                        </h1>
                    </v-card-text>
                </v-card>
            </v-col>
            <!-- <v-col cols="12" md="4" lg="3" xl="2">
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
            </v-col> -->
            <!-- <v-col cols="12" md="4" lg="3" xl="2">
                <v-card color="warning" dark>
                    <v-card-title>
                        Pending Application
                    </v-card-title>
                    <v-card-text>
                        <h1>
                            {{ pendingApplicationsCount }}
                        </h1>
                    </v-card-text>
                </v-card>
            </v-col> -->
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
        enrolledProgramsCount() {
            try {
                return this.StudentClassesStore.state.classes.filter((e)=>{
                    return e.user_id==this.AuthUser.id && e.status=='Approved';
                }).length;
            } catch (error) {
                return 0;
            }
        },
        // pendingApplicationsCount() {
        //     try {
        //         return this.StudentClassesStore.state.classes.filter((e)=>{
        //             return e.user_id==this.AuthUser.id && e.status=='Pending';
        //         }).length;
        //     } catch (error) {
        //         return 0;
        //     }
        // },

    },

    created() {
        // this.StudentClassesStore.all(this.SyStore.state.activeSY.id);
        this.StudentClassesStore.studentEnrollment(this.SyStore.state.activeSY.id);
        // this.$router.push('/teacher/classes');
    }
}
</script>
