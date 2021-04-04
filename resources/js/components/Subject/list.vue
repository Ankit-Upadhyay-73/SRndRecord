<template>

    <v-app>

        <v-row>

            <h2>
                Subjects In {{course.name}}
            </h2>

            <v-btn dark outlined @click="$router.push({path:'/subject/add'})">
                Add New Subject
            </v-btn>

        </v-row>

        <v-container>

            <v-data-table 
                :headers="headers" 
                :items="subjects" 
                :items-per-page="10"
                class="elevation-1"

                >

            </v-data-table>

        </v-container>
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
                    {text: 'Name',align: 'start',sortable: false,value: 'name'},
                    { text: 'Weightage',sortable: true, value: 'total',},
                    { text: 'Passing',sortable: true, value: 'passing'},
                    { text: 'Course',sortable: true,value:'course'}

                ],

            subjects: []

        }

    },

    created()
        {

            Api.get('/api/subjects').then(response=>
                {
                    for(let subject of data.response)
                    {
                        subject["course"] = this.course.name;
                        this.subjects.push(subject);
                    }
                });

        }

}

</script>
