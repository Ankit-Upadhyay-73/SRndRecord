<template>

    <v-app>
        <v-container>
            <v-data-table :headers="headers" :items="subjects" :items-per-page="10" class="elevation-1">

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
                            { text: 'Weightage', value: 'total'},
                            { text: 'Passing', value: 'passing'},
                        ],
                        subjects: []
                    }
                },
                created(){

                    Api.get('/api/subjects').then((data)=>{

                        for(let subject of data["data"])
                        {
                            this.subjects.push(subject);
                        }

                    });

                }

            }
    </script>
