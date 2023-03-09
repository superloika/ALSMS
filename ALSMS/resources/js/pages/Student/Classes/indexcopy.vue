<template>
    <v-card>
        <v-card-title>
            <span class="text-h5 primary--text">Classes</span>
        </v-card-title>
        <v-card-subtitle>
            Classes listing
        </v-card-subtitle>
        <v-card-text>
            <v-data-table :headers="tableHeaders" :items="ClassesStore.state.classes">
                <template v-slot:[`item.teacher_name`]="{item}">
                    <span>{{ item.firstname }} {{ item.middlename }} {{ item.lastname }}</span>
                </template>
                <template v-slot:[`item.actions`]="{item}">
                    <div stylex="width:100px;" class="d-flex">
                        <v-btn small color="primary" class="ml-2">
                            <!-- <v-icon>mdi-delete</v-icon> -->
                            Enroll
                        </v-btn>
                        <v-btn small color="" class="ml-2">
                            <!-- <v-icon>mdi-delete</v-icon> -->
                            More Details
                        </v-btn>
                    </div>
                </template>
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    data() {
        return {
            tableHeaders: [
                {text:"Class ID", value:"id"},
                {text:"Program", value:"program_title"},
                {text:"Teacher", value:"teacher_name"},
                {text:"Schedule", value:"schedule"},
                {text:"Actions", value:"actions"},
            ],
        }
    },

    created() {
    }
}
</script>
