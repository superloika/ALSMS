<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                Classes
                <v-chip small color="info">
                    SY {{ SyStore.state.activeSY.sy }}
                </v-chip>
            </v-toolbar-title>
            <v-spacer></v-spacer>

        </v-toolbar>

        <v-card-text>
            <v-data-table :headers="tableHeaders" :items="ClassesStore.state.teacherClasses">
                <template v-slot:[`item.actions`]="{item}">
                    <div stylex="width:100px;" class="d-flex">
                        <v-btn text color="primary" class="ml-2" title="View"
                            link :to="'/teacher/classes/' + item.id"
                            rounded outlined
                        >
                            View Class
                        </v-btn>
                    </div>
                </template>
            </v-data-table>
        </v-card-text>

        <v-navigation-drawer v-model="drawer" app temporary right style="width:600px;">
            <!-- <Add></Add> -->
        </v-navigation-drawer>
    </v-card>
</template>

<script>
export default {
    components: {
        // Add: ()=>import('./Add'),
    },

    data() {
        return {
            tableHeaders: [
                {text:"Learning Program", value:"program_title"},
                {text:"CLC", value:"clc_name"},
                {text:"Address", value:"clc_address"},
                {text:"Sun", value:"sched_sun"},
                {text:"Mon", value:"sched_mon"},
                {text:"Tue", value:"sched_tue"},
                {text:"Wed", value:"sched_wed"},
                {text:"Thu", value:"sched_thu"},
                {text:"Fri", value:"sched_fri"},
                {text:"Sat", value:"sched_sat"},
                {text:"Actions", value:"actions"},
            ],
            drawer: null,
        }
    },

    methods: {

    },

    created() {
        this.ClassesStore.getTeacherClasses(
            this.SyStore.state.activeSY.id,
            this.AuthUser.teacher_id
        );
    }
}
</script>
