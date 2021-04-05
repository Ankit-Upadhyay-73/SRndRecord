<template>

    <v-app>

        <v-main>

            <v-container>

                <v-row dense justify="center" class="justify-center">

                    <h3>
                        Subjects In {{course.name}}
                    </h3>
                    <v-spacer></v-spacer>
                    <v-btn class="black--text" outlined @click="$router.push({path:'/subject/create'})">
                        Add New Subject
                    </v-btn>

                </v-row>

                <v-data-table
                    :headers="headers"
                    :items="subjects"
                    :items-per-page="10"
                    class="elevation-1 mt-2"
                    >

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
                    Api.get('/api/course').then(dt =>{

                        this.course = dt.data;

                        for(let subject of response.data)
                        {
                            subject.course = this.course.name;
                            console.log(subject);
                            this.subjects.push(subject);
                        }

                    });

                });

        }

}

</script>
