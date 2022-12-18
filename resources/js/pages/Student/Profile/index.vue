<template>
    <div>
        <div class="mb-6">
            <div class="text-h5 primary--text">Student Profile</div>
        </div>
        <div>
            <v-row>
                <v-col cols="12" md="3">
                    <v-text-field
                        label="First Name"
                        v-model="form.firstname"
                        filled
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        label="Middle Name"
                        v-model="form.middlename"
                        filled
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        label="Last Name"
                        v-model="form.lastname"
                        filled
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        label="Extension Name"
                        v-model="form.extname"
                        filled
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-radio-group v-model="form.gender" row>
                        <template v-slot:label>
                            <div>Gender</div>
                        </template>
                        <v-radio label="Male" value="Male"></v-radio>
                        <v-radio label="Female" value="Female"></v-radio>
                    </v-radio-group>
                </v-col>

                <v-col cols="12" md="3">
                    <v-menu
                        ref="dobMenu"
                        v-model="dobMenu"
                        :close-on-content-click="false"
                        transition="scale-transition"
                        offset-y
                        min-width="auto"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="form.dob"
                                label="Date of Birth"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                                filled
                            ></v-text-field>
                        </template>
                        <v-date-picker
                            v-model="form.dob"
                            :active-picker.sync="dobActivePicker"
                            :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                            min="1950-01-01"
                            @change="saveDOB"
                        ></v-date-picker>
                    </v-menu>
                </v-col>

                <v-col cols="12" md="6">
                    <v-text-field
                        label="Place of Birth"
                        v-model="form.pob"
                        filled
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="5">
                    <v-text-field
                        label="Address"
                        v-model="form.address"
                        filled
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        label="Parent/Guardian"
                        v-model="form.guardian"
                        filled
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="4">
                    <v-text-field
                        label="Parent/Guardian Address"
                        v-model="form.guardian_address"
                        filled
                    ></v-text-field>
                </v-col>
            </v-row>
        </div>
        <div class="mt-4">
            <v-btn color="primary" @click="updateProfile()">Update Profile</v-btn>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            form: {
                user_id: '',
                firstname: '',
                middlename: '',
                lastname: '',
                extname: '',
                gender: '',
                dob: '',
                pob: '',
                address: '',
                guardian: '',
                guardian_address: '',
            },
            //dob
            dob: null,
            dobActivePicker: null,
            dobMenu: false,
        };
    },

    watch: {
        dobMenu(val){
            val && setTimeout(() => (this.dobActivePicker = 'YEAR'));
        }
    },

    methods: {
        saveDOB(date) {
            this.$refs.dobMenu.save(date);
        },

        async updateProfile() {
            await axios.post(
                `${this.AppStore.state.siteUrl}student/profile/updateProfile`,
                {
                    data: this.form
                }
            ).then(e=>{
                this.AppStore.toast(e.data,3000,'success');
            }).catch(e=>{
                if(e.response) {
                    this.AppStore.toast(e.response.data,3000,'error');
                }
            })
            ;
        },

        async getProfile() {
            await axios.get(
                `${this.AppStore.state.siteUrl}student/profile/getProfile`
            ).then(e=>{
                console.log(e.data);
                if(e.data.firstname!=undefined) {
                    this.form.firstname = e.data.firstname;
                    this.form.middlename = e.data.middlename;
                    this.form.lastname = e.data.lastname;
                    this.form.extname = e.data.extname;
                    this.form.gender = e.data.gender;
                    this.form.dob = e.data.dob;
                    this.form.pob = e.data.pob;
                    this.form.address = e.data.address;
                    this.form.guardian = e.data.guardian;
                    this.form.guardian_address = e.data.guardian_address;
                }
            }).catch(e=>{
                if(e.response) {
                    this.AppStore.toast(e.response.data,3000,'error');
                }
            })
            ;
        }
    },

    created(){
        this.getProfile();
        this.form.user_id = this.AuthUser.id;
        console.log(this.form);
    }
};
</script>

