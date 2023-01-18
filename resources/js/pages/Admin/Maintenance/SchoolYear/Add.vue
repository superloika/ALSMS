<template>
    <v-card class="elevation-0">
        <v-card-title>
            Add
        </v-card-title>
        <v-card-subtitle>
            Add a new school year
        </v-card-subtitle>
        <v-card-text class="pt-4">
            <v-row>
                <v-col cols="12">
                    <v-text-field filled label="School Year" v-model="form.sy"></v-text-field>
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
                sy: '',
            }
        }
    },

    methods: {
        async save() {
            let url = `${this.AppStore.state.siteUrl}sys/saveSchoolYear`;
            await axios.post(url,{
                    data: this.form
                }).then(res=>{
                    this.SyStore.getSchoolYears();
                    this.SyStore.getActiveSchoolYear();
                    this.AppStore.resetForm(this.form);
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
                    this.ClassesStore.getClasses();
                })
                ;
        },
    }
}
</script>
