<template>
    <div>
        <v-row>
            <v-col>
                <Enrolled></Enrolled>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    components: {
        Enrolled: ()=>import('./Enrolled'),
        // Available: ()=>import('./Available'),
        // Requested: ()=>import('./Requested'),
    },
    data() {
        return {
            tabs: 0,
        }
    },

    created() {
        // this.StudentClassesStore.all(this.SyStore.state.activeSY.id);
        this.StudentClassesStore.studentEnrollment(this.SyStore.state.activeSY.id);
    },
}
</script>
