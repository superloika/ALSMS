<template>
    <v-card>
        <v-card-title>
            <v-icon x-large color="primary">
                mdi-alert-circle-outline
            </v-icon>
            Announcements
        </v-card-title>
        <v-card-text>
            Announcements from your facilitator/teacher will appear here
            <v-select
                :items="StudentClassesStore.state.classes"
                item-value="class_id"
                v-model="selClass"
                filled
                label="Class"
                placeholder="Select class here"
            >
                <template slot="selection" slot-scope="data">
                            {{ data.item.program_title }} | {{ data.item.clc_name }}
                </template>
                <template slot="item" slot-scope="data">
                    {{ data.item.program_title }} | {{ data.item.clc_name }}
                </template>
            </v-select>

            <v-data-table :headers="tableHeaders" :items="AnnouncementStore.state.announcements"
                class="elevation-1">
            </v-data-table>
        </v-card-text>
    </v-card>

</template>


<script>
export default {
    data() {
        return {
            tableHeaders: [
                {text:"Announcements", value:"message"},
                {text:"Date", value:"created_at"},
            ],
            selClass: '',
        }
    },

    watch: {
        selClass() {
            if(this.selClass!=''){
                this.AnnouncementStore.getAnnouncements(this.selClass);
            }
        },
    },

    methods:{

    },

    created() {
        if(this.StudentClassesStore.state.classes.length){
            this.selClass=this.StudentClassesStore.state.classes[0].class_id;
        }
    },
}
</script>
