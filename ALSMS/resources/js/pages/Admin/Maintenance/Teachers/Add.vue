<template>
    <v-card class="elevation-0">
        <v-card-title>
            Add
        </v-card-title>
        <v-card-subtitle>
            Add a new teacher
        </v-card-subtitle>
        <v-card-text class="pt-4">
            <v-row>
                <v-col cols="12">
                    <v-text-field filled label="First Name" v-model="form.firstname"></v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-text-field filled label="Middle Name" v-model="form.middlename"></v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-text-field filled label="Last Name" v-model="form.lastname"></v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-select filled label="Gender" :items="['Male', 'Female']" v-model="form.gender">
                    </v-select>
                </v-col>
                <v-col cols="12">
                    <v-text-field filled label="Address" v-model="form.address"></v-text-field>
                </v-col>
            </v-row>
        </v-card-text>
        <v-card-actions class="pt-0 pb-6 d-flex justify-end">
            <v-btn color="primary" @click="save()">
                Save
            </v-btn>
        </v-card-actions>
    </v-card>
</template>


<script>
export default {
    data() {
        return {
            form: {
                firstname: '',
                middlename: '',
                lastname: '',
                gender: '',
                address: '',
            }
        }
    },

    methods: {
        async save() {
            let url = `${this.AppStore.state.siteUrl}teachers/saveTeacher`;
            await axios.post(url,{
                    data: this.form
                }).then(res=>{
                    this.TeachersStore.getTeachers();
                    this.AppStore.resetForm(this.form);
                    this.AppStore.toast(res.data, 2500,'success');
                }).catch(e=>{
                    this.AppStore.toast(e, 2500,'error');
                })
                ;
        },
    }
}
</script>
