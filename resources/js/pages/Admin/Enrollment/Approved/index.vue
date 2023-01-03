<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                Approved Enrollments
            </v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <v-data-table :headers="tableHeaders" :items="EnrollmentStore.state.enrollment_approved">
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

    },

    created() {

    }
}
</script>
