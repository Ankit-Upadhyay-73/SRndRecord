<template>

    <v-data-table :headers="headers" :items="subjects" :items-per-page="10" class="elevation-1">

     </v-data-table>

</template>


<script>
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
                            { text: 'Weightage', value: 'weightage' },
                            { text: 'Average Passing', value: 'passing' },
                        ],
                        subjects: []
                }
                },
            }
    </script>
