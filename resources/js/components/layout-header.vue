<template>
        <v-app>
            <v-main>

                <!-- layout appbar including title, drawer & Login,Logout Options -->
                <v-app-bar
                    style="background-color: black">

                    <v-app-bar-nav-icon
                        @click.stop="drawer_status = !drawer_status"
                        class="white" v-if="!showLoginRegisterMenu">
                    </v-app-bar-nav-icon>

                    <v-toolbar-title
                        class="justify-center white--text"
                        style="font-family:Comic Sans MS"
                        >
                        MarkSheet
                    </v-toolbar-title>

                    <v-spacer></v-spacer>

                    <!-- show profile and logging out menu -->
                    <v-menu offset-y
                        v-if="!showLoginRegisterMenu">

                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                dark v-bind="attrs"
                                v-on="on"
                                class="text-capitalize"
                                >
                                <span style="font-family:Comic Sans MS" class="text-bold">
                                    {{uname}}
                                </span>
                                <v-icon color="white">
                                    mdi-arrow-down-bold-circle
                                </v-icon>
                            </v-btn>
                        </template>

                        <v-list>
                            <v-list-item
                                v-for="(item, index) in items"
                                :key="index">

                                <v-list-item-title
                                    @click="$router.push(''+item.path)">
                                    {{ item.title }}
                                </v-list-item-title>

                            </v-list-item>
                        </v-list>
                    </v-menu>
                    <!-- </> end loggedin menu -->

                    <!-- show login and register button if not logged in -->
                    <v-btn
                        v-if="showLoginRegisterMenu"
                        style="background-color:black;font-family:Comic Sans MS"
                        class="white--text text-capitalize text-bold"
                        v-on:click="$router.push({path:'/head/login'});">
                        Login
                    </v-btn>

                    <v-btn v-if="showLoginRegisterMenu"
                            style="background-color:black;font-family:Comic Sans MS"
                            class="white--text text-capitalize text-bold"
                            v-on:click=" $router.push({path:'/head/register'});"
                        >
                        Register
                    </v-btn>
                    <!-- </> end login and register btn  ection-->

                </v-app-bar>

                <!-- <> drawer starts here -->
                <v-navigation-drawer v-if="!showLoginRegisterMenu"
                    app
                    :permanent="$vuetify.breakpoint.mdAndUp"
                    style="background-color:#ebecf0"
                    v-model="drawer_status">

                    <v-list>
                        <div
                            style="border:1px solid black;padding:60px;margin:10px">
                            <span
                                color="black"
                              >
                                Create M.
                            </span>
                        </div>

                        <span
                            style="font-family:Comic Sans MS;text-decoration:underline;font-weight:bold;color:#808080">
                                Actions
                        </span>

                    </v-list>

                    <v-list>
                        <v-list-group
                            color="black"
                            dense
                            v-for="item in actions"
                            v-model="item.active"
                            :key="item.title"
                            active-class="black--text"
                            no-action>
                            <template v-slot:activator>

                                <v-list-item-content>
                                    <v-list-item-title v-text="item.title">
                                    </v-list-item-title>
                                </v-list-item-content>

                            </template>

                            <v-list-item
                                v-for="subActions in item.to"
                                :key="subActions.path"
                                :to="subActions.path"
                                >

                                <v-list-item-icon>
                                    <v-icon>{{ subActions.icon }}</v-icon>
                                </v-list-item-icon>
                                <v-list-item-title>{{ subActions.title }}</v-list-item-title>

                            </v-list-item>

                        </v-list-group>
                    </v-list>

                </v-navigation-drawer>


                <!-- <> components dyamically updates here -->
                <!-- event to check user is logged in or not -->
                <router-view @loggedin="onLoggedIn"></router-view>
                <!-- </> all components end section here -->
            </v-main>
        </v-app>
</template>

<script>

import User from './../Apis/User'

export default ({

    name:'layout-header',

    data(){
        return {
                showLoginRegisterMenu:true,
                drawer_status:false,
                uname : "",
                items:
                [
                    { title: 'LogOut', path:'/logout'},
                    { title: 'Profile',path:'/profile'}
                ],

                actions:
                [
                    {
                        title:'Student',Subtitle:'Student Operations',
                        to:[
                                {path:'/student/create',title:'Add',icon:'mdi-creation'},
                                {path:'/students',title:'List',icon:'mdi-format-list-bulleted'}
                            ]
                    },

                    {
                        title:'Subject',active:true,Subtitle:'Subject Operations',
                        to:[
                                {path:'/subject/create',title:'Add',icon:'mdi-creation'},
                                {path:'/subjects',title:'List',icon:'mdi-format-list-bulleted'}
                            ]
                    },

                    {
                        title:'Marksheet',Subtitle:'Create MarkSheet',
                        to:[
                                {path:'/marksheet/create',title:'Create',icon:'mdi-creation'}
                            ]
                    },

                ]
            }
        },

    created(){

            //first set session and then send requets to server for fetching users details

            User.fetchUser().

                then(response => {

                        if(response.data!=undefined)
                        {
                            this.$router.push({path:'/home'});
                            this.showLoginRegisterMenu = false;
                            this.uname =  response.data["name"];
                        }

                    }).catch(error=>{
                            if(error.response.status==401){

                            }
                        });
            },

    methods:{

            onLoggedIn(value){
                this.showLoginRegisterMenu = !value;
                User.fetchUser().then((response)=>{
                    this.uname =  response.data["name"];
                });

            },

    }
})
</script>
