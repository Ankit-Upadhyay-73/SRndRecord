<template>

    <v-app>
        <v-main>
            <v-container>
                        <v-row class="d-flex" dense >
                            <v-dialog
                                    v-model="isAdded"
                                    width="400">
                                <v-card>
                                    <v-card-title class="headline grey lighten-2">
                                        Student Added Successfully
                                    </v-card-title>
                                    <v-card-text>
                                        {{responseMessage}}
                                    </v-card-text>
                                </v-card>
                            </v-dialog>
                        </v-row>

                <v-row>

                    <v-col cols="12"  class="d-flex justify-content-center">

                            <v-card shaped style="width:100%">

                                <v-card-title style="background-color:black">
                                    <h4 style="font-family:Comic Sans MS;color:white">Add Student</h4>
                                </v-card-title>

                                <v-card-text>

                                    <form class="mt-2">

                                        <v-row class="d-flex" dense style="display:flex;justify-content:center">
                                            <v-col cols="8">
                                                <v-text-field dense outlined label="Name" color="black" v-model="student.name">
                                                </v-text-field>
                                            </v-col>
                                        </v-row>

                                        <v-row class="d-flex" dense style="display:flex;justify-content:center">
                                            <v-col cols="8">
                                                <v-text-field dense outlined label="Email" color="black" v-model="student.email">
                                                </v-text-field>
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
            student:{name:"",email:"",password:"",phone:""},
            isAdded:false,
            responseMessage:'',
        }
    },
    mounted(){

        User.fetchUser().then((user)=>{
            console.log(user);
        });

    },
    methods:{
        onAddStudent()
        {
            Api.post('/api/student',this.student).then((response) =>{
                if(response.data["email"]==this.student.email)
                {
                    this.isAdded = true;
                    this.responseMessage = "Saved Successfully"
                    this.$router.push('/student');
                }
                else
                    {
                        this.responseMessage = response.data["message"];
                    }

            });
        }
    }

})
</script>
