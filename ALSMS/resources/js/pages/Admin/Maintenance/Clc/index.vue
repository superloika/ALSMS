<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                Community Learning Centers
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn @click="drawer=true" color="primary" rounded outlined>Add</v-btn>
        </v-toolbar>
        <v-card-text>
            <v-data-table :headers="tableHeaders" :items="ClcStore.state.clcs">
                <template v-slot:[`item.actions`]="{item}">
                    <div style="width:100px;">
                        <v-btn icon small color="error" @click="deleteClc(item.id)">
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
        <v-navigation-drawer v-model="ClcStore.state.editClcDlg" app temporary right style="width:600px;">
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
                {text:"Name", value:"name"},
                {text:"Address", value:"address"},
                {text:"Actions", value:"actions"},
            ],
            drawer: null,
        }
    },

    methods: {
        async deleteClc(id) {
            if(!confirm('Delete selected CLC?')) return;

            let url = `${this.AppStore.state.siteUrl}clc/deleteClc`;
            await axios.post(url,{
                    id: id
                }).then(res=>{
                    this.ClcStore.getClcs();
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
            this.ClcStore.state.editClcDlg = true;
            let url = `${this.AppStore.state.siteUrl}clc/edit`;
            await axios.post(url,{
                    id: id,
                }).then(res=>{
                    this.ClcStore.state.editClcObj = res.data;
                }).catch(e=>{
                    this.AppStore.toast(e, 2500,'error');
                })
                ;
        }
    },

    created() {
        this.ClcStore.getClcs();
    }
}
</script>
