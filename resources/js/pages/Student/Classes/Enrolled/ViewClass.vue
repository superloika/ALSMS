<template>
    <div>
        <v-card>
            <v-card-title>
                Class Details
            </v-card-title>
            <v-card-text>
                <v-row>
                    <v-col>
                        <label>Program:</label><br>
                        <span class="font-weight-bold">{{ selectedClass.program_title }}</span><br>
                    </v-col>
                    <!-- <v-col>
                        <label>Description:</label>
                        <p>{{ selectedClass.program_description }}</p>
                    </v-col> -->
                    <v-col>
                        <label>Teacher:</label><br>
                        <span class="font-weight-bold">
                            {{ selectedClass.firstname }}
                            {{ selectedClass.middlename }}
                            {{ selectedClass.lastname }}
                        </span><br>
                    </v-col>
                    <v-col>
                        <label>Community Learning Center:</label><br>
                        <span class="font-weight-bold">{{ selectedClass.clc_name }}</span><br>
                        <em class="font-weight-bold">{{ selectedClass.clc_address }}</em><br>
                    </v-col>

                    <v-col cols="12">
                        <v-divider></v-divider><br>
                        <label>Class Schedules:</label><br>
                        <v-container stylex="border:1px dotted lightgrey;">
                            <v-chip small v-if="selectedClass.sched_sun!=''">
                                Sunday: {{ selectedClass.sched_sun }}
                            </v-chip>
                            <v-chip small v-if="selectedClass.sched_mon!=''">
                                Monday: {{ selectedClass.sched_mon }}
                            </v-chip>
                            <v-chip small v-if="selectedClass.sched_tue!=''">
                                Tuesday: {{ selectedClass.sched_tue }}
                            </v-chip>
                            <v-chip small v-if="selectedClass.sched_wed!=''">
                                Wednesday: {{ selectedClass.sched_wed }}
                            </v-chip>
                            <v-chip small v-if="selectedClass.sched_thu!=''">
                                Thursday: {{ selectedClass.sched_thu }}
                            </v-chip>
                            <v-chip small v-if="selectedClass.sched_fri!=''">
                                Friday: {{ selectedClass.sched_fri }}
                            </v-chip>
                            <v-chip small v-if="selectedClass.sched_sat!=''">
                                Saturday: {{ selectedClass.sched_sat }}
                            </v-chip>
                        </v-container>
                    </v-col>

                    <v-col md="12" sm="12">
                        <v-divider></v-divider><br>
                        <label>Attachments:</label><br>
                        <v-container class="pt-6">
                            <em class="error--text" v-if="!attachments.length">No attachments available</em>
                            <v-btn small outlined rounded color="primary" link target="_blank"
                                :to="'/storage/attachments/programs/'+ selectedClass.program_id +'/' + a"
                                v-for="(a,i) in attachments"
                                :key="i"
                                class="ma-1"
                            >
                                {{ a }}
                            </v-btn>
                        </v-container>
                    </v-col>

                    <v-col md="12" sm="12">
                        <v-divider></v-divider><br>
                        <label>Class Announcements:</label><br>
                        <v-container class="pt-6">
                            <v-data-table :headers="tableHeaders" :items="AnnouncementStore.state.announcements"
                                class="elevation-1">
                            </v-data-table>
                        </v-container>
                    </v-col>



                </v-row>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
export default {
    props: ['selectedClass'],

    data() {
        return {
            tableHeaders: [
                {text:"Announcement", value:"message"},
                {text:"Date", value:"created_at"},
            ],
        }
    },

    computed: {
        attachments() {
            return JSON.parse(this.selectedClass.attachments);
        }
    },

    created() {
        console.log('selectedClass:', this.selectedClass);
    }
}
</script>
