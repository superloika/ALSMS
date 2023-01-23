<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                Classes
                <v-chip small color="info">
                    SY {{ SyStore.state.activeSY.sy }}
                </v-chip>
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn outlined rounded color="primary" link to="/teacher/classes">
                Back to Classes
            </v-btn>
        </v-toolbar>
        <v-card-text>

        </v-card-text>

        <v-navigation-drawer v-model="drawer" app temporary right style="width:600px;">
            <!-- <Add></Add> -->
        </v-navigation-drawer>
    </v-card>
</template>

<script>
export default {
    components: {
        // Add: ()=>import('./Add'),
    },

    data() {
        return {

            drawer: null,
        }
    },

    methods: {

    },

    created() {

    }
}
</script>
