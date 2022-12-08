<template>
    <div>
        <v-app-bar app class="elevation-0">
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

            <v-spacer></v-spacer>

            <v-tabs>
                <v-tab to="/admin/dashboard" class="font-weight-bold">
                    Dashboard
                </v-tab>
                <v-tab to="/admin/about" class="font-weight-bold">
                    Test
                </v-tab>
            </v-tabs>

            <!-- <span class="text-caption mr-1 overflow-auto font-weight-bold">
                    {{ AuthUser.name }}
                </span> -->

            <UserMenu></UserMenu>
        </v-app-bar>

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
                <router-view></router-view>
            </v-container>
        </v-main>
    </div>
</template>
