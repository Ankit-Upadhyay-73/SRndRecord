<template>
        <v-app>
            <v-main>
                <v-app-bar style="background-color: black">

                    <v-toolbar-title class="justify-center" style="font-family: Comic Sans MS;color:white">
                        MarkSheet
                    </v-toolbar-title>
                    <v-spacer></v-spacer>

                    <v-menu offset-y v-if="!showLoginRegisterMenu">
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn  dark v-bind="attrs" v-on="on" class="text-capitalize">
                                    <span style="font-family:Comic Sans MS">{{uname}}</span>
                                    <span class="material-icons">
                                        <v-icon>mdi-arrow-bottom-bold</v-icon>
                                    </span>
                                </v-btn>
                            </template>
                            <v-list>
                                <v-list-item v-for="(item, index) in items" :key="index">
                                    <v-list-item-title @click="$router.push('/profile')">{{ item.title }}</v-list-item-title>
                                </v-list-item>
                            </v-list>
                    </v-menu>

                    <v-btn  v-if="showLoginRegisterMenu"    style="background-color:black;font-family:Comic Sans MS" class="white--text text-capitalize text-bold" v-on:click="$router.push({path:'/head/login'});">
                        Login
                    </v-btn>
                    <v-btn v-if="showLoginRegisterMenu"     style="background-color:black;font-family:Comic Sans MS" class="white--text text-capitalize text-bold" v-on:click=" $router.push({path:'/head/register'});">
                        Register
                    </v-btn>
                </v-app-bar>
                <router-view @loggedin="onLoggedIn"></router-view>
            </v-main>
        </v-app>
</template>

<script>
import User from './../../../Apis/User'
export default({
    name:'layout-header',
    data(){
        return {
                showLoginRegisterMenu:true,
                drawerState:false,
                uname : "",
                items: [
                        { title: 'LogOut', path:'/logout'},
                        { title: 'Profile',path:'/profile'}
                    ],
                actions:[
                            { title:'Student',Subtitle:'Student Operations',to:[{path:'/student/create',title:'Add'},{path:'/students',title:'List'}]},
                            { title:'Subject',Subtitle:'Subject Operations',to:[{path:'/subject/create',title:'Add'},{path:'/subjects',title:'List'}]},
                            { title:'Marksheet',Subtitle:'Create MarkSheet',to:[{path:'/marksheet/create',title:'Create'}]},
                        ]
            }
        },
    created(){


            //first fetch session and then send requets to server for fetching users details

            User.fetchUser().
            then(data => {
                if(data["data"]!=undefined)
                {
                    this.$router.push({path:'/actions'});
                    this.showLoginRegisterMenu = false;
                    this.uname =  data["data"]["name"];
                }
            }).
            catch(error=>{
                if(error.response.status==401){

                }
            });
    },
    methods:{

            onLoggedIn(data){

                this.showLoginRegisterMenu = !data;

            },

            onLoginClicked($event)
            {
                $router.push({path:'/head/login'});
            },

            onRegisterClicked()
            {
               $router.push({path:'/head/register'});
            },

    }
})
</script>
