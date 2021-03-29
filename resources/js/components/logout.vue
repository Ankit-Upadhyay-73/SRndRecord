
<template>

    <v-app>

        <v-container>

            <span style="font-family:Nyala" class="justidy-center align-center">
                Thanks For Using Student Result And Record <b>):</b> Be Connected For Further Marksheet Creations.
            </span>

        </v-container>

    </v-app>

</template>

<script>

import Api from '../../../Apis/Api';
export default ({
    data(){
        return{

        }
    },
    mounted()
    {
        Api.post('/logout').then((data)=>{
            console.log(data);
            this.$emit('loggedout',true);
            
        });
    }
})
</script>
