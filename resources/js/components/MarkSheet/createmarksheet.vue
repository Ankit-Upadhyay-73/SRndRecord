
    <template>

    <v-app>

        <v-main>

            <v-container>
                <v-row justify="center">
                    <v-col cols="6" md="4">
                        <v-text-field rounded outlined dense type="text" v-model="student"  placeholder="Student ID" color="black">
                        </v-text-field>
                    </v-col>
                    <v-col cols="6" md="3">
                        <v-btn shaped rounded text color="white--text dark" @click="onFetchStudent">find</v-btn>
                    </v-col>
                </v-row>

                <v-divider class="mt-5"></v-divider>

                <span style="font-family:Comic Sans MS;font-style:Italic">Subject Details</span>

                <!-- <span class="text-center">Subjects in {{course}}</span> -->
                <v-row justify="center">
                    <v-card class="mt-5 p-2" v-if="studentExists" width="90%">
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

import Api from './../../../../Apis/Api'
import User from './../../../../Apis/User'
export default({
    name:'createmarksheet',
    data(){
        return{

            subjects:[],
            student:"",
            studentExists:false,
            studentDetails:{name:''}

        }
    },
    methods:{

        onFetchStudent(){

            this.studentExists = false;

            Api.get('/student/'+this.student).then((response)=>{

                console.log(response);
                if(response["data"]!="Not Found"){
                    this.studentExists = true;
                }

            });
        },

        createResult(){

            console.log();

            for(let subject of this.subjects){
                if(subject.obtained > subject.total){
                    console.log("Subject marks can't be greater than total Marks "+subject.name);
                }
                else{
                    Api.post('/marksheet/create',this.subjects).then((data)=>{
                        console.log(data);
                    });
                }
            }

        }

    },

    mounted(){

        // User.fetchUser().then((data)=>{

        //     console.log(data);

        // });

        Api.get('/fetchSubjectsWithCourse').then((data)=>{

            this.subjects = data["data"]
            for(let subject of this.subjects){
                subject.obtained = 0;
            }

            // console.log(this.subjects);
        });

    }


})
</script>
