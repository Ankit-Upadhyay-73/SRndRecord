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

                               Profile Response

                            </v-card-title>

                            <v-card-text
                                class="black--text"
                                style="font-family:Comic Sans MS"
                                >
                                <h3 style="justify-self:center">
                                    {{profile_response.text}}
                                </h3>
                            </v-card-text>

                            <v-card-actions>
                                <v-row style="justify-content:center">
                                    <v-btn color="black" class="white--text"
                                        @click="event_response=false"
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
                <v-card shaped >
                    <v-card-title>
                        Add College Details
                    </v-card-title>
                    <v-card-text>
                        <v-form>
                            <v-row
                                justify="center">

                                <v-col
                                    md="6" cols="12">

                                    <v-img :src="fetchedCollege.logo">

                                    </v-img>


                                </v-col>

                                <v-col
                                    md="6" cols="12">
                                    <v-file-input
                                        ref="logo"
                                        dense
                                        v-model="college.logo"
                                        placeholder="Pick a Logo"
                                        label="College Logo"
                                        color="black"
                                        @change="addCollegeLogo"
                                        outlined
                                    >
                                    </v-file-input>
                                </v-col>
                            </v-row>

                            <v-row justify="center">

                                <v-col
                                    md="6" cols="12">

                                    <v-img :src="fetchedCollege.stamp" >

                                    </v-img>

                                </v-col>


                                <v-col cols="12" md="6">
                                    <v-file-input
                                        dense
                                        ref="stamp"
                                        v-model="college.stamp"
                                        placeholder="Pick a Stamp"
                                        color="black"
                                        label="Stamp"
                                        @change="addCollegeStamp"
                                        outlined
                                    ></v-file-input>
                                </v-col>

                            </v-row>
                            <v-row justify="center">
                                <v-col cols="12" md="6">
                                    <v-text-field
                                        :rules="[v=>!!v || 'Address Required']"
                                        dense
                                        v-model="college.address"
                                        prepend-icon="mdi-map-marker"
                                        accept="image/png, image/jpeg, image/bmp"
                                        placeholder="College Info"
                                        label="place"
                                        color="black"
                                        outlined
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                            <v-row justify="center">

                                <v-col cols="4"
                                    color="black"
                                    class="white--text"
                                    style="font-family:Comic Sans MS">

                                    <v-btn class="text-captialize"
                                            @click="submitCollegeDetails">
                                        Update Details
                                    </v-btn>
                                </v-col>
                            </v-row>

                        </v-form>
                    </v-card-text>
                </v-card>
            </v-container>
        </v-main>
    </v-app>

</template>


<script>

import Api from './../../Apis/Api'

export default ({

    data(){

        return{
                college:{'address':"",'logo':null,'stamp':null},
                profile_response:[],
                event_response:false,
                fetchedCollege:[]
        }

    },

    methods:{

        addCollegeLogo(){

        },

        addCollegeStamp(){

        },

        submitCollegeDetails(){

            console.log(this.college);

            // Api.post('/college/update',this.college).then(()=>{

            //     console.log(data);

            // })


            let collegeFormData = new FormData();

            if(this.college.logo!='' && this.college.stamp!='' && this.college.address!=''){

                collegeFormData.append("stamp",this.college.stamp);
                collegeFormData.append("logo",this.college.logo);
                collegeFormData.append("address",this.college.address);
                Api.post('/api/college/update',collegeFormData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then((response)=>{

                        if(response.status==200){
                            this.event_response = true;
                            this.profile_response.text = response.data["message"];
                            this.profile_response.success = true;
                        }

                    }).catch(error =>{

                        if(error.response.status==400){
                            this.event_response = true;
                            this.profile_response.text = response.data["message"];
                            this.profile_response.success = false;
                        }

                    });
            }

        }

    },
    created(){

        Api.get('/api/college').then(response=>{

            this.fetchedCollege = response.data;

        });

    }

})


</script>

