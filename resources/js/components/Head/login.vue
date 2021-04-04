
<template>
    <v-app>
        <v-main>
            <v-dialog 
                width="50%"
                v-model="event_response"
                >
                <v-card>

                    <v-card-text 
                        class="black--text" 
                        style="font-family:Comic Sans MS"
                        >

                        <h2 style="justify-self:center">
                            {{login_response.text}}
                        </h2>
                    </v-card-text>

                    <v-card-actions>
                        <v-row style="justify-content:center">
                            <v-btn color="black" class="white--text" 
                                    @click="login_response.success ? $router.push({path:'/home'}) : $router.push({path:'/register'}) "
                                >
                                OK
                            </v-btn>
                        </v-row>
                    </v-card-actions>
                </v-card>

            </v-dialog> 

            <v-container>

                <v-row class="justify-center mt-3">

                    <h2>
                        Login with your Registered details to continue.
                    </h2>

                </v-row>

                <v-row class="justify-center">

                    <!-- login fields -->
                    <v-col 
                        cols="12" 
                        md="8"
                        >

                        <v-card shaped >

                            <v-card-title style="background-color:black">
                                <h4 class="white--text">Login</h4>
                            </v-card-title>

                            <v-card-text>
                                <!-- form for input fiels -->
                                <form>
                                    <v-row 
                                        class="mt-2" 
                                        dense 
                                        style="display:flex;justify-content:center"
                                        >
                                        <v-col cols="8">
                                            <v-text-field
                                                dense
                                                outlined 
                                                placeholder="eg John@gmail.com" 
                                                label="Email" 
                                                color="black"
                                                prepend-inner-icon="mdi-email"
                                                v-model="credentials.email"    
                                                :rules="[() => !!credentials.email || 'This field is required']" 
                                                >

                                            </v-text-field>

                                            <span class="text-danger" v-if="errors.email">
                                                {{errors.email[0]}}
                                            </span>

                                        </v-col>
                                    </v-row>

                                    <v-row 
                                        class="d-flex" 
                                        dense 
                                        style="display:flex;justify-content:center"
                                        >

                                        <v-col cols="8">
                                            <v-text-field 
                                                dense 
                                                outlined 
                                                type="password" 
                                                label="Password" 
                                                color="black" 
                                                prepend-inner-icon="mdi-account-key"
                                                v-model="credentials.password"  
                                                :rules="[() => !!credentials.password || 'This field is required']" 
                                            >
                                            </v-text-field>
                                            <span class="text-danger" v-if="errors.password">
                                                {{errors.password[0]}}
                                            </span>
                                        </v-col>
                                    </v-row>

                                    <v-row
                                        style="display:flex;justify-content:center"
                                        >
                                        <v-btn
                                            style="background-color:black" 
                                            text  
                                            class="white--text mr-2 text-capitalize" 
                                            @click="attemptLogin()">
                                                
                                                Login

                                            </v-btn>
                                    </v-row>
                                    <!-- </> form fields end here -->

                                    <v-divider class="mt-4"></v-divider>

                                    <!-- elements for back to register -->
                                    <span 
                                        style="font-family:Comic Sans MS;font-style:italic"
                                        >
                                        Don't have Account
                                        <router-link to="/head/register" style="color:black">
                                            Register
                                        </router-link>
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
            credentials : {email:'',password:''},
            errors:'',
            event_response:false,
            login_response:[],
        }
    },
    created()
    {

    },

    methods:{

        attemptLogin:function() {

                let _vue = this;
                
                
                // @request server to generate specific token and 
                // set Cokkie for request and response

                CSRF.getCookies().then(()=>{

                    User.login(this.credentials).catch(error => {
                            if(error.response.status === 422)
                            {
                                this.errors = error.response.data.errors;
                            }})
                                .then(()=>{

                                    User.fetchUser().catch(fetch_error => {

                                            if(fetch_error.response.status == 401)
                                            {
                                                this.errors = error.response.data;
                                                this.login_response.text = "Unthorized request";
                                                this.login_response.success = false;
                                                this.event_response = true;
                                            }
                                        })
                                        .then(response =>
                                            {
                                                this.login_response.text = "Login Successfully";
                                                this.login_response.success = true;
                                                this.event_response = true;
                                                // notify .. user is logged in
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

<style>

    body{
        font-family: "Open Sans", sans-serif;
    }    

    .font-Merriweather{
        font-family: Merriweather,serif;
    }

</style>
