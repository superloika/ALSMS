<template>
    <v-card class="elevation-0">
        <v-card-title>
            Edit
        </v-card-title>
        <v-card-subtitle>
            Edit community learning center
        </v-card-subtitle>
        <v-card-text class="pt-4">
            <v-row>
                <v-col cols="12">
                    <!-- <v-text-field filled label="Code" v-model="form.code"></v-text-field> -->
                    <v-text-field filled label="Name"
                        v-model="ClcStore.state.editClcObj.name"></v-text-field>
                    <v-textarea filled label="Address"
                        v-model="ClcStore.state.editClcObj.address"
                    ></v-textarea>
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
            //     // code: '',
            //     name: '',
            //     address: '',
            // }
        }
    },

    methods: {
        // async save() {
        //     let url = `${this.AppStore.state.siteUrl}clc/saveClc`;
        //     await axios.post(url,{
        //             data: this.form
        //         }).then(res=>{
        //             this.ClcStore.getClcs();
        //             this.AppStore.resetForm(this.form);
        //             this.AppStore.toast(res.data, 2500,'success');
        //         }).catch(e=>{
        //             this.AppStore.toast(e, 2500,'error');
        //         })
        //         ;
        // },
        async update() {
            let url = `${this.AppStore.state.siteUrl}clc/update`;
            await axios.post(url,{
                    data: this.ClcStore.state.editClcObj
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
                    this.ClcStore.getClcs();
                })
                ;
        },
    }
}
</script>
