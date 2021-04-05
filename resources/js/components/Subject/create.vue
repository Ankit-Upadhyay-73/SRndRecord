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
                                    {{subject_response.text}}
                                </h3>
                            </v-card-text>

                            <v-card-actions>
                                <v-row style="justify-content:center">
                                    <v-btn color="black" class="white--text"
                                        @click="subject_response.success ? $router.push({path:'/subjects'}) : event_response=false"
                                        >
                                        OK
                                    </v-btn>
                                </v-row>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-col>

            </v-row>

            <v-container>
                <h3 align-center class="black--text mt-2">Add Subject in {{course.name}}</h3>

                <v-row>
                    <v-col
                        cols="12" md=8
                        class="justify-center mt-3">

                        <v-card shaped
                                style="width:100%">
                            <v-card-title
                                style="background-color:black">
                                    <h4 style="font-family:Comic Sans MS;color:white">
                                        Add Subject
                                    </h4>
                            </v-card-title>

                            <v-card-text>
                                <form class="mt-2">
                                    <v-row class="d-flex justify-center"
                                        dense
                                        >
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                dense
                                                outlined
                                                label="Name"
                                                color="black"
                                                prepend-inner-icon="mdi-pen"
                                                v-model="subject.name"
                                            >
                                            </v-text-field>
                                        </v-col>
                                    </v-row>

                                    <v-row class="d-flex"
                                        dense
                                        style="display:flex;justify-content:center"
                                        >
                                        <v-col cols="12" md="6">
                                            <v-text-field dense
                                                outlined
                                                label="weightage"
                                                color="black"
                                                prepend-inner-icon="mdi-numeric"
                                                v-model="subject.weightage"
                                                type="number"
                                                >
                                            </v-text-field>
                                        </v-col>
                                    </v-row>

                                    <v-row class="justify-center">
                                            <v-col cols="12" md="6">
                                                <v-text-field
                                                    dense
                                                    outlined
                                                    label="Passing Mark"
                                                    prepend-inner-icon="mdi-numeric"
                                                    color="black"
                                                    v-model="subject.passing"
                                                    type="number"
                                                >
                                            </v-text-field>
                                        </v-col>
                                    </v-row>

                                    <v-row
                                        class="justify-center"
                                        dense
                                        >
                                        <v-btn text
                                            class="white--text text-capitalize"
                                            outlined
                                            style="background-color:black"
                                            v-on:click="addSubject()"
                                        >
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

import Api from './../../Apis/Api'
import User from './../../Apis/User'
export default({
    data(){
        return{
            subject_response:[],
            subject:{name:"",weightage:"",passing:""},
            course:[],
            event_response:false

        }
    },
    methods:{

        addSubject(){

            Api.post('/api/subjects',this.subject).then(response => {

                if(response.status==201){

                    this.subject_response.success = true;
                    this.subject_response.text =  "Subject Added Successfully";
                    this.event_response = true;
                }

            }).catch(error =>{
                if(error.response.status==400)
                {
                    this.subject_response.success = false;
                    this.subject_response.text =  "Subject Already exists";
                    this.event_response = true;
                }


            });

        }

    },

    created(){

            Api.get('/api/course').then(response =>{

                this.course = response.data;

            });

    }

})
</script>
