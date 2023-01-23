<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                Available Classes
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
                        <v-btn small color="primary" class="ml-2"
                            @click="enroll(item.id)"
                        >
                            Enroll
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
                // {text:"Class ID", value:"id"},
                {text:"Program", value:"program_title"},
                {text:"Teacher", value:"teacher_name"},
                {text:"CLC", value:"clc_name"},
                {text:"CLC Address", value:"clc_address"},
                {text:"Actions", value:"actions"},
            ],
            drawer: null,
        }
    },

    computed: {
        classes() {
            // return this.StudentClassesStore.state.classes.filter((e)=>{
            //     return e.user_id != this.AuthUser.id || e.user_id == null;
            // });
            return this.ClassesStore.state.classes;
        }
    },

    methods: {
        async enroll(class_id) {
            let url = `${this.AppStore.state.siteUrl}student/classes/enroll`;
            await axios.post(url,{
                    data: {
                        class_id: class_id,
                    }
                }).then(res=>{
                    this.StudentClassesStore.all(this.SyStore.state.activeSY.id);
                    this.AppStore.toast(res.data, 3500,'success');
                }).catch(e=>{
                    if(e.response) {
                        if(e.response.status=='409') {

                            this.AppStore.toast(e.response.data, 3500,'error');
                        }
                    } else {
                        this.AppStore.toast(e, 2500,'error');
                    }
                })
                ;
        }
    },

    created() {
        this.ClassesStore.getClasses(this.SyStore.state.activeSY.id);
    }
}
</script>
