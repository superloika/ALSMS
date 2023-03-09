<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                Learning Programs
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn @click="drawer=true" color="primary" rounded outlined>Add</v-btn>
        </v-toolbar>
        <v-card-text>
            <v-data-table :headers="tableHeaders" :items="ProgramsStore.state.programs">
                <template v-slot:[`item.cp`]="{item}">
                    <div style="width:100px;">
                        <v-img
                            height="50"
                            :src="'/storage/attachments/cp/' + item.id + '/' + item.cover_photo"
                        >

                        </v-img>
                    </div>
                </template>
                <template v-slot:[`item.actions`]="{item}">
                    <div style="width:100px;">
                        <v-btn icon small color="error" @click="deleteProgram(item.id)">
                            <v-icon>mdi-delete</v-icon>
                        </v-btn>
                        <v-btn icon small color="primary" @click="edit(item.id)">
                            <v-icon>mdi-pencil</v-icon>
                        </v-btn>
                    </div>
                </template>
            </v-data-table>
        </v-card-text>

        <v-navigation-drawer v-model="drawer" app temporary right style="width:600px;">
            <Add></Add>
        </v-navigation-drawer>
        <v-navigation-drawer v-model="ProgramsStore.state.editProgramDlg" app temporary right style="width:600px;">
            <Edit></Edit>
        </v-navigation-drawer>
    </v-card>
</template>

<script>
export default {
    components: {
        Add: ()=>import('./Add'),
        Edit: ()=>import('./Edit'),
    },

    data() {
        return {
            tableHeaders: [
                {text:"", value:"cp"},
                {text:"Title", value:"title"},
                {text:"Description", value:"description_short"},
                {text:"Actions", value:"actions"},
            ],
            drawer: null,
        }
    },

    methods: {
        async deleteProgram(id) {
            if(!confirm('Delete selected program?')) return;

            let url = `${this.AppStore.state.siteUrl}learning-programs/deleteProgram`;
            await axios.post(url,{
                    id: id
                }).then(res=>{
                    this.ProgramsStore.getPrograms();
                    this.AppStore.toast(res.data, 2500,'success');
                }).catch(e=>{
                    this.AppStore.toast(e, 2500,'error');
                })
                ;
            // try {

            // } catch (error) {
            // }
        },

        async edit(id) {
            console.log(id);
            this.ProgramsStore.state.editProgramDlg = true;
            let url = `${this.AppStore.state.siteUrl}learning-programs/edit`;
            await axios.post(url,{
                    id: id,
                }).then(res=>{
                    this.ProgramsStore.state.editProgramObj = res.data;
                }).catch(e=>{
                    this.AppStore.toast(e, 2500,'error');
                })
                ;
        }
    },

    created() {

    }
}
</script>
