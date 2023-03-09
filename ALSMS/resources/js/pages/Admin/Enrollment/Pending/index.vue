<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                Pending Enrollments
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
            <v-data-table :headers="tableHeaders" :items="EnrollmentStore.state.enrollment_pending"
                :search="search"
            >
                <template v-slot:[`item.actions`]="{item}">
                    <v-btn iconx text small color="primary" class="ml-2" title="Review Student Details"
                        @click.stop="user_id=item.user_id;enrollment_id=item.id;viewStudentDetailsDialog=true;"
                    >
                        <v-icon>mdi-eye</v-icon> View
                    </v-btn>
                </template>
            </v-data-table>
        </v-card-text>

        <v-dialog v-model="viewStudentDetailsDialog">
            <v-sheet class="pa-2">
                <StudentProfile :key="user_id" :user_id="user_id"></StudentProfile>
                <v-card class="mt-4">
                    <v-card-title>
                        Enrollment Approval
                    </v-card-title>
                    <v-card-text>
                        <v-select
                            label="Class to assign"
                            :items="classes"
                            item-value="id"
                            v-model="class_id"
                            filled
                        >
                            <template slot="selection" slot-scope="data">
                                {{ data.item.program_title }} | {{ data.item.clc_name }} |
                                {{ data.item.firstname }} {{ data.item.middlename }} {{ data.item.lastname }}
                            </template>
                            <template slot="item" slot-scope="data">
                                {{ data.item.program_title }} | {{ data.item.clc_name }} |
                                {{ data.item.firstname }} {{ data.item.middlename }} {{ data.item.lastname }}
                            </template>
                        </v-select>
                        <v-btn :disabled="class_id=='' || class_id==null" color="success"
                            @click="confirm()"
                        >
                            Approve
                        </v-btn>
                    </v-card-text>
                </v-card>

            </v-sheet>


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
                // {text:"CLC Address", value:"clc_address"},
                {text:"Actions", value:"actions"},
            ],
            drawer: null,
            viewStudentDetailsDialog: null,
            user_id: '',
            class_id: '',
            enrollment_id: '',
            search: ''
        }
    },

    computed: {
        classes() {
            return this.ClassesStore.state.classes;
        },
    },

    methods: {
        async confirm() {
            let url = `${this.AppStore.state.siteUrl}enrollment/confirm`;
            await axios.post(url,{
                    data: {
                        enrollment_id: this.enrollment_id,
                        class_id: this.class_id,
                    }
                }).then(res=>{
                    this.EnrollmentStore.getEnrollments(this.SyStore.state.activeSY.id,'Pending');
                    this.EnrollmentStore.getEnrollments(this.SyStore.state.activeSY.id,'Approved');
                    this.viewStudentDetailsDialog=null;
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
        this.ClassesStore.getClasses(this.SyStore.state.activeSY.id);
    },

    watch: {
        // user_id
    }
}
</script>
