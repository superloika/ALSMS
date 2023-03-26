<template>
    <v-card>
        <v-card-title class="primary" v-if="isStudentView">
            <div class="text-h5 white--text">Student Profile</div>
        </v-card-title>
        <v-card-text class="pt-4">
            <v-row>
                <v-col cols="12" md="12" class="accent lighten-2 py-1">
                    <div class="font-weight-bold">Personal Information</div>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        label="First Name"
                        v-model="form.firstname"
                        filled
                        :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        label="Middle Name"
                        v-model="form.middlename"
                        filled
                        :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        label="Last Name"
                        v-model="form.lastname"
                        filled
                        :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        label="Extension Name"
                        v-model="form.extname"
                        filled
                        :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-radio-group v-model="form.gender" row
                    :readonly="!AppStore.isStudent() || !allowStudentUpdate">
                        <template v-slot:label>
                            <div>Gender</div>
                        </template>
                        <v-radio label="Male" value="Male"></v-radio>
                        <v-radio label="Female" value="Female"></v-radio>
                    </v-radio-group>
                </v-col>

                <v-col cols="12" md="2">
                    <v-menu
                        ref="dobMenu"
                        v-model="dobMenu"
                        :close-on-content-click="false"
                        transition="scale-transition"
                        offset-y
                        min-width="auto"
                        :readonly="!AppStore.isStudent() || !allowStudentUpdate"
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

                <v-col cols="12" md="1">
                    <v-text-field
                        label="Age"
                        v-model="form.age"
                        filled
                        readonly
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="6">
                    <v-text-field
                        label="Place of Birth"
                        v-model="form.pob"
                        filled
                        :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="5">
                    <v-text-field
                        label="Address"
                        v-model="form.address"
                        filled
                        :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        label="Parent/Guardian"
                        v-model="form.guardian"
                        filled
                        :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="4">
                    <v-text-field
                        label="Parent/Guardian Address"
                        v-model="form.guardian_address"
                        filled
                        :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        label="Contact Number"
                        v-model="form.contact_no"
                        filled
                        :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        label="Facebook Account"
                        v-model="form.fb_account"
                        filled
                        :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                    ></v-text-field>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="12" md="12" class="accent lighten-2 py-1">
                    <div class="font-weight-bold">Educational Information (Upon Registration)</div>
                </v-col>

                <v-col cols="12" md="12">
                    <v-radio-group v-model="form.gl_upon_registration"
                        label="Last grade level completed" row
                        :readonly="!AppStore.isStudent() || !allowStudentUpdate">
                        <v-radio
                            v-for="g in AppStore.state.gLevels"
                            :key="g"
                            :label="g"
                            :value="g"
                        >

                        </v-radio>
                    </v-radio-group>
                </v-col>

                <v-col cols="12" md="12">
                    <v-text-field
                        label="Why did you drop-out of school? (For OSY only)"
                        v-model="form.drop_reason"
                        filled
                        :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="12">
                    <v-radio-group v-model="form.attended_als"
                        label="Have you attended ALS learning sessions before?" row
                        :readonly="!AppStore.isStudent() || !allowStudentUpdate">
                        <v-radio
                            v-for="i in ['YES','NO']"
                            :key="i"
                            :label="i"
                            :value="i"
                        >

                        </v-radio>
                    </v-radio-group>
                    <v-row v-if="form.attended_als=='YES'">
                        <v-col md="6">
                            <v-text-field
                                label="Name of the Program"
                                v-model="form.als_program"
                                filled
                                :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                            ></v-text-field>
                        </v-col>
                        <v-col md="6">
                            <v-radio-group v-model="form.literacy_level"
                                label="Literacy Level" row
                                :readonly="!AppStore.isStudent() || !allowStudentUpdate">
                                <v-radio
                                    v-for="i in ['Basic','Elementary','Secondary','InfEd']"
                                    :key="i"
                                    :label="i"
                                    :value="i"
                                >

                                </v-radio>
                            </v-radio-group>
                        </v-col>
                        <v-col md="2">
                            <v-text-field
                                label="Year Attended"
                                v-model="form.program_year_attended"
                                filled
                                :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                            ></v-text-field>
                        </v-col>
                        <v-col md="5">
                            <v-radio-group v-model="form.program_completed"
                                label="Have you completed the program?" row
                                :readonly="!AppStore.isStudent() || !allowStudentUpdate">
                                <v-radio
                                    v-for="i in ['YES','NO']"
                                    :key="i"
                                    :label="i"
                                    :value="i"
                                >

                                </v-radio>
                            </v-radio-group>
                        </v-col>
                        <v-col md="5">
                            <v-text-field
                                label="If NO, state the reason"
                                v-model="form.program_inc_reason"
                                filled
                                :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-col>

                <v-col cols="12" md="12">
                    <label>What learning modality/ties do you prefer? Choose all that applies</label>
                    <v-container class="d-flex">
                        <v-checkbox
                            v-for="(i,index) in ['Face to Face','Modular Learning','Online','Radio','Others']"
                            :key="i"
                            v-model="form.modalities"
                            :label="i"
                            :value="i"
                            hide-details
                            :class="(index>0) ? 'pl-8':''"
                            :readonly="!AppStore.isStudent() || !allowStudentUpdate"
                        ></v-checkbox>
                    </v-container>
                </v-col>

                <v-col cols="12" md="12">
                    <label>Attachments</label>
                    <v-file-input
                        v-if="isStudentView && allowStudentUpdate"
                        multiple
                        label="Select files to attach"
                        chips
                        v-model="file"
                        hide-details
                        filled
                        :readonlyx="!AppStore.isStudent() || !allowStudentUpdate"
                        dense
                    ></v-file-input>
                    <v-container class="pt-6">
                        <em class="error--text" v-if="!form.attachments.length">No attachments available</em>
                        <v-btn small outlined rounded color="primary" link target="_blank"
                            :to="'/storage/attachments/'+ form.user_id +'/' + a"
                            v-for="(a,i) in form.attachments"
                            :key="i"
                        >
                            {{ a }}
                        </v-btn>
                    </v-container>
                </v-col>
            </v-row>
        </v-card-text>

        <v-card-actions class="d-flex justify-end pt-0 pr-4 pb-4"
            v-if="isStudentView && allowStudentUpdate"
        >
            <v-btn color="primary" @click="updateProfile()">Save</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>

export default {
    props: ['user_id'],

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
                age: '',
                pob: '',
                address: '',
                guardian: '',
                guardian_address: '',
                fb_account: '',
                contact_no: '',

                gl_upon_registration: '',
                drop_reason: '',
                attended_als: '',
                als_program: '',
                literacy_level: '',
                program_year_attended: '',
                program_completed: '',
                program_inc_reason: '',

                modalities: [],
                attachments: [],
            },
            //dob
            // dob: null,
            dobActivePicker: null,
            dobMenu: false,

            file: [],
            // showAttachments: false,
        };
    },

    computed: {
        isStudentView() {
            return (this.user_id=='undefined' || this.user_id==null) ? true : false;
        },
        // form_user_id() {
        //     if(this.user_id==undefined) {
        //         return this.form.user_id
        //     }
        // },
        allowStudentUpdate() {
            return true;
            // return this.form.user_id=='' || this.form.user_id==null;
        },
    },

    watch: {
        dobMenu(val){
            val && setTimeout(() => (this.dobActivePicker = 'YEAR'));
        },
        user_id() {
            console.error(this.user_id);
        },
    },

    methods: {
        test() {
            console.log('PROFILE:', this.form);
        },
        saveDOB(date) {
            this.$refs.dobMenu.save(date);
            this.form.age = this.AppStore.calculateAge(this.form.dob);
        },

        async updateProfile() {
            let frmData = new FormData();
            for(let i=0;i<this.file.length;i++) {
                frmData.append('files[' + i + ']', this.file[i]);
            }

            frmData.append('form', JSON.stringify(this.form));

            // if(confirm('If done reviewing your inputted information, press OK to proceed saving your profile otherwise press CANCEL to review.')){
            //     return;
            // }
            await axios.post(
                `${this.AppStore.state.siteUrl}student/profile/updateProfile?user_id=${this.user_id}`,
                frmData,
                {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                }
            ).then(e=>{
                this.getProfile();
                this.AppStore.toast(e.data,3000,'success');
                // this.$router.replace('/');
                window.location.href = '/';
            }).catch(e=>{
                if(e.response) {
                    // this.AppStore.toast(e.response.data,3000,'error');
                    console.error(e.response.data);
                    this.AppStore.toast('An error has occured',2000,'error');
                }
            })
            ;
        },

        async getProfile() {
            this.AppStore.state.topLoadingCtr++;
            await axios.get(
                `${this.AppStore.state.siteUrl}student/profile/getProfile?user_id=${this.user_id}`
            ).then(e=>{
                console.log('getProfile', e.data);
                if(e.data.firstname!=undefined) {
                    this.form.user_id = e.data.user_id;

                    this.form.firstname = e.data.firstname;
                    this.form.middlename = e.data.middlename;
                    this.form.lastname = e.data.lastname;
                    this.form.extname = e.data.extname;
                    this.form.gender = e.data.gender;
                    this.form.dob = e.data.dob;
                    this.form.age = this.AppStore.calculateAge(e.data.dob);
                    this.form.pob = e.data.pob;
                    this.form.address = e.data.address;
                    this.form.guardian = e.data.guardian;
                    this.form.guardian_address = e.data.guardian_address;
                    this.form.fb_account = e.data.fb_account;
                    this.form.contact_no = e.data.contact_no;
                    // educ info
                    this.form.gl_upon_registration = e.data.gl_upon_registration;
                    this.form.drop_reason = e.data.drop_reason;
                    this.form.attended_als = e.data.attended_als;
                    this.form.als_program = e.data.als_program;
                    this.form.literacy_level = e.data.literacy_level;
                    this.form.program_year_attended = e.data.program_year_attended;
                    this.form.program_completed = e.data.program_completed;
                    this.form.program_inc_reason = e.data.program_inc_reason;
                    this.form.modalities = JSON.parse(e.data.modalities);
                    this.form.attachments = JSON.parse(e.data.attachments);
                }
            }).catch(e=>{
                if(e.response) {
                    // this.AppStore.toast(e.response.data,3000,'error');
                    console.error(e.response.data);
                    this.AppStore.toast('An error has occured',2000,'error');
                }
            }).finally(()=>{
                this.AppStore.state.topLoadingCtr--;

            })
            ;
        }
    },

    created() {
        this.getProfile();
        // this.form.user_id = this.AuthUser.id;
        console.log('form',this.form);
    },

};
</script>

