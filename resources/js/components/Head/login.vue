
<template>

    <v-app>
        <v-main>
            <v-container>

                <v-row>

                    <v-dialog width="50%"
                        v-model="login_result">

                        <v-card height="100">

                            <v-card-text class="black--text" style="font-family:Comic Sans MS">
                                <h2 style="justify-self:center">{{response.login_response}}</h2>
                            </v-card-text>

                            <v-card-actions>
                                <v-row style="justify-content:center">
                                    <v-btn color="black" class="white--text" @click="response.login_result ? $router.push({path:'/home'}) : $router.push({path:'/register'}) ">
                                        OK
                                    </v-btn>

                                </v-row>
                            </v-card-actions>

                        </v-card>

                    </v-dialog>

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
                                                <span class="text-danger" v-if="errors.email">
                                                    {{errors.email[0]}}
                                                </span>
                                            </v-col>
                                        </v-row>

                                        <v-row class="d-flex" dense style="display:flex;justify-content:center">
                                            <v-col cols="8">
                                                <v-text-field dense outlined type="password" label="Password" color="black" v-model="head.password"  :rules="[() => !!head.password || 'This field is required']" >
                                                </v-text-field>
                                                <span class="text-danger" v-if="errors.password">
                                                    {{errors.password[0]}}
                                                </span>
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

import User from './../../Apis/User'
import CSRF from './../../Apis/CSRF'
// import axios from 'axios';
// axios.defaults.withCredentials = true
// axios.defaults.baseURL='http://127.0.0.1:8000'
export default ({
    data(){
        return{
            head:{email:"",password:""},
            errors:'',
            response:[],
            login_result:null
        }
    },
    created()
    {
    },
    methods:{
        onHeadLogin:function()
        {
                let _vue = this;
                CSRF.getCookies().then(()=>{
                    User.login(this.head).catch(error => {
                        if(error.response.status === 422)
                        {
                            this.errors = error.response.data.errors;
                        }
                    }).then(()=>{
                        User.fetchUser().then(response => {
                            this.response.login_response = "Login Successfully";
                            console.log(this.response);
                            this.response.login_result = true;
                            this.login_result = true;
                            // this.$router.push({path:'/actions'});
                            _vue.$emit('loggedin',true);
                        });
                    });

                });


            // axios.get('/api/csrf-cookie').then(data => {

            //     axios.post('/login',{
            //             email:'ankit@gmail.com',
            //             password:'passpass'
            //         }).then(() =>{
            //             axios.get('http://127.0.0.1:8000/api/user').then(() =>{
            //                     this.$router.push('/actions');
            //                     //   this.$emit('loggedin',true);
            //                 });

            //    });

            // });
        }
    }

})
</script>
