
    <template>

    <v-app>

        <v-main>

            <!-- something like alert to aware them about marksheet logo and stamp -->
            <div>
                <h3 color="primary">

                    Make Sure You have added 
                        <router-link :to="{path:'/profile'}">
                            College Logo and Stamp
                        </router-link>
                    for college verified MarkSheets

                </h3>
            </div>

            <v-container>
                <h2>
                    Create Marksheet
                </h2>

                <!-- fields to input student detail for marksheet-->

                <v-row justify="center">

                    <v-col cols="12" md="4">

                        <v-autocomplete
                            :items="students"
                            :filter="customFilter"
                            color="white"
                            item-text="name"
                            label="State"
                            >

                        </v-autocomplete>

                        <v-text-field
                            :items="students"
                            item-text="name"
                            item-value="id"
                            rounded
                            outlined
                            dense
                            type="text"
                            v-model="student_id"
                            prepend-icon="mdi-human-child"
                            placeholder="Student Name" color="black">
                        </v-text-field>

                    </v-col>

                    <v-col cols="12" md="4">

                        <v-select
                            v-model="academic_year"
                            :items="years"
                            label="Academic Year"
                            prepend-icon="mdi-calendar-month"
                            dense
                            solo
                        >

                        </v-select>
                    </v-col>

                    <v-col cols="12" md="4">

                        <v-select
                            v-model="selected_exam"
                            :items="exams"
                            label="Exam Category"
                            prepend-icon="mdi-newspaper-variant"
                            dense
                            solo
                        >

                        </v-select>

                    </v-col>


                </v-row>

                <v-divider class="mt-5"></v-divider>

                <!-- Display Subject in the course -->
                
                <span style="font-family:Comic Sans MS;font-style:Italic" v-if="subject_count > 0">Subject Details</span>

                <!-- <span class="text-center">Subjects in {{course}}</span> -->

                <v-row justify="center" align="center" v-if="error_message!=null" class="mt-3">
                    <v-card>
                        <v-card-text class="black--text">

                            <h2>{{this.error_message}}</h2>

                        </v-card-text>
                    </v-card>
                </v-row>

                <!-- fields to input marks obtained in each subject -->
                <v-row justify="center">
                    <v-card class="mt-5 p-2" v-if="student_exists && subject_count>0" width="90%">
                        <v-row>
                            <v-col cols="4">
                                <span>Name</span>
                            </v-col>
                            <v-col cols="4">
                                <span>Obtained</span>
                            </v-col>
                            <v-col cols="4">
                                <span>Total</span>
                            </v-col>
                        </v-row>

                        <v-row v-for="subject in subjects" :key="subject.id" dense class="pl-2 align-center">
                            <v-col cols="4">
                                <span>{{subject.name}}</span>
                            </v-col>
                            <v-col cols="4">
                                <v-text-field placeholder="Obtained" v-model="subject.obtained" color="black"></v-text-field>
                            </v-col>

                            <v-col cols="4">
                                <span><b>/</b>{{subject.total}}</span>
                            </v-col>
                        </v-row>
                        <v-row justify="center">
                            <v-btn @click="prepareMarksheet">Create Result</v-btn>
                        </v-row>
                    </v-card>
                </v-row>
            </v-container>
        </v-main>

    </v-app>

</template>



<script>

import Api from './../../Apis/Api'
import axios from 'axios'

export default
    {
        name:'createmarksheet',

        data(){
            return{
                invalid_input:false,
                result_response:[],
                response_dialog:false,
                subjects:[],
                students:[],
                student_id:'',
                subject_count : 0,
                academic_year:null,
                selected_exam:null,
                exams : [ "SEM" , "Unit"],
                years:  [ "2019-2020" , "2020-2021"]

            }
        },

        methods:{

            findStudent(){
                this.student_exists = false;
                //find student
                Api.get('/api/student/'+this.student_id).
                            catch(error=>{
                                if(error.data.status==401)
                                    this.error_message = "UnAuthorized request";

                                if(error.data.status==422)
                                    this.error_message = "Invalid input";
                            }).
                            then((response)=>{
                                    if(response.data.status==200)
                                        this.students = response.data["students"];
                            });
            },


            prepareMarksheet(){

                for(let subject of this.subjects)
                {
                    if(subject.obtained > subject.total){
                        this.invalid_marks  = true;                        
                    }
                }

                if(this.invalid_marks){

                    this.result_response.text = "Entered marks is invalid";
                    this.response_dialog = true;

                }

                else{
                        if(!this.invalid_marks){

                            // axios({
                            //     url:'http://127.0.0.1:8000/api/marksheet/create',
                            //     data: this.subjects,
                            //     method:'POST',
                            //     responseType: 'blob'
                            //     }).then((response)=>{
                            //     const url = window.URL.createObjectURL(new Blob([response.data]));
                            //     const link = document.createElement('a')
                            //     link.href = url
                            //     link.setAttribute('download','result.pdf')
                            //     document.body.appendChild(link)
                            //     link.click()
                            // });


                            // submit marks entered to create marksheet

                            Api.post('/api/marksheet/create',
                                        {
                                            subjects:this.subjects,student:this.student_id,exam:this.selected_exam,year:this.academic_year
                                        }
                                    ).catch(error=>{

                                        if(error.data.status==401)
                                        {
                                            this.result_response.success = false;
                                            this.result_response.text = "Unauthorized request";
                                            this.response_dialog = true;
                                        }

                                        if(error.data.status==500)
                                        {
                                            this.result_response.success = false;
                                            this.result_response.text = "Server issue";
                                            this.response_dialog = true;
                                        }

                                    }).then(response =>{

                                        if(response.data.status==200)
                                        {
                                            this.result_response.success = true;
                                            this.result_response.text = "Marksheet Created Successfully";
                                            this.response_dialog = true;
                                        }
                                            
                                    });
                        }
                    }
                }
        },

        mounted(){

            Api.get('/api/fetchSubjectsWithCourse').
                catch(error =>
                        {
                            if(error.data.status==401){
                                this.error_message = "Unauthorized request";
                            }

                        }) .then(response=>{
                                    
                                    this.subjects = response.data;
                                    this.subject_count = this.subjects.length;

                                    if(this.subject_count==0)
                                    {
                                        this.response_dialog = true;
                                        this.result_response.text="Subjects not found";
                                    }

                                    for(let subject of this.subjects){
                                        subject.obtained = 0;
                                    }

                            });
        }
    }
</script>
