<template>
    <div>
        <v-row>
            <v-col cols="12" md="3">
                <Nav></Nav>
            </v-col>
            <v-col cols="12" md="9">
                <v-card>
                    <v-toolbar elevation="0" class="">
                        <v-toolbar-title >New Admin Account</v-toolbar-title>
                        <v-spacer></v-spacer>

                        <!-- <v-btn
                            dense
                            icon
                            rounded
                            to="/user-accounts"
                            title="Back to User Accounts"
                            class="mr-2"
                        >
                            <v-icon>
                                mdi-keyboard-backspace
                            </v-icon>
                        </v-btn> -->

                        <v-btn
                            color="primary"
                            @click="saveNewUser()"
                            :loading="savingNewUser"
                            rounded outlined
                        >
                            Save New Account
                        </v-btn>
                    </v-toolbar>
                    <v-card-text>
                        <v-container grid-list-xs>
                            <v-alert
                                densex
                                rounded
                                text
                                type="error"
                                dismissible
                                transition="scale-transition"
                                v-model="errMsgsShown"
                            >
                                <p class="ma-0 pa-0" :key="index"
                                    v-for="(errMsg, index) in errMsgs"
                                >
                                    {{ errMsg }}
                                </p>
                            </v-alert>
                            <br />

                            <v-form v-model="frm_add" ref="frm_add">
                                <v-row class="pa-0">
                                    <v-col cols="12" md="4" sm="6" class="pt-1 pb-1">
                                        <v-text-field
                                            hide-detailsx
                                            filled
                                            required
                                            label="Name *"
                                            v-model="newAccount.name"
                                            :rules="newAccount.rules.name"
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="4" sm="6" class="pt-1 pb-1">
                                        <v-text-field
                                            hide-detailsx
                                            filled
                                            label="Username *"
                                            required
                                            v-model="newAccount.username"
                                            :rules="newAccount.rules.username"
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="4" sm="6" class="pt-1 pb-1">
                                        <v-select
                                            hide-detailsx
                                            filled
                                            :items="ManageAccounts.state.userTypes"
                                            label="User Type *"
                                            required
                                            v-model="newAccount.user_type"
                                            :rules="newAccount.rules.user_type"
                                        >
                                        </v-select>
                                    </v-col>

                                    <v-col cols="12" md="4" sm="6" class="pt-1 pb-1">
                                        <v-text-field
                                            hide-detailsx
                                            filled
                                            label="Password *"
                                            autocomplete="false"
                                            required
                                            type="password"
                                            v-model="newAccount.password"
                                            :rules="newAccount.rules.password"
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="4" sm="6" class="pt-1 pb-1">
                                        <v-text-field
                                            hide-detailsx
                                            filled
                                            label="Confirm Password *"
                                            autocomplete="false"
                                            required
                                            type="password"
                                            v-model="newAccount.passwordConfirm"
                                            :rules="newAccount.rules.passwordConfirm"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>

                                <v-row class="pa-0">
                                    <v-col>
                                        <div class="float-right">

                                        </div>
                                    </v-col>
                                </v-row>

                            </v-form>
                        </v-container>
                    </v-card-text>

                    <!-- <v-card-actions>
                        <v-spacer></v-spacer>
                    </v-card-actions> -->
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    components: {
        Nav: ()=>import('./Nav.vue')
    },

    data() {
        return {
            nameRegex: /^[a-zA-Z\s]+$/,
            usernameRegex: /^[a-zA-Z0-9]+$/,
            frm_add: false,
            newAccount: {
                // name: "test user",
                // username: "admin",
                // password: "admin",
                // passwordConfirm: "admin",
                // user_type: "user",

                name: "",
                username: "",
                password: "",
                passwordConfirm: "",
                user_type: "",
                selected_principals: [],

                rules: {
                    name: [
                        v => !!v || "Name is required",
                        v =>
                            v.length >= 2 ||
                            "Name must be 2 characters or above",
                        v => this.nameRegex.test(v) || "Invalid name. Use alpha characters only"
                    ],
                    username: [
                        v => !!v || "Username is required",
                        v =>
                            v.length >= 3 ||
                            "Username must be 3 characters or above",
                        v => this.usernameRegex.test(v) || "Invalid username"
                    ],
                    password: [
                        v => !!v || "Password is required",
                        v =>
                            v.length >= 3 ||
                            "Password must be 3 characters or above"
                    ],
                    passwordConfirm: [
                        v => !!v || "Please confirm password",
                        v =>
                            this.newAccount.password ===
                                this.newAccount.passwordConfirm ||
                            "Password did not match"
                    ],
                    user_type: [v => !!v || "User type is required"]
                }
            },
            savingNewUser: false,
            errMsgs: [],
            errMsgsShown: false,
        };
    },

    computed: {
        // filteredUserType() {}
    },

    watch: {
        'newAccount.name': function() {
            this.newAccount.name = this.newAccount.name.replace('  ',' ').trim();
        },
    },

    methods: {
        async saveNewUser() {
            const vm = this;
            if (this.$refs.frm_add.validate()) {
                let url = `${this.AppStore.state.siteUrl}accounts`;
                try {
                    this.savingNewUser = true;
                    let response = await axios.post(url, {
                        name: vm.newAccount.name,
                        username: vm.newAccount.username,
                        password: vm.newAccount.password,
                        user_type: vm.newAccount.user_type,
                    });
                    // console.log(response.data);
                    if (response.data == true) {
                        this.ManageAccounts.initUsers();
                        this.ManageAccounts.state.modalAddIsOpen = false;
                        this.AppStore.toast("New account added", 2000);
                    } else if (
                        response.data.invalidations != undefined ||
                        response.data.invalidations != null
                    ) {
                        this.errMsgs = [];
                        Object.entries(response.data.invalidations).forEach(
                            field => {
                                this.errMsgs.push(field[1][0]);
                            }
                        );
                        // this.AppStore.toast(this.errMsgs, 3000);
                        this.errMsgsShown = true;
                    } else if (
                        response.data.errorInfo != null ||
                        response.data.errorInfo != undefined
                    ) {
                        this.AppStore.toast("An error occured", 2000);
                        console.log(response.data.errorInfo);
                    }
                } catch (error) {
                    console.log(error);
                    this.AppStore.toast(error, 3000);
                }
                this.savingNewUser = false;
            }
        }
    },
};
</script>
