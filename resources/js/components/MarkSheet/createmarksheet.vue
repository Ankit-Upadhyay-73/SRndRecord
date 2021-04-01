
    <template>

    <v-app>

        <v-main>

            <v-container>
                <h2>Create Marksheet</h2>
                <v-row justify="center">
                    <v-col cols="6" md="4">
                        <v-text-field rounded outlined dense type="text" v-model="student"  placeholder="Student ID" color="black">
                        </v-text-field>
                    </v-col>
                    <v-col cols="6" md="3">
                        <v-btn outlined text color="white--text dark" @click="onFetchStudent">find</v-btn>
                    </v-col>
                </v-row>

                <v-divider class="mt-5"></v-divider>

                <span style="font-family:Comic Sans MS;font-style:Italic" v-if="subjectCount>0">Subject Details</span>

                <!-- <span class="text-center">Subjects in {{course}}</span> -->

                <v-row justify="center" align="center" v-if="errorMessage!=null" class="mt-3">
                    <v-card>
                        <v-card-text class="black--text" style="font-family:Nyala">

                            <h2>{{this.errorMessage}}</h2>

                        </v-card-text>
                    </v-card>
                </v-row>


                <v-row justify="center">
                    <v-card class="mt-5 p-2" v-if="studentExists && subjectCount>0" width="90%">
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
                            <v-btn @click="createResult">Create Result</v-btn>
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
export default({
    name:'createmarksheet',
    data(){
        return{
            invalidInput:false,
            subjects:[],
            student:"",
            studentExists:false,
            studentDetails:{name:''},
            subjectCount : 0,
            errorMessage:null
        }
    },
    methods:{

        onFetchStudent(){

            this.studentExists = false;

            Api.get('/api/student/'+this.student).then((response)=>{

                if(response["data"]!="Not Found"){
                    this.studentExists = true;
                    if(this.subjectCount ==0)
                        this.errorMessage = "Subject not Found";
                }
                else
                    this.errorMessage = "Student Doesn't Exists";
            });
        },

        createResult(){

            for(let subject of this.subjects){
                if(subject.obtained > subject.total){
                    this.invalidInput  = true;
                }
            }
            if(!this.invalidInput){

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

                Api.post('/api/marksheet/create',{subjects:this.subjects,student:this.student,exam:"First Sem",year:"2019"}).then(response =>{
                    if(response.data=="Not Found"){
                        this.studentExists = false;
                        this.errorMessage = "Student Doesn't Exists";
                    }
                    else
                        {
                            this.studentExists = true;
                            this.errorMessage = null;
                            this.studentDetails = response.data;
                        }
                });

            }

        }

    },

    mounted(){

        // User.fetchUser().then((data)=>{

        //     console.log(data);

        // });

        Api.get('/api/fetchSubjectsWithCourse').then((data)=>{

            this.subjects = data["data"]
            this.subjectCount = this.subjects.length;

            for(let subject of this.subjects){
                subject.obtained = 0;
            }

        });

    }


})
</script>
