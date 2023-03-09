<template>
    <v-card class="elevation-0">
        <v-card-title>
            Add
        </v-card-title>
        <v-card-subtitle>
            Add a new community learning center
        </v-card-subtitle>
        <v-card-text class="pt-4">
            <v-row>
                <v-col cols="12">
                    <!-- <v-text-field filled label="Code" v-model="form.code"></v-text-field> -->
                    <v-text-field filled label="Name" v-model="form.name"></v-text-field>
                    <v-textarea filled label="Address"
                        v-model="form.address"
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
                // code: '',
                name: '',
                address: '',
            }
        }
    },

    methods: {
        async save() {
            let url = `${this.AppStore.state.siteUrl}clc/saveClc`;
            await axios.post(url,{
                    data: this.form
                }).then(res=>{
                    this.ClcStore.getClcs();
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
