<template>
    <v-card class="elevation-0">
        <v-card-title>
            Update
        </v-card-title>
        <v-card-subtitle>
            Update school year
        </v-card-subtitle>
        <v-card-text class="pt-4">
            <v-row>
                <v-col cols="12">
                    <v-text-field filled label="School Year"
                        v-model="SyStore.state.editSyObj.sy"></v-text-field>
                </v-col>
            </v-row>
        </v-card-text>
        <v-card-actions class="pt-0 pb-6 d-flex justify-end">
            <v-btn color="primary" @click="update()">
                Update
            </v-btn>
        </v-card-actions>
    </v-card>
</template>


<script>
export default {
    data() {
        return {

        }
    },

    methods: {
        async update() {
            let url = `${this.AppStore.state.siteUrl}sys/update`;
            await axios.post(url,{
                    data: this.SyStore.state.editSyObj
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
                    this.ClassesStore.getClasses();
                    this.SyStore.getSchoolYears();
                    this.SyStore.getActiveSchoolYear();
                })
                ;
        },

    },
}
</script>
