<template>

    <v-app>

        <v-row>
            <h2>
                Students in {{course.name}}
            </h2>
            <v-spacer></v-spacer>
            <v-btn dark>
                Add new Student
            </v-btn>
        </v-row>

        <v-container>
            <v-data-table :headers="headers" :items="students" :items-per-page="10" class="elevation-1">

            </v-data-table>

        </v-container>
    </v-app>

</template>


<script>
import Api from './../../Apis/Api';
            export default {
                data () {
                  return {
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

                    Api.get('/api/students').then((data)=>{

                        for(let student of data["data"])
                        {
                            this.students.push(student);
                        }

                    });

                }

            }
    </script>
