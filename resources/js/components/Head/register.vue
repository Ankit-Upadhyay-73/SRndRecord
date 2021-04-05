
<template>

    <v-app>
        <!-- register popup -->
        <v-row class="space-around" v-if="event_response">
            <v-col cols="auto">

                <v-dialog
                    max-width="50%"
                    v-model="event_response"
                    persistent
                    >

                    <v-card >
                        <v-card-title>
                            Registration Response
                        </v-card-title>
                        <v-card-text
                            class="black--text justify-center"
                            >

                            <h3 style="justify-self:center">
                                {{register_response.text}}
                            </h3>

                        </v-card-text>

                        <v-card-actions>

                                <!-- buttons OK and Cancel  -->
                                <v-btn
                                    color="black"
                                    class="white--text"
                                    @click="register_response.success ? $router.push({path:'/head/login'}) : '' "
                                    >
                                    OK
                                </v-btn>

                                <v-btn
                                    color="error"
                                    @click="event_response = !event_response"
                                >
                                    Cancel

                                </v-btn>

                        </v-card-actions>

                    </v-card>

                </v-dialog>

            </v-col>
        </v-row>
        <!-- </> registration popup ends here -->


        <v-main>

            <!-- registration fields starts here -->
            <v-container>
                <v-row class="justify-center">
                    <h3 class="black--text mt-2">

                        Register with Your College, course and Personal details to Start using project.

                    </h3>
                </v-row>

                <v-row class="justify-center">
                    <v-col
                        cols="12"
                        md="8"
                        class="d-flex justify-content-center">

                        <v-card
                            shaped
                            style="width:100%">

                            <v-card-title
                                style="background-color:black">
                                <h4 class="white--text">
                                    Register
                                </h4>
                            </v-card-title>

                            <v-card-text>
                                <!-- input form for register -->

                                <form class="mt-2">

                                    <v-row
                                        class="justify-center"
                                        dense >

                                        <v-col cols="12" md="8">
                                            <v-text-field
                                                dense
                                                outlined label="College"
                                                color="black"
                                                v-model="head.college"
                                                prepend-inner-icon="mdi-school"
                                                :rules="[() => !!head.college || 'This field is required']">
                                            </v-text-field>
                                            <span class="annotation">College name is uniquely manage colleges </span>
                                        </v-col>

                                    </v-row>

                                    <v-row
                                        class="justify-center"
                                        dense
                                        >
                                        <v-col cols="12" md="8">
                                            <v-text-field
                                                dense
                                                outlined label="Course"
                                                color="black"
                                                v-model="head.course"
                                                prepend-inner-icon="mdi-alpha-c-circle-outline"
                                                :rules="[() => !!head.course || 'This field is required']">
                                            </v-text-field>
                                            <span class="annotation">Mention your course details for better student and subject management</span>
                                        </v-col>
                                    </v-row>

                                    <v-row
                                        class="justify-center"
                                        dense
                                        >

                                        <v-col cols="12" md="8">

                                            <v-text-field
                                                dense
                                                outlined
                                                label="Name"
                                                color="black"
                                                prepend-inner-icon="mdi-pen"
                                                v-model="head.name"
                                                :rules="[() => !!head.name || 'This field is required']"
                                            >
                                            </v-text-field>
                                            <span class="annotation">Your Name</span>
                                        </v-col>

                                    </v-row>

                                    <v-row
                                        class="justify-center"
                                        dense
                                        >
                                        <v-col cols="12" md="8">
                                            <v-text-field
                                                dense outlined label="Phone"
                                                color="black"
                                                v-model="head.phone"
                                                type="number"
                                                prepend-inner-icon="mdi-dialpad"
                                                :rules="[() => !!head.phone || 'This field is required']">

                                            </v-text-field>
                                            <span class="annotation">Mobile Number to uniquely identify you</span>
                                        </v-col>

                                    </v-row>

                                    <v-row
                                        dense
                                        class="justify-center"
                                        >

                                        <v-col cols="12" md="8">
                                            <v-text-field
                                                dense
                                                outlined
                                                label="Email"
                                                color="black"
                                                prepend-inner-icon="mdi-email"
                                                type="email"
                                                v-model="head.email"
                                                :rules="[() => !!head.email || 'This field is required']"
                                            >
                                            </v-text-field>
                                            <span  class="annotation">Email to update you if any, </span>
                                        </v-col>

                                    </v-row>

                                    <v-row
                                        class="justify-center"
                                        dense
                                        >
                                        <v-col cols="12" md="8">

                                            <v-text-field
                                                dense
                                                outlined
                                                label="Password"
                                                color="black"
                                                prepend-inner-icon="mdi-form-textbox-password"
                                                v-model="head.password"
                                                type="password"
                                                :rules="[() => !!head.password || 'This field is required']">
                                            </v-text-field>
                                            <span class="annotation" >Password to secure your details</span>
                                        </v-col>
                                    </v-row>

                                    <v-row
                                        dense
                                        class="justify-center"
                                        >

                                        <v-btn
                                            text
                                            class="white--text text-capitalize"
                                            outlined
                                            style="background-color:black"
                                            @click="attemptRegister()">

                                                Register

                                        </v-btn>
                                    </v-row>

                                    <v-divider class="mt-2"></v-divider>

                                    <!-- login btn if already have an account -->
                                    <v-row class="justify-start mt-3">

                                        <h3 style="font-family:Comic Sans MS" class="font-italic">Have an account ?</h3>

                                        <router-link class="black--text font-weight-bold" :to="{path:'/head/login'}" style="font-family:Comic Sans MS;font-size:14px">Login</router-link>

                                    </v-row>

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

export default (
    {
        data(){
            return{
                head:{name:'',password:'',email:'',college:'',course:'',phone:''},
                register_response:[],
                event_response:false
            }

        },
        methods:{
            attemptRegister(){

                CSRF.getCookies()
                    .then( response=>{

                        if((this.head.name ||
                            this.head.password ||
                            this.head.email ||
                            this.head.college ||
                            this.head.course ||
                            this.head.phone)!='')
                            {
                                User.register(this.head)
                                    .catch(error => {

                                        console.log(error);
                                        // input data validation on server

                                        if(error.response.status==406)
                                        {
                                            this.register_response.success = false;
                                            this.register_response.text = "Unacceptable Input"
                                            this.event_response = true;
                                        }

                                        // if already registered throw 422 the (data can't be processed)
                                        if(error.response.status==422)
                                        {
                                            this.register_response.success = false;
                                            this.register_response.text = "Seems that you are already registered."
                                            this.event_response = true;
                                        }

                                    })
                                        .then(
                                            (data)=>{
                                                //registered successfully
                                                if(data!=undefined){
                                                    if(data.status==201)
                                                    {
                                                        this.event_response = true;
                                                        this.register_response.text = "Registered Successfully";
                                                        this.register_response.success = true;
                                                    }

                                                }
                                        });
                            }
                    })
            }
    }
})
</script>

<style>

    .annotation{
        font-style: italic;
        color:lightgreen;
    }

</style>
