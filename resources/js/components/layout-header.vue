<template>
        <v-app>
            <v-main>
                <v-app-bar
                    style="background-color: black">

                    <v-app-bar-nav-icon
                        @click.stop="drawerState = !drawerState"
                        class="white" v-if="!showLoginRegisterMenu">
                    </v-app-bar-nav-icon>

                    <v-toolbar-title
                        class="justify-center"
                        style="font-family: Comic Sans MS;color:white">
                        MarkSheet
                    </v-toolbar-title>

                    <v-spacer></v-spacer>

                    <v-menu offset-y
                        v-if="!showLoginRegisterMenu">

                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                dark v-bind="attrs"
                                v-on="on"
                                class="text-capitalize"
                                >
                                <span style="font-family:Comic Sans MS">{{uname}}</span>
                                    <v-icon color="white">mdi-arrow-down-bold-circle</v-icon>
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
                </v-app-bar>

                <v-navigation-drawer absolute
                    temporary
                    style="background-color:#ebecf0"
                    v-model="drawerState">

                    <v-list
                        >
                        <div

                            style="border:1px solid black;padding:60px;margin:10px">
                            <span
                                style="font-family:Comic Sans MS;color:#000000;">
                                Create M.
                            </span>
                        </div>

                        <span

                            style="font-family:Comic Sans MS;text-decoration:underline;font-weight:bold;color:#808080">
                                Actions
                        </span>

                        <v-list-group
                            color="black"
                            dense
                            v-for="item in actions"
                            v-model="item.active"
                            :key="item.title"

                            no-action>
                            <template v-slot:activator>

                                <v-list-item-content>
                                    <v-list-item-title v-text="item.title" style="font-family:Times New Roman">
                                    </v-list-item-title>
                                </v-list-item-content>

                            </template>

                           <v-list-item
                                v-for="subActions in item.to"
                                :key="subActions.to">
                                <v-icon>{{subActions.icon}}</v-icon>
                                <v-spacer></v-spacer>
                                <v-list-item-content>
                                    <router-link style="text-decoration:none;color:#808080;font-family:Comic Sans MS" :to="subActions.path" v-text="subActions.title"></router-link>
                                </v-list-item-content>

                            </v-list-item>
                        </v-list-group>
                    </v-list>

                </v-navigation-drawer>

                <router-view @loggedin="onLoggedIn"></router-view>

            </v-main>
        </v-app>
</template>

<script>
import User from './../Apis/User'
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
                            { title:'Student',Subtitle:'Student Operations',to:[{path:'/student/create',title:'Add',icon:'mdi-creation'},{path:'/students',title:'List',icon:'mdi-format-list-bulleted'}]},
                            { title:'Subject',active:true,Subtitle:'Subject Operations',to:[{path:'/subject/create',title:'Add',icon:'mdi-creation'},{path:'/subjects',title:'List',icon:'mdi-format-list-bulleted'}]},
                            { title:'Marksheet',Subtitle:'Create MarkSheet',to:[{path:'/marksheet/create',title:'Create',icon:'mdi-creation'}]},
                        ]
            }
        },
    created(){

            //first fetch session and then send requets to server for fetching users details
            User.fetchUser().
            then(response => {
                if(response.data!=undefined)
                {
                    this.$router.push({path:'/home'});
                    this.showLoginRegisterMenu = false;
                    this.uname =  response.data["name"];
                }
            }).
            catch(error=>{
                if(error.response.status==401){

                }
            });
        },

    methods:{

            onLoginClicked($event)
            {
                $router.push({path:'/head/login'});
            },

            onRegisterClicked()
            {
               $router.push({path:'/head/register'});
            },

            onLoggedIn(data){
                this.showLoginRegisterMenu = !data;
                User.fetchUser().then((response)=>{
                    this.uname =  response.data["name"];
                });

            },

    }
})
</script>
