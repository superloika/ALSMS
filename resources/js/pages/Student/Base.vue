<template>
    <div>
        <v-app-bar app class="elevation-0" dark color="primary">
            <v-toolbar-title class="ml-1 pr-12">
                <div class="d-flex">
                    <!-- <a href="/">
                        <v-img
                            contain
                            max-width="150"
                            lazy-src="/img/alsms_banner_sm.png"
                            src="/img/alsms_banner_sm.png"
                            class="mr-2"
                        ></v-img>
                    </a> -->
                    <span>Laravel + Vuetify</span>
                </div>
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <v-tabs centered hide-slider class="hidden-sm-and-down">
                <v-tab to="/student/dashboard" class="font-weight-bold">
                    Dashboard
                </v-tab>
                <v-tab to="/student/about" class="font-weight-bold">
                    Test 1
                </v-tab>
                <v-tab to="/student/about2" class="font-weight-bold">
                    Test 2
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
                    <v-list-item link to="/student/dashboard">
                        <v-list-item-icon class="mr-2">
                            <v-icon>mdi-file-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Dashboard</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link to="/student/test">
                        <v-list-item-icon class="mr-2">
                            <v-icon>mdi-file-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Test</v-list-item-title>
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
            <v-container class="pt-4">
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
    }
}
</script>
