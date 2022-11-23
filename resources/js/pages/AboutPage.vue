<template>
    <v-card elevation="0">
        <v-card-title>
            {{ AppStore.state.appName }}
        </v-card-title>
        <v-card-text>
            {{ AppStore.state.appLongName }}
        </v-card-text>

    </v-card>
</template>

<script>
    export default {
        mounted() {
            console.log('About page mounted.');
        }
    }
</script>
