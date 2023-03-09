<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                School Year
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn @click="drawer=true" color="primary" rounded outlined>Add</v-btn>
        </v-toolbar>
        <v-card-text>
            <v-data-table :headers="tableHeaders" :items="SyStore.state.sys">
                <template v-slot:[`item.status`]="{item}">
                    <v-chip small color="primary" v-if="item.status==1">
                        Active
                    </v-chip>
                    <v-chip small color="warning" v-else-if="item.status==0">
                        Inactive
                    </v-chip>
                </template>
                <template v-slot:[`item.actions`]="{item}">
                    <div stylex="width:100px;" class="d-flex">
                        <!-- <v-btn small color="primary" class="ml-2" :disabled="item.status==1"
                            @click="toggleSYStatus(item.id, 1)"
                        >
                            Activate
                        </v-btn>
                        <v-btn small color="warning" class="ml-2" :disabled="item.status==0"
                            @click="toggleSYStatus(item.id, 0)"
                        >
                            Deactivate
                        </v-btn> -->
                        <v-btn icon small color="error" class="ml-2" disabled>
                            <v-icon>mdi-delete</v-icon>
                        </v-btn>
                        <v-btn icon small color="primary" class="ml-2" @click="edit(item.id)">
                            <v-icon>mdi-pencil</v-icon>
                        </v-btn>
                    </div>
                </template>
            </v-data-table>
        </v-card-text>

        <v-navigation-drawer v-model="drawer" app temporary right style="width:600px;">
            <Add></Add>
        </v-navigation-drawer>
        <v-navigation-drawer v-model="SyStore.state.editSyDlg" app temporary right style="width:600px;">
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
                {text:"School Year", value:"sy"},
                {text:"Status", value:"status"},
                {text:"Actions", value:"actions"},
            ],
            drawer: null,
        }
    },

    methods: {
        // async deleteProgram(id) {
        //     if(!confirm('Delete selected program?')) return;

        //     let url = `${this.AppStore.state.siteUrl}learning-programs/deleteProgram`;
        //     await axios.post(url,{
        //             id: id
        //         }).then(res=>{
        //             this.ProgramsStore.getPrograms();
        //             this.AppStore.toast(res.data, 2500,'success');
        //         }).catch(e=>{
        //             this.AppStore.toast(e, 2500,'error');
        //         })
        //         ;
        // },
        async toggleSYStatus(id,mode) {
            let msg = mode==1? 'Activate selected school year?':'Deactivate selected school year?';
            if(!confirm(msg)) return;

            let url = `${this.AppStore.state.siteUrl}sys/toggleSYStatus`;
            await axios.post(url,{
                    id: id,
                    mode: mode
                }).then(res=>{
                    this.SyStore.getSchoolYears();
                    this.SyStore.getActiveSchoolYear();
                    this.ClassesStore.getClasses(id);
                    this.AppStore.toast(res.data, 2500,'success');
                }).catch(e=>{
                    this.AppStore.toast(e, 2500,'error');
                })
                ;
        },

        async edit(item_id) {
            console.log(item_id);
            this.SyStore.state.editSyDlg = true;
            let url = `${this.AppStore.state.siteUrl}sys/edit`;
            await axios.post(url,{
                    item_id: item_id,
                }).then(res=>{
                    this.SyStore.state.editSyObj = res.data;
                    this.SyStore.state.editSyObj.old_sy = res.data.sy;
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
