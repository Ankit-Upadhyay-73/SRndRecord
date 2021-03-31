<template>
    <v-app>
        <v-main>
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
                                cols="12" md="6">
                                <v-file-input
                                    ref="logo"
                                    dense
                                    v-model="college.logo"
                                    placeholder="Pick a Logo"
                                    prepend-icon="mdi-camera"
                                    label="College Logo"
                                    color="black"
                                    @change="addCollegeLogo"
                                    outlined
                                >
                                </v-file-input>
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-file-input
                                    dense
                                    ref="stamp"
                                    v-model="college.stamp"
                                    placeholder="Pick a Stamp"
                                    prepend-icon="mdi-camera"
                                    color="black"
                                    label="Stamp"
                                    @change="addCollegeStamp"
                                    outlined
                                ></v-file-input>
                            </v-col>

                            <v-col cols="12" md="10">
                                <v-text-field
                                    :rules="[v=>!!v || 'Address Required']"
                                    dense
                                    v-model="college.address"
                                    prepend-icon="mdi-location"
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

import Api from './../../../../Apis/Api';

export default ({

    data(){

        return{
                college:{'address':"",'logo':null,'stamp':null}

        }

    },

    methods:{

        addCollegeLogo(){



        },

        addCollegeStamp(){

        },

        submitCollegeDetails(){

            // console.log(this.college);

            // Api.post('/college/update',this.college).then(()=>{

            //     console.log(data);

            // })


            let collegeFormData = new FormData();

            if(this.college.logo!='' && this.college.stamp!='' && this.college.address!=''){

                collegeFormData.append("stamp",this.college.stamp.name);
                collegeFormData.append("logo",this.college.logo.name);
                collegeFormData.append("address",this.college.address);
                Api.post('/college/update',collegeFormData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((data)=>{
                        console.log(data);
                })

            }


        }

    }

})


</script>

