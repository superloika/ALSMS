<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                Enrolled Class
                <v-chip small color="info">
                    SY {{ SyStore.state.activeSY.sy }}
                </v-chip>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn v-if="
                    (!approvedClasses.length || pendingClasses.length) &&
                    (approvedClasses.length || !pendingClasses.length)
                "
                color="success"
                @click="enroll"
            >
                Enroll
            </v-btn>
            <v-btn v-if="pendingClasses.length" color="error"
                @click="cancelRequest"
            >
                Cancel enrollment application
            </v-btn>
        </v-toolbar>
        <v-card-text>
            <v-data-table :headers="tableHeaders" :items="approvedClasses">
                <template v-slot:[`item.teacher_name`]="{item}">
                    <span>{{ item.firstname }} {{ item.middlename }} {{ item.lastname }}</span>
                </template>
                <template v-slot:[`item.actions`]="{item}">
                    <div class="d-flex">
                        <v-btn small rounded outlined color="primary" class="ml-2" title="View Details"
                        >
                            <v-icon>mdi-eye</v-icon> View
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
        approvedClasses() {
            try {
                return this.StudentClassesStore.state.classes.filter((e)=>{
                    return e.user_id==this.AuthUser.id && e.status=='Approved';
                });
            } catch (error) {
                return 0;
            }
        },
        pendingClasses() {
            try {
                return this.StudentClassesStore.state.classes.filter((e)=>{
                    return e.user_id==this.AuthUser.id && e.status=='Pending';
                });
            } catch (error) {
                return 0;
            }
        }
    },

    data() {
        return {
            tableHeaders: [
                {text:"Program", value:"program_title"},
                {text:"Teacher", value:"teacher_name"},
                {text:"CLC", value:"clc_name"},
                {text:"CLC Address", value:"clc_address"},
                {text:"Actions", value:"actions"},
            ],
            drawer: null,
        }
    },

    methods: {
        async enroll() {
            if(!confirm('This will submit an enrollment application. Press OK to proceed')) {
                return;
            }
            let url = `${this.AppStore.state.siteUrl}student/classes/enroll`;
            await axios.get(url).then(res=>{
                    this.AppStore.toast(res.data, 3500,'success');
                }).catch(e=>{
                    if(e.response) {
                        if(e.response.status=='409' || e.response.status=='404') {
                            this.AppStore.toast(e.response.data, 3500,'error');
                        }
                    } else {
                        this.AppStore.toast(e, 2500,'error');
                    }
                }).finally(()=>{
                    this.StudentClassesStore.studentEnrollment(this.SyStore.state.activeSY.id);
                })
                ;
        },

        async cancelRequest() {
            if(!confirm('This will cancel your enrollment application. Press OK to proceed')) {
                return;
            }
            let url = `${this.AppStore.state.siteUrl}student/classes/cancelRequest`;
            await axios.get(url).then(res=>{
                    this.AppStore.toast(res.data, 2500,'success');
                }).catch(e=>{
                    this.AppStore.toast(e, 2500,'error');
                }).finally(()=>{
                    this.StudentClassesStore.studentEnrollment(this.SyStore.state.activeSY.id);
                })
                ;
        }
    },

    created() {
        // this.ClassesStore.getClasses(this.SyStore.state.activeSY.id);
    }
}
</script>
