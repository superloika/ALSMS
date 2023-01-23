<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                Pending Enrollments
            </v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <v-data-table :headers="tableHeaders" :items="EnrollmentStore.state.enrollment_pending">
                <template v-slot:[`item.student_name`]="{item}">
                    <span>
                        {{ item.student_firstname }} {{ item.student_middlename }} {{ item.student_lastname }}
                    </span>
                </template>
                <template v-slot:[`item.teacher_name`]="{item}">
                    <span>
                        {{ item.teacher_firstname }} {{ item.teacher_middlename }} {{ item.teacher_lastname }}
                    </span>
                </template>
                <template v-slot:[`item.actions`]="{item}">
                    <div class="d-flex">
                        <v-btn iconx text small color="" class="ml-2" title="Review Student Details"
                            @click.stop="user_id=item.user_id;viewStudentDetailsDialog=true;"
                        >
                            <v-icon>mdi-eye</v-icon>
                        </v-btn>
                    </div>
                    <div class="d-flex">
                        <v-btn iconx text small color="primary" class="ml-2"
                            @click="confirm(item.id)" title="Approve"
                        >
                            <v-icon>mdi-check</v-icon>
                        </v-btn>
                    </div>
                </template>
            </v-data-table>
        </v-card-text>

        <v-dialog v-model="viewStudentDetailsDialog">
            <StudentProfile :key="user_id" :user_id="user_id"></StudentProfile>
        </v-dialog>
    </v-card>
</template>

<script>
export default {
    components: {
        StudentProfile: ()=>import('../../../Student/Profile')
    },

    data() {
        return {
            tableHeaders: [
                {text:"Student Name", value:"student_name"},
                {text:"Program", value:"program_title"},
                {text:"Teacher", value:"teacher_name"},
                {text:"CLC", value:"clc_name"},
                // {text:"CLC Address", value:"clc_address"},
                {text:"Actions", value:"actions"},
            ],
            drawer: null,
            viewStudentDetailsDialog: null,
            user_id: '',
        }
    },

    computed: {

    },

    methods: {
        async confirm(enrollment_id) {
            let url = `${this.AppStore.state.siteUrl}enrollment/confirm`;
            await axios.post(url,{
                    data: {
                        enrollment_id: enrollment_id,
                    }
                }).then(res=>{
                    this.EnrollmentStore.getEnrollments(this.SyStore.state.activeSY.id,'Pending');
                    this.EnrollmentStore.getEnrollments(this.SyStore.state.activeSY.id,'Approved');
                    this.AppStore.toast(res.data, 2500,'success');
                }).catch(e=>{
                    this.AppStore.toast(e, 2500,'error');
                })
                ;
        },

        // viewStudentDetails(user_id) {
        //     this.user_id = user_id;
        //     this.viewStudentDetailsDialog=true;
        // }
    },

    created() {

    },

    watch: {
        // user_id
    }
}
</script>
