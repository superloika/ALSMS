<template>
    <div>
        <v-app-bar app class="elevation-0" dark color="primary" v-if="!AppStore.state.printMode">
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
                </div>
            </v-toolbar-title>
            <v-progress-linear v-if="AppStore.state.topLoadingCtr>0" indeterminate color="error"
                absolute bottom>
            </v-progress-linear>



            <v-spacer></v-spacer>


            <v-tabs hide-slider class="hidden-sm-and-down">
                <v-tab to="/admin/dashboard" class="font-weight-bold">
                    Dashboard
                </v-tab>
                <v-tab to="/admin/enrollment" class="font-weight-bold">
                    Enrollment
                </v-tab>
                <v-tab to="/admin/maintenance" class="font-weight-bold">
                    Maintenance
                </v-tab>
                <v-tab to="/admin/reports" class="font-weight-bold">
                    Reports
                </v-tab>
            </v-tabs>

            <!-- <span class="text-caption mr-1 overflow-auto font-weight-bold">
                    {{ AuthUser.name }}
                </span> -->

            <UserMenu class="hidden-sm-and-down"></UserMenu>

            <v-btn icon dense @click="navDrawerState=true" class="hidden-md-and-up">
                <span class="text-h4">&equiv;</span>
            </v-btn>

        </v-app-bar>




        <!-- SIDE NAV -->
        <v-navigation-drawer v-model="navDrawerState" absolute temporary>
            <v-list>
                <v-list-item-group color="primary">
                    <v-list-item link to="/admin/dashboard">
                        <v-list-item-icon class="mr-2">
                            <v-icon>mdi-file-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Dashboard</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link to="/admin/maintenance">
                        <v-list-item-icon class="mr-2">
                            <v-icon>mdi-file-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Maintenance</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </v-list>

            <template v-slot:append>
                <v-container class="grey lighten-4">
                    <UserMenu></UserMenu>
                </v-container>
            </template>
        </v-navigation-drawer>

        <!-- MAIN -->
        <v-main>
            <v-container class="pt-4" fluid>
                <router-view></router-view>
            </v-container>
        </v-main>
    </div>
</template>


<script>
export default {
    data() {
        return {
            navDrawerState: null,
        }
    },

    created() {
        this.ClassesStore.getClasses(this.SyStore.state.activeSY.id);
    }
}
</script>
