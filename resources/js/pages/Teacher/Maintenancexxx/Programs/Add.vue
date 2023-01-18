<template>
    <v-card class="elevation-0">
        <v-card-title>
            Add
        </v-card-title>
        <v-card-subtitle>
            Add a new learning program
        </v-card-subtitle>
        <v-card-text class="pt-4">
            <v-row>
                <v-col cols="12">
                    <v-text-field filled label="Title" v-model="form.title"></v-text-field>
                    <v-textarea filled label="Short Description"
                        v-model="form.description_short"
                    ></v-textarea>
                    <v-textarea filled label="Long Description"
                        v-model="form.description_long"
                    ></v-textarea>
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
                title: '',
                description_short: '',
                description_long: '',
            }
        }
    },

    methods: {
        async save() {
            let url = `${this.AppStore.state.siteUrl}learning-programs/saveProgram`;
            await axios.post(url,{
                    data: this.form
                }).then(res=>{
                    this.ProgramsStore.getPrograms();
                    this.AppStore.resetForm(this.form);
                    this.AppStore.toast(res.data, 2500,'success');
                }).catch(e=>{
                    this.AppStore.toast(e, 2500,'error');
                })
                ;
            // try {

            // } catch (error) {
            // }
        },
    }
}
</script>
