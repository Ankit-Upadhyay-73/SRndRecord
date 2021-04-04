<template>

    <div class="w-100 footer">

        <v-row class="justify-space-around">

            <v-col cols="6" sm="6" md="2" style="display:flex;justify-content:center">

                <div>
                    
                    <span>Welcome User</span>

                </div>

                <div>

                    <router-link :to="{'path':'/head/register'}">SignUp</router-link> OR
                    <router-link :to="{'path':'/head/login'}">Login</router-link>

                </div>

            </v-col>
        
            <v-col cols="6" sm="6" md="2" style="display:flex;justify-content:center">

                <div>
                    <span></span>
                </div>

                <div>
                    <router-link :to="{'path':'/head/register'}">SignUp</router-link> OR
                    <router-link :to="{'path':'/head/login'}">Login</router-link>
                </div>

            </v-col>


        </v-row>

    </div>    

</template>

<script>

export default {
    
}

</script>

<style>
    
    .footer
    {
        background: #151515;
        margin: 20% 20% 0% 0%;
    }

    router-link{
        color:black;
    }

</style>