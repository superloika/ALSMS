<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                Teachers
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn @click="drawer=true" color="primary">Add</v-btn>
        </v-toolbar>
        <v-card-text>
            <v-data-table :headers="tableHeaders" :items="TeachersStore.state.teachers">
                <template v-slot:[`item.fullname`]="{item}">
                    <span>{{ item.firstname }} {{ item.middlename }} {{ item.lastname }}</span>
                </template>
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
                        <v-btn icon small color="error" class="ml-2" disabled>
                            <v-icon>mdi-delete</v-icon>
                        </v-btn>
                        <v-btn icon small color="primary" class="ml-2" disabled>
                            <v-icon>mdi-pencil</v-icon>
                        </v-btn>
                    </div>
                </template>
            </v-data-table>
        </v-card-text>

        <v-navigation-drawer v-model="drawer" app temporary right style="width:600px;">
            <Add></Add>
        </v-navigation-drawer>
    </v-card>
</template>

<script>
export default {
    components: {
        Add: ()=>import('./Add'),
    },

    data() {
        return {
            tableHeaders: [
                {text:"Name", value:"fullname"},
                {text:"Gender", value:"gender"},
                {text:"Address", value:"address"},
                {text:"Status", value:"status"},
                {text:"Actions", value:"actions"},
            ],
            drawer: null,
        }
    },

    methods: {

    },

    created() {
        this.TeachersStore.getTeachers();
    }
}
</script>
