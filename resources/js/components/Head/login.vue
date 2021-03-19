
<template>

    <v-app>
        <v-main>
            <v-container>

                <v-row>

                    <v-col cols="12"  class="d-flex justify-content-center">

                            <v-card shaped style="width:100%">

                                <v-card-title style="background-color:black">
                                    <h4 style="font-family:Comic Sans MS;color:white">Login</h4>
                                </v-card-title>

                                <v-card-text>

                                    <form>
                                        <v-row class="mt-2" dense style="display:flex;justify-content:center">
                                            <v-col cols="8">
                                                <v-text-field dense outlined placeholder="eg John@gmail.com" label="Email" color="black" v-model="head.email"    :rules="[() => !!head.email || 'This field is required']" >
                                                </v-text-field>
                                            </v-col>
                                        </v-row>
                                        <v-row class="d-flex" dense style="display:flex;justify-content:center">
                                            <v-col cols="8">
                                                <v-text-field dense outlined  label="Password" color="black" v-model="head.password"  :rules="[() => !!head.password || 'This field is required']" >
                                                </v-text-field>
                                            </v-col>
                                        </v-row>
                                        <v-row style="display:flex;justify-content:center">
                                            <v-btn style="background-color:black" text  class="white--text mr-2 text-capitalize" @click="onHeadLogin()">
                                                Login
                                            </v-btn>
                                        </v-row>
                                        <v-divider class="mt-4"></v-divider>
                                        <span style="font-family:Comic Sans MS;font-style:italic">Don't have Account
                                            <router-link to="/head/register" style="text-decoration:none;color:black">Register</router-link>
                                        </span>
                                    </form>
                                </v-card-text>
                        </v-card>
                    </v-col>

                </v-row>
            </v-container>
        </v-main>
    </v-app>

</template>

<script>
import axios from 'axios';

axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://127.0.0.1:8000';

export default ({
    data(){
        return{
            head:{name:"",password:""}
        }
    },
    methods:{
        onHeadLogin:function()
        {
            axios.get('http://127.0.0.1:8000/sanctum/csrf-cookie').then(() => {
                axios.get('http://127.0.0.1:8000/api/users')
                .then((response)=>{
                    console.log(response);
                });

            });
        }
    }

})
</script>
