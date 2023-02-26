<template>
    <v-card class="elevation-0">
        <v-card-title>
            Edit
        </v-card-title>
        <v-card-subtitle>
            Edit class
        </v-card-subtitle>
        <v-card-text class="pt-4">
            <v-row>
                <v-col cols="12">
                    <v-select
                        label="Learning Program"
                        :items="programs"
                        item-text="title"
                        item-value="id"
                        v-model="ClassesStore.state.editClassObj.program_id"
                    >
                    </v-select>
                </v-col>
                <v-col cols="12">
                    <v-select
                        label="Teacher"
                        :items="teachers"
                        item-value="id"
                        v-model="ClassesStore.state.editClassObj.teacher_id"
                    >
                        <template slot="selection" slot-scope="data">
                            {{ data.item.firstname }} {{ data.item.middlename }} {{ data.item.lastname }}
                        </template>
                        <template slot="item" slot-scope="data">
                            {{ data.item.firstname }} {{ data.item.middlename }} {{ data.item.lastname }}
                        </template>
                    </v-select>
                </v-col>
                <v-col cols="12">
                    <v-select
                        label="CLC"
                        :items="clcs"
                        item-value="id"
                        v-model="ClassesStore.state.editClassObj.clc_id"
                    >
                        <template slot="selection" slot-scope="data">
                            {{ data.item.name }}
                        </template>
                        <template slot="item" slot-scope="data">
                            {{ data.item.name }}
                        </template>
                    </v-select>
                </v-col>
                <v-col cols="12">
                    <label class="font-weight-bold">Class Schedules</label><br><br>
                    <v-select
                        label="Day"
                        placeholder="Select day here"
                        :items="[
                            {text:'Sunday', value:'sched_sun'},
                            {text:'Monday', value:'sched_mon'},
                            {text:'Tuesday', value:'sched_tue'},
                            {text:'Wednesday', value:'sched_wed'},
                            {text:'Thursday', value:'sched_thu'},
                            {text:'Friday', value:'sched_fri'},
                            {text:'Saturday', value:'sched_sat'},
                        ]"
                        item-text="text"
                        item-value="value"
                        v-model="selectedDay"
                    >
                    </v-select>
                    <div>
                        <label>Time From:</label>
                        <input type="time" v-model="timeFrom" :max="timeTo"/>
                        &nbsp;
                        <label>Time To:</label>
                        <input type="time" v-model="timeTo" :min="timeFrom"/>
                        <v-btn small dense rounded color="primary"
                            :disabled="selectedDay=='' || timeFrom=='' || timeTo==''"
                            @click="applySched">Apply</v-btn>
                    </div>
                    <br>
                    <div style="border:1px dotted lightgrey;padding:3px;">
                        <div>
                            Sunday: {{ ClassesStore.state.editClassObj.sched_sun }}
                            <v-btn icon small color="error" v-if="ClassesStore.state.editClassObj.sched_sun!=''"
                                @click="ClassesStore.state.editClassObj.sched_sun=''"
                            >x</v-btn>
                        </div>
                        <div>
                            Monday: {{ ClassesStore.state.editClassObj.sched_mon }}
                            <v-btn icon small color="error" v-if="ClassesStore.state.editClassObj.sched_mon!=''"
                                @click="ClassesStore.state.editClassObj.sched_mon=''"
                            >x</v-btn>
                        </div>
                        <div>
                            Tuesday: {{ ClassesStore.state.editClassObj.sched_tue }}
                            <v-btn icon small color="error" v-if="ClassesStore.state.editClassObj.sched_tue!=''"
                                @click="ClassesStore.state.editClassObj.sched_tue=''"
                            >x</v-btn>
                        </div>
                        <div>
                            Wednesday: {{ ClassesStore.state.editClassObj.sched_wed }}
                            <v-btn icon small color="error" v-if="ClassesStore.state.editClassObj.sched_wed!=''"
                                @click="ClassesStore.state.editClassObj.sched_wed=''"
                            >x</v-btn>
                        </div>
                        <div>
                            Thursday: {{ ClassesStore.state.editClassObj.sched_thu }}
                            <v-btn icon small color="error" v-if="ClassesStore.state.editClassObj.sched_thu!=''"
                                @click="ClassesStore.state.editClassObj.sched_thu=''"
                            >x</v-btn>
                        </div>
                        <div>
                            Friday: {{ ClassesStore.state.editClassObj.sched_fri }}
                            <v-btn icon small color="error" v-if="ClassesStore.state.editClassObj.sched_fri!=''"
                                @click="ClassesStore.state.editClassObj.sched_fri=''"
                            >x</v-btn>
                        </div>
                        <div>
                            Saturday: {{ ClassesStore.state.editClassObj.sched_sat }}
                            <v-btn icon small color="error" v-if="ClassesStore.state.editClassObj.sched_sat!=''"
                                @click="ClassesStore.state.editClassObj.sched_sat=''"
                            >x</v-btn>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-card-text>
        <v-card-actions class="pt-0 pb-6 d-flex justify-end">
            <v-btn color="primary" @click="update()">
                Save Changes
            </v-btn>
        </v-card-actions>
    </v-card>
</template>


<script>
export default {
    data() {
        return {
            // form: {
            //     sy_id: '',
            //     program_id: '',
            //     teacher_id: '',
            //     clc_id: '',
            // },
            selectedDay: '',
            timeFrom: '',
            timeTo: '',
        }
    },

    computed: {
        programs() {
            return this.ProgramsStore.state.programs;
        },

        teachers() {
            return this.TeachersStore.state.teachers;
        },

        clcs() {
            return this.ClcStore.state.clcs;
        }
    },

    methods: {
        // async save() {
        //     this.form.sy_id = this.SyStore.state.activeSY.id;

        //     let url = `${this.AppStore.state.siteUrl}classes/saveClass`;
        //     await axios.post(url,{
        //             data: this.form
        //         }).then(res=>{
        //             this.ClassesStore.getClasses(this.SyStore.state.activeSY.id);
        //             this.AppStore.resetForm(this.form);
        //             this.AppStore.toast(res.data, 2500,'success');
        //         }).catch(e=>{
        //             this.AppStore.toast(e, 2500,'error');
        //         })
        //         ;
        // },
        async update() {
            let url = `${this.AppStore.state.siteUrl}classes/update`;
            await axios.post(url,{
                    data: this.ClassesStore.state.editClassObj
                }).then(res=>{
                    this.AppStore.toast(res.data, 2500,'success');
                }).catch(e=>{
                    if(e.response) {
                        console.log(e.response);
                        if(e.response.status=="409") {
                            this.AppStore.toast(e.response.data, 2500,'error');
                        } else {
                            this.AppStore.toast(e, 2500,'error');
                        }
                    }
                }).finally(()=>{
                    this.ClassesStore.getClasses(this.SyStore.state.activeSY.id);
                })
                ;
        },
        applySched() {
            this.ClassesStore.state.editClassObj[this.selectedDay] = this.timeFrom + ' to ' + this.timeTo;
        }
    },

}
</script>
