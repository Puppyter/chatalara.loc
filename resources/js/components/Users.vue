<template>
    <div class="row row-cols-10">
        <div class="col-2" style="height: auto">
    <div class="border" style="height: 100%">
        <h3>Active Users</h3>
        <div v-for="user in users" v-model="users" :key="user.id"
             style="height: auto; margin-top: 1px; margin-bottom: 1px">
            <button @click="changeUser({id: user.id, name: user.name})" class="card mb-3" style="width: 90%">
                <div class="row g-0">
                    <div class="col-md-auto">
                        <img style="border-radius: 50%; width: 5em; height: 5em" :src="user.avatar" class="border img-fluid" alt="...">
                    </div>
                    <div class="col-md-auto">
                        <div class="card-body">
                           <h4>{{user.name}}</h4>
                        </div>
                    </div>
                </div>
            </button>
        </div>
    </div>
        </div>
        <div class="col-8">
            <Chat :recipient="this.recipient"></Chat>
        </div>
    </div>
</template>

<script>
export default {
    name: "Users",
    data: () => ({
        users: [],
        recipient: {id:null,name:''},
    }),
    mounted() {
        this.getActiveUsers();
        setInterval(this.getActiveUsers,5000);
    },
    methods: {
        getActiveUsers(){
            axios.get('/user/active')
                .then((response)=> {
                    this.users = response.data.users;
                    console.log(response);
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        changeUser(recipient){
            this.recipient = recipient
        }
    }
}
</script>

<style scoped>

</style>
