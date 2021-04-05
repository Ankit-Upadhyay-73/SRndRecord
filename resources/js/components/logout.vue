
<template>

    <v-app>

        <v-container>

            <span style="font-family:Nyala" class="justidy-center align-center">
                Thanks For Using Student Result And Record <b>):</b> Be Connected For Further Marksheet Creations.
            </span>

            <v-btn dark @click="$router.push('/head/login')">
                Home
            </v-btn>

        </v-container>

    </v-app>

</template>

<script>

import Api from './../Apis/Api'
export default ({
    data(){
        return{

        }
    },
    mounted()
    {
        var _nuxt = this;
        Api.post('/api/logout').then((data)=>{
            _nuxt.$emit('loggedin',false);
        });
    }
})
</script>
