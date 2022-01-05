<template>
    <div class="border" style="height: 100%">
        <h3>Active Users</h3>
        <div v-for="user in users" v-model="users"
             style="height: auto; margin-top: 1px; margin-bottom: 1px">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img style="border-radius: 50%; width: 6em; height: 6em" :src="user.avatar" class="border img-fluid" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                           <h4>{{user.name}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Users",
    data: () => ({
        users: [],
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
    }
}
</script>

<style scoped>

</style>
