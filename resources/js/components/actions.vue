<template>
        <v-app>
            <v-main>
                <v-container>

                    <v-row>
                        <v-col v-for="action in actions" :key="action.title" cols="12" md="4">
                            <v-card>
                                <v-card-title>
                                    {{action.title}}
                                </v-card-title>
                                <v-card-subtitle>
                                    {{action.subtitle}}
                                </v-card-subtitle>
                                <v-card-actions>
                                    <v-btn v-for="point in action.to" :key="point.path">
                                        <router-link :to="point.path" style="text-decoration:none;color:black">{{point.title}}</router-link>
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-col>
                    </v-row>

                </v-container>
            </v-main>
        </v-app>
</template>

<script>
export default {
    data() {
        return {
            actions:[
                { title:'Student',Subtitle:'Student Operations',to:[{path:'/student/create',title:'Add'},{path:'/students',title:'List'}]},
                { title:'Subject',Subtitle:'Subject Operations',to:[{path:'/subject/create',title:'Add'},{path:'/subjects',title:'List'}]},
                { title:'Marksheet',Subtitle:'Create MarkSheet',to:[{path:'/marksheet/create',title:'Create'}]},
            ]
        };
    }
};
</script>
