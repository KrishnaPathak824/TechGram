<template>
    <div>
        <button class="btn btn-secondary" v-text="buttonText" @click="followUser" ></button>
    </div>
</template>

<script>
    export default {
        props:['userId','follows'],
        mounted() {
            console.log('Component mounted.', this.userId)
        },

        data: function(){
            return{
                status:this.follows
            }
        },

        methods:{
            followUser(){
                axios.post('/follow/'+ this.userId).then((response)=>{
                    console.log(response.data);
                    this.status = !this.status;
                }).catch((err)=>{
                    if(err.response.status == 401){
                         window.location = '/login'
                    }
                })
            }
        },

        computed:{
            buttonText(){
                return (this.status) ? 'Unfollow' : 'Follow'
            }
        }
    }
</script>
