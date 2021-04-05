<template>

    <v-app>
        <v-main>
            <v-container>

                <v-row class="mt-2">
                    <h3>
                        Students in {{course.name}}
                    </h3>
                    <v-spacer></v-spacer>
                    <v-btn dark @click="$router.push({path:'/student/create'})">
                        Add new Student
                    </v-btn>
                </v-row>

                <v-data-table :headers="headers" :items="students" :items-per-page="10" class="elevation-1 mt-2">

                </v-data-table>

            </v-container>
        </v-main>
    </v-app>

</template>


<script>
import Api from './../../Apis/Api';
            export default {
                data () {
                  return {
                        course:[],
                        headers:
                        [
                            { text: 'id',align: 'start',value: 'id'},
                            { text: 'Name',value: 'name'},
                            { text: 'Email', value: 'email'},
                            { text: 'Contact', value: 'contact'},

                        ],
                        students: []
                    }
                },
                created(){

                    Api.get('/api/course').then(response=>{
                       this.course =  response.data;
                    });

                    Api.get('/api/students').then((dt)=>{
                        for(let student of dt.data)
                        {
                            this.students.push(student);
                        }

                    });


                }

            }
    </script>
