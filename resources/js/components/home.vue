<template>
        <v-app>
            <v-main>
                <v-container>

                    <v-row class="mt-2" style="display:flex;justify-content:center">
                        <v-card color="black" height="120px" style="display:flex;justify-content:center">
                            <v-col cols="12" md="8" class="ml-1">
                                <h1 style="color:white;font-family:Roboto">
                                    Welcome back {{user.name}}
                                    <router-link :to="{path:'/marksheet/create'}" style="text-decoration:none">
                                        Continue
                                    </router-link>creating marksheets
                                </h1>
                            </v-col>
                        </v-card>
                    </v-row>

                </v-container>
            </v-main>
        </v-app>
</template>

<script>
import User from './../Apis/User'
export default {
    data() {
        return {
            user:{'name':''}
        };
    },

    created(){
        User.fetchUser().then((response)=>{
            this.user = response.data;
        });

    }
};
</script>
