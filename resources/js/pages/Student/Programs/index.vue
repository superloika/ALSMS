<template>
    <v-card>
        <v-card-title>
            <span class="text-h5 primary--text">Learning Programs</span>
        </v-card-title>
        <v-card-subtitle>
            Listed below are learning programs being offered
        </v-card-subtitle>
        <v-card-text>
            <v-data-table :headers="tableHeaders" :items="ProgramsStore.state.programs">
                <template v-slot:[`item.actions`]="{item}">
                    <v-btn small dense color="primary" small>
                        More Details
                    </v-btn>
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
                {text:"Title", value:"title"},
                {text:"Description", value:"description_short"},
                {text:"Actions", value:"actions"},
            ],
        }
    },

    created() {
        this.ProgramsStore.getPrograms();
    }
}
</script>
