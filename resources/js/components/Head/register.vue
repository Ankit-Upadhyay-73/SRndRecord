
<template>

    <v-app>
        <v-main>

            <v-container>

                <v-row>

                    <v-col cols="12"  class="d-flex justify-content-center">

                            <v-card shaped style="width:100%">

                                <v-card-title style="background-color:black">
                                    <h4 style="font-family:Comic Sans MS;color:white">Register</h4>
                                </v-card-title>

                                <v-card-text>

                                    <form class="mt-2">

                                        <v-row class="d-flex" dense style="display:flex;justify-content:center">
                                            <v-col cols="8">
                                                <v-text-field  dense outlined label="Name" color="black" v-model="head.name" :rules="[() => !!head.name || 'This field is required']">
                                                </v-text-field>
                                            </v-col>
                                        </v-row>

                                        <v-row class="d-flex" dense style="display:flex;justify-content:center">
                                            <v-col cols="8">
                                                <v-text-field dense outlined label="Email" color="black" v-model="head.email" :rules="[() => !!head.email || 'This field is required']">
                                                </v-text-field>
                                            </v-col>
                                        </v-row>
                                        <v-row class="d-flex"   dense style="display:flex;justify-content:center">
                                            <v-col cols="8">
                                                <v-text-field dense outlined label="College" color="black" v-model="head.college" :rules="[() => !!head.college || 'This field is required']">
                                                </v-text-field>
                                            </v-col>
                                        </v-row>
                                        <v-row class="d-flex"  dense style="display:flex;justify-content:center">
                                            <v-col cols="8">
                                                <v-text-field dense outlined label="Course" color="black" v-model="head.course" :rules="[() => !!head.course || 'This field is required']">
                                                </v-text-field>
                                            </v-col>
                                        </v-row>

                                        <v-row class="d-flex" dense style="display:flex;justify-content:center">
                                            <v-col cols="8">
                                                <v-text-field  dense outlined  label="Password" color="black" v-model="head.password" type="password" :rules="[() => !!head.password || 'This field is required']">
                                                </v-text-field>
                                            </v-col>
                                        </v-row>

                                        <v-row class="d-flex" dense justify="center">
                                                <v-btn text class="white--text text-capitalize mr-2" outlined style="background-color:black" @click="backLogin()">
                                                    <span style="font-family:Roboto">Login</span>
                                                </v-btn>
                                                <v-btn text class="white--text text-capitalize" outlined style="background-color:black">
                                                    <span style="font-family:Roboto">Register</span>
                                                </v-btn>
                                        </v-row>

                                    </form>
                                </v-card-text>
                            </v-card>
                    </v-col>

                </v-row>
            </v-container>
        </v-main>
    </v-app>

</template>

<script>

export default ({
    data(){
        return{
            head:{name:"",password:""}
        }
    },
    methods:{
        backLogin()
        {
            this.$router.push({path:'/head/login'});
        }
    }
})
</script>
