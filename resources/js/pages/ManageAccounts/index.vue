<template>
<div>
    <div
        v-if="this.AppStore.isSuperAdmin()==false && this.AppStore.isAdmin()==false"
        class="pa-4 error--text"
    >
        {{ AppStore.state.guardMsgs.accessDenied }}
    </div>
    <v-card v-else>
        <v-toolbar elevation="0">
            <!-- <v-toolbar-title>User Accounts</v-toolbar-title> -->

            <v-spacer></v-spacer>

            <v-text-field
                label="Search"
                clearable
                hide-details
                dense
                class="mr-3"
                style="max-width:200px;"
                flat
                solo-inverted
                v-model="ManageAccounts.state.searchKey"
            ></v-text-field>

            <!-- <v-btn
                dense
                iconx
                rounded
                color="primary"
                @click.stop="ManageAccounts.state.modalAddIsOpen = true"
                title="Add Account"
            >
                <v-icon>mdi-account-plus</v-icon>
                New Account
            </v-btn> -->
            <v-btn
                dense
                color="primary"
                to="/account/add"
                title="Add Account"
            >
                <v-icon class="mr-1">mdi-account-plus</v-icon>
                New Account
            </v-btn>
        </v-toolbar>

        <v-data-table
            :loading="ManageAccounts.state.usersLoading"
            :items="filteredUsers"
            :headers="tblUsersHeader"
            :search="ManageAccounts.state.searchKey"
            checkbox-color="primary"
            class=""
        >
            <template v-slot:[`item.actions`]="{ item }">
                <v-btn
                    dense
                    icon
                    title="Edit"
                    @click.stop="ManageAccounts.editAccount(item)"
                >
                    <v-icon>mdi-account-edit</v-icon>
                </v-btn>

                <v-btn
                    dense
                    icon
                    title="Delete"
                    @click="ManageAccounts.confirmDeleteAccount(item)"
                >
                    <v-icon>mdi-delete-forever</v-icon>
                </v-btn>
            </template>
            <!-- <template v-slot:[`item.user_type`]="{ item }">
                <v-chip v-if="item.user_type=='student'" small color="default">
                    {{ item.user_type }}
                </v-chip>
                <v-chip v-else-if="item.user_type=='admin'" small color="accent">
                    {{ item.user_type }}
                </v-chip>
                <v-chip v-else-if="item.user_type=='super_admin'" small color="info">
                    {{ item.user_type }}
                </v-chip>
            </template> -->
        </v-data-table>

        <!-- Dialogs (Modals)-->
        <v-dialog
            v-model="ManageAccounts.state.modalAddIsOpen"
            max-width="800"
            persistent
        >
            <AccountsAdd
                v-if="ManageAccounts.state.modalAddIsOpen"
            ></AccountsAdd>
        </v-dialog>
        <v-dialog
            v-model="ManageAccounts.state.modalEditIsOpen"
            max-width="800"
            persistent
        >
            <AccountsEdit
                v-if="ManageAccounts.state.modalEditIsOpen"
            ></AccountsEdit>
        </v-dialog>
        <!-- /Dialogs (Modals)-->
    </v-card>
</div>
</template>

<script>
export default {
    components: {
        AccountsAdd: () => import("./AccountsAdd.vue"),
        AccountsEdit: () => import("./AccountsEdit.vue")
    },

    data() {
        return {};
    },

    computed: {
        tblUsersHeader() {
            return [
                { text: "Name", value: "name" },
                { text: "Username", value: "username" },
                // { text: "E-mail Address", value: "email" },
                { text: "User Type", value: "user_type" },
                {
                    text: "Actions",
                    value: "actions",
                    sortable: false,
                    align: "end"
                }
            ];
        },

        filteredUsers() {

            return this.ManageAccounts.state.users.filter((e)=>{
                if(this.AppStore.isAdmin()) {
                    return e.user_type != 'super_admin';
                } else {
                    return e;
                }
            });

        },
    },

    methods: {

    },

    created() {
        this.ManageAccounts.initUsers();
    },

    mounted() {
        console.log("ManageAccounts mounted.");
    }
};
</script>
