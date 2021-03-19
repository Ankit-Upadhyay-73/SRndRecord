<template>
                <v-app-bar style="background-color: black">
                    <v-toolbar-title class="justify-center" style="font-family: Comic Sans MS;color:white">
                        MarkSheet
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn style="background-color:black;font-family:Comic Sans MS" class="white--text text-capitalize text-bold" v-on:click="onLoginClicked()">
                        Login
                    </v-btn>
                    <v-btn style="background-color:black;font-family:Comic Sans MS" class="white--text text-capitalize text-bold" v-on:click="onRegisterClicked()">
                        Register
                    </v-btn>
                </v-app-bar>
</template>

<script>

export default({
    methods:{
            onLoginClicked()
            {
                $router.push({path:'/head/login'});
            },

            onRegisterClicked()
            {
               $router.push({path:'/head/register'});
            }
    }
})
</script>
