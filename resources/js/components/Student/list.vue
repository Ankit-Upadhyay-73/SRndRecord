<template>

    <v-app>
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
                        headers: [
                            {
                                text: 'Name',
                                align: 'start',
                                sortable: false,
                                value: 'name',
                            },
                            { text: 'Email', value: 'email'},
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
