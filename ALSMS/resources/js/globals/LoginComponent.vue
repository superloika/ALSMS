<template>
    <div>
        <div class="d-flex py-4 justify-center px-16">
            <a href="/">
                <v-img
                    contain
                    max-width="150"
                    lazy-src="img/alsms_banner_sm.png"
                    src="img/alsms_banner_sm.png"
                    class="mr-2"
                ></v-img>
            </a>
        </div>
        <v-card max-width="400" min-width="300" class="elevation-0">
            <v-card-text>
                <v-alert dense type="error" dismissible transition="scale-transition"
                    v-if="error_username" text>
                    {{ error_username }} <br> {{ error_password }}
                </v-alert>
                <form method="POST" action="">
                    <input type="hidden" name="_token" :value="CsrfToken">
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                label="Username"
                                placeholder="Username"
                                name="username"
                                type="text"
                                class="mb-3"
                                :value="old_username"
                                filled
                                hide-details
                            ></v-text-field>

                            <v-text-field
                                label="Password"
                                placeholder="Password"
                                name="password"
                                :type="showPassword ? 'text' : 'password'"
                                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                @click:append="showPassword = !showPassword"
                                autocomplete="false"
                                class="mb-3"
                                filled
                                hide-details
                            ></v-text-field>
                            <div class="float-right">
                                <v-btn @click.stop="isLogging=true" color="primary"
                                    rounded
                                    type="submit" :loading="isLogging">Login</v-btn>
                            </div>
                        </v-col>
                    </v-row>
                </form>
            </v-card-text>
            <v-card-actions class="d-flex justify-center">
                <a href="/register">Register an Account</a>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>
export default {
    props: {
        old_username: null,
        error_username: null,
        error_password: null,

    },
    data: () => ({
        isLogging: false,
        showPassword: false,
    }),

    watch: {

    },

    mounted() {
        console.log('LoginComponent mounted');
    }
};
</script>
