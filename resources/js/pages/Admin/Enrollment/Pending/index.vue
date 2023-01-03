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
                        <v-btn icon small color="" class="ml-2" title="View Details"
                        >
                            <v-icon>mdi-eye</v-icon>
                        </v-btn>
                    </div>
                    <div class="d-flex">
                        <v-btn icon small color="primary" class="ml-2"
                            @click="confirm(item.id)" title="Accept"
                        >
                            <v-icon>mdi-check</v-icon>
                        </v-btn>
                    </div>
                </template>
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    components: {
    },

    data() {
        return {
            tableHeaders: [
                {text:"Student Name", value:"student_name"},
                {text:"Program", value:"program_title"},
                {text:"Teacher", value:"teacher_name"},
                {text:"Actions", value:"actions"},
            ],
            drawer: null,
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
        }
    },

    created() {

    }
}
</script>
