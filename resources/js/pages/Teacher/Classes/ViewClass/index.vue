<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                <span v-if="ClassesStore.state.classStudents.length">
                    {{ ClassesStore.state.classStudents[0].title }}
                    - ({{ ClassesStore.state.classStudents[0].clc_name }})
                </span>
                <span v-else>
                    No students yet
                </span>
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn outlined rounded color="primary" link to="/teacher/classes" class="ml-2">
                Back to Classes
            </v-btn>
            <v-btn outlined rounded color="primary"  class="ml-2"
                @click.stop="viewAnnouncements">
                Announcements
            </v-btn>
        </v-toolbar>

        <v-card-text>
            <v-data-table :headers="tableHeaders" :items="ClassesStore.state.classStudents">
                <template v-slot:[`item.actions`]="{item}">
                    <div stylex="width:100px;" class="d-flex">
                        <v-btn text color="primary" class="ml-2" title="View"
                            rounded outlined
                            @click.stop="user_id=item.user_id;viewStudentDetailsDialog=true;"
                        >
                            View Student Details
                        </v-btn>
                    </div>
                </template>
            </v-data-table>
        </v-card-text>

        <v-dialog v-model="viewStudentDetailsDialog">
            <StudentProfile :key="user_id" :user_id="user_id"></StudentProfile>
        </v-dialog>

        <v-dialog v-model="viewAnnouncementsDialog" max-width="900">
            <Announcements></Announcements>
        </v-dialog>

        <v-navigation-drawer v-model="drawer" app temporary right style="width:600px;">
            <!-- <Add></Add> -->
        </v-navigation-drawer>
    </v-card>
</template>

<script>
export default {
    components: {
        StudentProfile: ()=>import('../../../Student/Profile'),
        Announcements: ()=>import('./Announcements.vue'),
    },

    data() {
        return {
            tableHeaders: [
                {text:"First Name", value:"firstname"},
                {text:"Middle Name", value:"middlename"},
                {text:"Last Name", value:"lastname"},
                {text:"Gender", value:"gender"},
                {text:"Actions", value:"actions"},
            ],
            drawer: null,
            viewStudentDetailsDialog: null,
            viewAnnouncementsDialog: null,
            user_id: '',
        }
    },

    methods: {
        viewAnnouncements() {
            this.AnnouncementStore.getAnnouncements(this.$route.params.id);
            this.viewAnnouncementsDialog=true;
        }
    },

    created() {
        this.ClassesStore.getClassStudents(this.$route.params.id);
    }
}
</script>
