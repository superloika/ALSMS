<template>
    <v-app>
        <v-app-bar app
            heightx="42"
            lightx
            light
            colorx="grey lighten-3"
            color="yellow"
            densex
            class="elevation-0"
        >
            <!-- <template v-slot:extension>
                <v-tabs centered :tabs="tabs">
                    <v-tab to="/dashboard" class="font-weight-bold">
                        Dashboard
                    </v-tab>
                    <v-tab to="/about" class="font-weight-bold">
                        Test
                    </v-tab>
                </v-tabs>
            </template> -->

            <!-- <v-btn
                @click="toggleDrawerState()"
                icon
            >&#9776;</v-btn> -->

            <v-toolbar-title class="ml-1 pr-12">
                <div class="d-flex">
                    <a href="/">
                        <v-img
                            contain
                            max-width="150"
                            lazy-src="/img/alsms_banner_sm.png"
                            src="/img/alsms_banner_sm.png"
                            class="mr-2"
                        ></v-img>
                    </a>
                    <!-- <a href="/" style="text-decoration:none;">
                        {{ AppStore.state.appLongName }}
                    </a> -->
                </div>
            </v-toolbar-title>

            <v-tabs>
                <v-tab to="/dashboard" class="font-weight-bold">
                    Dashboard
                </v-tab>
                <v-tab to="/about" class="font-weight-bold">
                    Test
                </v-tab>
            </v-tabs>

            <v-spacer></v-spacer>

            <!-- <span class="text-caption mr-1 overflow-auto font-weight-bold">
                {{ AuthUser.name }}
            </span> -->

            <UserMenu></UserMenu>

            <v-progress-linear
                :indeterminate="AppStore.state.showTopLoading"
                :active="AppStore.state.showTopLoading"
                absolute
                bottom
                stream
                color="white"
            ></v-progress-linear>
        </v-app-bar>

        <!-- top error bar (supposed to be) -->
        <!-- <v-system-bar v-if="AppStore.state.errorBar.show"
            height="20" color="red darken-4" app dark elevation="1">
            {{ AppStore.state.errorBar.msg }}
        </v-system-bar> -->

        <!-- SIDE NAV -->
        <!-- <v-navigation-drawer v-model="navDrawerState" app>
            <v-list>
                <v-list-item>
                    <v-list-item-content >
                        <v-list-item-title class="text-h6">
                            DSG
                        </v-list-item-title>
                        <v-list-item-subtitle>
                            Middleware App
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <NavSide></NavSide>

            <template v-slot:append>
                <v-footer>
                    <v-col class="text-center pa-0">
                        <div class="text-caption" >
                            &copy; 2021-{{ new Date().getFullYear() }}
                        </div>
                    </v-col>
                </v-footer>
            </template>
        </v-navigation-drawer> -->


        <!-- MAIN -->
        <v-main>
            <v-container class="pt-4">
                <v-row>
                    <v-col sm="12" md="3">
                        <v-card>
                            <v-card-title>{{ $route.meta.name }}</v-card-title>
                            <v-card-text>
                                Test Section
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col sm="12" md="9" >
                        <router-view></router-view>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>

        <!-- MISC -->
        <v-snackbar
            v-model="AppStore.state.snackBar.show"
            :timeout="AppStore.state.snackBar.timeout"
            bottom left
            :color="AppStore.state.snackBar.color"
        >
            {{ AppStore.state.snackBar.text }}
        </v-snackbar>

        <v-overlay
            :value="AppStore.state.overlay.show"
            z-index="999999"
            opacity="0.2"
        >
            <v-chip>
                <v-progress-circular
                    :value="64"
                    indeterminate
                    size="20"
                ></v-progress-circular>
                &nbsp;
                {{ AppStore.state.overlay.msg }}
            </v-chip>
        </v-overlay>


    </v-app>
</template>

<script>

export default {
    data: () => ({
        navDrawerState: null,
        tabs: null,
    }),

    // computed: {
    // },

    methods: {
        toggleDrawerState() {
            this.navDrawerState = !this.navDrawerState;
        },
    },

    watch: {

    },

    mounted() {
        console.log('BaseComponent mounted');
    }
};
</script>

<style>
    .search-field{
        border: 1px solid #f1f1f1;
    }

    /* .v-data-table__wrapper table tbody tr{

    } */
    .v-data-table__wrapper table tbody tr td.text-start{
        /* color: #222222; */
        font-size: 12px;
    }

    .theme--dark.v-data-table
    > .v-data-table__wrapper
    > table
    > tbody
    > tr:hover:not(.v-data-table__expanded__content):not(.v-data-table__empty-wrapper) {
        background-color: #000000;
    }

    div.v-tab {
        padding: 0px 5px;
    }

</style>
