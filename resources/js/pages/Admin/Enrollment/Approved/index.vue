<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                Approved Enrollments
            </v-toolbar-title>

            <v-spacer></v-spacer>
            <v-text-field
                solo-inverted
                rounded
                v-model="search"
                hide-details
                placeholder="Search student here"
                dense
                flat
                style="max-width:200px;"
            >
            </v-text-field>
        </v-toolbar>
        <v-card-text>
            <v-data-table :headers="tableHeaders" :items="EnrollmentStore.state.enrollment_approved"
                :search="search"
            >
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
                        <v-btn iconx small text color="primary" class="ml-2" title="View Details"
                            @click.stop="user_id=item.user_id;viewStudentDetailsDialog=true;"
                        >
                            <v-icon>mdi-eye</v-icon> View Details
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
                {text:"First Name", value:"student_firstname"},
                {text:"Middle Name", value:"student_middlename"},
                {text:"Last Name", value:"student_lastname"},
                {text:"Program", value:"program_title"},
                {text:"Teacher", value:"teacher_name"},
                {text:"CLC", value:"clc_name"},
                {text:"CLC Address", value:"clc_address"},
                {text:"Actions", value:"actions"},
            ],
            drawer: null,
            viewStudentDetailsDialog: null,
            user_id: '',
            search: ''
        }
    },

    computed: {

    },

    methods: {

    },

    created() {

    }
}
</script>
