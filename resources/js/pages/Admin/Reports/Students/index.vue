<template>
    <v-card elevation="0">
        <v-toolbar class="elevation-0" v-if="!AppStore.state.printMode">
            <v-toolbar-title>
                List of Students
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-select
                :items="SyStore.state.sys"
                item-text="sy"
                item-value="id"
                hide-details
                dense
                placeholder="Select School Year"
                outlined
                style="max-width:150px"
                class="pl-2"
                v-model="sy_id"
            >

            </v-select>

            <v-select
                :items="ClcStore.state.clcs"
                item-text="name"
                hide-details
                dense
                placeholder="Select CLC"
                outlined
                style="max-width:300px"
                class="pl-2"
                v-model="clc"
                return-object
            >

            </v-select>

            <v-select
                :items="ProgramsStore.state.programs"
                item-text="title"
                hide-details
                dense
                placeholder="Select program"
                outlined
                style="max-width:300px"
                class="pl-2"
                v-model="program"
                return-object
            >

            </v-select>
            <v-btn
                dense color="primary"
                class="ml-2"
                @click="print"
                :disabled="!students.length"
            >
                Print
            </v-btn>
        </v-toolbar>
        <v-card-text>
            <div v-if="!students.length" style="text-align:center">
                <em>Select filters above to generate report</em>
            </div>
            <div v-if="students.length">
                <div style="display:flex" class="justify-center">
                    <div class="pr-6">
                        <v-img
                            max-height="100"
                            max-width="100"
                            src="/img/deped_seal.webp"
                        ></v-img>
                    </div>
                    <div style="text-align:center" class="">
                        <div>{{ program.title }}</div>
                        <div>{{ clc.name }}</div>
                        <div>{{ clc.address }}</div>
                        <div>{{ students[0].teacher_fullname }}</div>
                        <div class="pt-3 text-h6">List of Students</div>
                    </div>
                    <div class="pl-6">
                        <v-img
                            max-height="100"
                            max-width="100"
                            src="/img/alsms-logo.png"
                        ></v-img>
                    </div>
                </div>
                <br>
                <br>
                <v-row>
                    <v-col cols="6">
                        <div class="font-weight-bold">Male</div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(s,i) in students.filter(e=>e.gender=='Male')" :key="i">
                                    <td>{{ s.fullname }}</td>
                                    <td>{{ s.address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </v-col>
                    <v-col cols="6">
                        <div class="font-weight-bold">Female</div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(s,i) in students.filter(e=>e.gender=='Female')" :key="i">
                                    <td>{{ s.fullname }}</td>
                                    <td>{{ s.address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </v-col>
                </v-row>
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    data() {
        return {
            students: [],
            sy_id: '',
            clc: '',
            program: '',
        }
    },

    methods: {
        async generate(sy_id, clc_id, program_id) {
            if(sy_id=='' || clc_id=='' || program_id=='') return;
            let url = `${this.AppStore.state.siteUrl}reports/getStudents?sy_id=${sy_id}&clc_id=${clc_id}&program_id=${program_id}`;
            await axios.get(url).then(res=>{
                    this.students = res.data;
                }).catch(e=>{
                    this.AppStore.toast(e, 2500,'error');
                })
                ;
            // try {

            // } catch (error) {
            // }
        },

        print() {
            this.AppStore.state.printMode=true;
            setTimeout(()=>{
                window.print();
                this.AppStore.state.printMode=false;

            }, 50)
        }

    },

    watch: {
        clc() {
            this.generate(this.sy_id,this.clc.id,this.program.id);
        },
        program() {
            this.generate(this.sy_id,this.clc.id,this.program.id);
        },
        sy_id() {
            this.generate(this.sy_id,this.clc.id,this.program.id);
        }
    },

    created() {
        this.sy_id = this.SyStore.state.activeSY.id;
    }

}
</script>


<style scoped>
    table {
        width:100%;
        border-collapse:collapse;
    }
    th, tr, td {
        border: 1px solid #ddd;
    }
    td {
        padding: 5px;
    }
</style>
