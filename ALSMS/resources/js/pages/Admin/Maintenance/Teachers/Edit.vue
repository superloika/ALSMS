<template>
    <v-card class="elevation-0">
        <v-card-title>
            Edit
        </v-card-title>
        <v-card-subtitle>
            Edit teacher
        </v-card-subtitle>
        <v-card-text class="pt-4">
            <v-row>
                <v-col cols="12">
                    <v-text-field filled label="First Name"
                        v-model="TeachersStore.state.editTeacherObj.firstname"></v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-text-field filled label="Middle Name"
                        v-model="TeachersStore.state.editTeacherObj.middlename"></v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-text-field filled label="Last Name"
                        v-model="TeachersStore.state.editTeacherObj.lastname"></v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-select filled label="Gender" :items="['Male', 'Female']"
                        v-model="TeachersStore.state.editTeacherObj.gender">
                    </v-select>
                </v-col>
                <v-col cols="12">
                    <v-text-field filled label="Address"
                        v-model="TeachersStore.state.editTeacherObj.address"></v-text-field>
                </v-col>
            </v-row>
        </v-card-text>
        <v-card-actions class="pt-0 pb-6 d-flex justify-end">
            <v-btn color="primary" @click="update()">
                Save Changes
            </v-btn>
        </v-card-actions>
    </v-card>
</template>


<script>
export default {
    data() {
        return {
            // form: {
            //     firstname: '',
            //     middlename: '',
            //     lastname: '',
            //     gender: '',
            //     address: '',
            // }
        }
    },

    methods: {
        // async save() {
        //     let url = `${this.AppStore.state.siteUrl}teachers/saveTeacher`;
        //     await axios.post(url,{
        //             data: this.form
        //         }).then(res=>{
        //             this.TeachersStore.getTeachers();
        //             this.AppStore.resetForm(this.form);
        //             this.AppStore.toast(res.data, 2500,'success');
        //         }).catch(e=>{
        //             this.AppStore.toast(e, 2500,'error');
        //         })
        //         ;
        // },
        async update() {
            let url = `${this.AppStore.state.siteUrl}teachers/update`;
            await axios.post(url,{
                    data: this.TeachersStore.state.editTeacherObj
                }).then(res=>{
                    this.AppStore.toast(res.data, 2500,'success');
                }).catch(e=>{
                    if(e.response) {
                        console.log(e.response);
                        if(e.response.status=="409") {
                            this.AppStore.toast(e.response.data, 2500,'error');
                        } else {
                            this.AppStore.toast(e, 2500,'error');
                        }
                    }
                }).finally(()=>{
                    this.TeachersStore.getTeachers();
                })
                ;
        },
    }
}
</script>
