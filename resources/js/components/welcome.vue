<template>
    <v-app>
        <v-main>
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
import User from './../Apis/User'
    export default {
        data() {
            return {
                showLoginRegisterMenu:true
            };
        },
        created(){
            // User.fetchUser().then(data => {
            //     if(data["data"]!=undefined)
            //     {
            //             this.$router.push({path:'/actions'});
            //             this.$emit("loggedin",true);
            //     }

            //     // this.$router.push({path:'/actions'});
            // });
        },
        methods:{

        }
};
</script>
