<template>
    <div>
        <div>
            <span class="text-h5 primary--text">Learning Programs</span>
        </div>
        <div>
            Listed below are the available learning programs you can enroll
        </div>
        <div class="pt-4">
            <v-data-table :headers="tableHeaders" :items="StudentProgramsStore.state.programs">
                <template v-slot:[`item.actions`]="{item}">
                    <v-btn dense color="primary" small>
                        Enroll
                    </v-btn>
                </template>
            </v-data-table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tableHeaders: [
                {text:"Title", value:"title"},
                {text:"Description", value:"description_short"},
                {text:"Actions", value:"actions"},
            ]
        }
    },

    created() {
        this.StudentProgramsStore.getPrograms();
    }
}
</script>
