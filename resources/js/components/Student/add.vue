<template>

    <v-app>
        <v-main>

            <v-row class="justify-center" v-if="event_response">
                <v-col>
                    <v-dialog
                        v-model="event_response"
                        width="400">
                        <v-card height="150">

                            <v-card-title class="black white--text">

                                Subject Response

                            </v-card-title>

                            <v-card-text
                                class="black--text"
                                style="font-family:Comic Sans MS"
                                >
                                <h3 style="justify-self:center">
                                    {{student_response.text}}
                                </h3>
                            </v-card-text>

                            <v-card-actions>
                                <v-row style="justify-content:center">
                                    <v-btn color="black" class="white--text"
                                        @click="student_response.success ? $router.push({path:'/students'}) : event_response=false"
                                        >
                                        OK
                                    </v-btn>
                                </v-row>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-col>
            </v-row>


            <span>You can create marksheet of these students by inputting their marks</span>

            <v-container>

                <v-row dense>
                    <h3>
                        Add New Student in {{course.name}}
                    </h3>

                    <v-spacer></v-spacer>

                    <v-btn dark @click="$router.push({path:'/students'})">
                        List Students
                    </v-btn>
                </v-row>

                <v-row class="d-flex" dense >

                    <v-dialog
                        v-model="event_response"
                        width="400">
                        <v-card>
                            <v-card-text>
                                {{student_response.text}}
                            </v-card-text>
                        </v-card>
                    </v-dialog>

                </v-row>

                <v-row>
                    <v-col cols="12" md="8" class="d-flex justify-content-center">

                        <v-card
                            shaped
                            style="width:100%">

                            <v-card-title style="background-color:black">
                                <h4
                                    style="font-family:Comic Sans MS;color:white">
                                    Add Student
                                </h4>
                            </v-card-title>

                            <v-card-text>
                                <form class="mt-2">
                                    <v-row class="d-flex" dense style="display:flex;justify-content:center">
                                        <v-col cols="8" md="7">
                                            <v-text-field
                                                dense
                                                outlined
                                                label="Name"
                                                prepend-inner-icon="mdi-human-child"
                                                color="black"
                                                v-model="student.name">
                                            </v-text-field>
                                        </v-col>

                                        <v-col cols="12" md="6" >
                                                <span  class="red--text" v-if="errors.name!=undefined">{{errors.name[0]}}</span>
                                        </v-col>

                                    </v-row>

                                    <v-row class="d-flex" dense style="display:flex;justify-content:center">
                                        <v-col cols="8" md="7">
                                            <v-text-field
                                                dense
                                                outlined
                                                label="Email"
                                                prepend-inner-icon="mdi-email"
                                                color="black"
                                                v-model="student.email">
                                            </v-text-field>
                                        </v-col>
                                           <v-col cols="12">
                                                <span class="red--text" v-if="errors.email!=undefined">{{errors.email[0]}}</span>
                                        </v-col>
                                    </v-row>

                                    <v-row class="d-flex" dense justify="center">
                                        <v-btn
                                            text class="white--text text-capitalize" outlined style="background-color:black" @click="onAddStudent()">
                                            <span style="font-family:Roboto">Add</span>
                                        </v-btn>
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
import Api from './../../Apis/Api'

export default({

    data(){
        return{
            course:[],
            student:{name:"",email:"",password:"",phone:""},
            event_response:false,
            student_response:[],
            errors:[]
        }
    },
    mounted(){

        Api.get('/api/course').then(response =>{

            this.course =  response.data;

        });

    },
    methods:{
        onAddStudent()
        {
            Api.post('/api/students',this.student)
                    .then((response) =>{
                        if(response.status==201)
                        {
                            this.event_response = true;
                            this.student_response.text = "Saved Successfully";
                            this.student_response.success = true;
                        }
                    }).catch(error=>{

                        if(error.response.status==400)
                        {
                            this.student_response.text = error.response.data["message"];
                            this.student_response.success = false;
                            this.event_response = true;
                        }

                       if(error.response.status==422)
                        {
                            this.errors = error.response.data.errors;
                        }

                });
        }
    }

})
</script>
