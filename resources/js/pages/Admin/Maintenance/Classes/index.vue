<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                Classes
                <v-chip small color="info">
                    SY {{ SyStore.state.activeSY.sy }}
                </v-chip>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn @click="drawer=true" color="primary" rounded outlined>Add</v-btn>
        </v-toolbar>
        <v-card-text>
            <v-data-table :headers="tableHeaders" :items="ClassesStore.state.classes">
                <template v-slot:[`item.teacher_name`]="{item}">
                    <span>{{ item.firstname }} {{ item.middlename }} {{ item.lastname }}</span>
                </template>
                <template v-slot:[`item.actions`]="{item}">
                    <div stylex="width:100px;" class="d-flex">
                        <v-btn icon small color="error" class="ml-2" @click="deleteClass(item.id)">
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
        <v-navigation-drawer v-model="ClassesStore.state.editClassDlg" app temporary right style="width:600px;">
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
                {text:"Program", value:"program_title"},
                {text:"Teacher", value:"teacher_name"},
                {text:"CLC", value:"clc_name"},
                {text:"Address", value:"clc_address"},
                {text:"Actions", value:"actions"},
            ],
            drawer: null,
        }
    },

    methods: {
        async deleteClass(id) {
            if(!confirm('Delete selected class?')) return;

            let url = `${this.AppStore.state.siteUrl}classes/deleteClass`;
            await axios.post(url,{
                    id: id
                }).then(res=>{
                    this.ClassesStore.getClasses(this.SyStore.state.activeSY.id);
                    this.AppStore.toast(res.data, 2500,'success');
                }).catch(e=>{
                    this.AppStore.toast(e, 2500,'error');
                })
                ;
        },
        async edit(id) {
            console.log(id);
            this.ClassesStore.state.editClassDlg = true;
            let url = `${this.AppStore.state.siteUrl}classes/edit`;
            await axios.post(url,{
                    id: id,
                }).then(res=>{
                    this.ClassesStore.state.editClassObj = res.data;
                }).catch(e=>{
                    this.AppStore.toast(e, 2500,'error');
                })
                ;
        }
    },

    created() {
        // this.ClassesStore.getClasses(this.SyStore.state.activeSY.id);
    }
}
</script>
