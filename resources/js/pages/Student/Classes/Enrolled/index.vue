<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                Enrolled
                <v-chip small color="info">
                    SY {{ SyStore.state.activeSY.sy }}
                </v-chip>
            </v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <v-data-table :headers="tableHeaders" :items="classes">
                <template v-slot:[`item.teacher_name`]="{item}">
                    <span>{{ item.firstname }} {{ item.middlename }} {{ item.lastname }}</span>
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

    computed:{
        classes() {
            return this.StudentClassesStore.state.classes.filter((e)=>{
                return e.user_id!=null && e.status=='Approved';
            });
        }
    },

    data() {
        return {
            tableHeaders: [
                {text:"Class ID", value:"id"},
                {text:"Program", value:"program_title"},
                {text:"Teacher", value:"teacher_name"},
                {text:"Actions", value:"actions"},
            ],
            drawer: null,
        }
    },

    methods: {

    },

    created() {
        // this.ClassesStore.getClasses(this.SyStore.state.activeSY.id);
    }
}
</script>
