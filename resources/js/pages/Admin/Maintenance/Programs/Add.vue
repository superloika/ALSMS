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
                    <v-file-input
                        label="Cover Photo"
                        v-model="cp"
                        filled
                    ></v-file-input>
                    <v-text-field filled label="Title" v-model="form.title"></v-text-field>
                    <v-textarea filled label="Short Description" auto-grow
                        v-model="form.description_short"
                    ></v-textarea>
                    <v-textarea filled label="Long Description" auto-grow
                        v-model="form.description_long"
                    ></v-textarea>
                    <v-file-input
                        multiple
                        label="Attachments"
                        chips
                        v-model="file"
                        filled
                    ></v-file-input>
                    <!-- <v-container>
                        <em class="error--text" v-if="!form.attachments.length">No attachments available</em>
                        <v-btn small outlined rounded color="primary" link target="_blank"
                            :to="'/storage/attachments/programs/'+ form.title +'/' + a"
                            v-for="(a,i) in form.attachments"
                            :key="i"
                        >
                            {{ a }}
                        </v-btn>
                    </v-container> -->
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
            },
            file:[],
            cp: null,
        }
    },

    methods: {
        async save() {
            let url = `${this.AppStore.state.siteUrl}learning-programs/saveProgram`;

            let frmData = new FormData();
            for(let i=0;i<this.file.length;i++) {
                frmData.append('files[' + i + ']', this.file[i]);
            }
            frmData.append('form', JSON.stringify(this.form));
            frmData.append('cp', this.cp);

            await axios.post(
                    url,
                    frmData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                ).then(res=>{
                    this.ProgramsStore.getPrograms();
                    this.AppStore.resetForm(this.form);
                    this.file = [];
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
