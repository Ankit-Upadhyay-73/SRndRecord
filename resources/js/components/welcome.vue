<template>
        <v-app>
            <v-main>
                <v-app-bar style="background-color: black">
                    <v-toolbar-title class="justify-center" style="font-family: Comic Sans MS;color:white">
                        MarkSheet
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn style="background-color:black;font-family:Comic Sans MS" class="white--text text-capitalize text-bold" v-on:click="$router.push({path:'/head/login'});">
                        Login
                    </v-btn>
                    <v-btn style="background-color:black;font-family:Comic Sans MS" class="white--text text-capitalize text-bold" v-on:click=" $router.push({path:'/head/register'});">
                        Register
                    </v-btn>
                </v-app-bar>
                <v-row class="mt-2" style="display:flex;justify-content:center">
                    <v-card color="black" height="200px" style="display:flex;justify-content:center">
                        <v-col cols="12" md="8" class="ml-1">
                            <h1 style="color:white;font-family:Roboto">Create Customized MarkSheet of Yours College Students</h1>
                            <v-btn style="background-color:black;font-family:Comic Sans MS;font-size:20px" class="white--text text-capitalize text-bold" v-on:click=" $router.push({path:'/head/login'});">
                                Continue <v-icon>mdi-forward</v-icon>
                            </v-btn>
                        </v-col>
                    </v-card>
                </v-row>

            </v-main>
        </v-app>

</template>

<script>
    export default {
        data() {
            return {
                drawer: false
            };
        },
        methods:{

        }
};
</script>
