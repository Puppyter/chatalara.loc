<template>
    <form id="authForm">
        <div class="input-group mb-3">
            <span class="input-group-text">Email</span>
            <input type="text" class="form-control" v-model="email">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Password</span>
            <input type="password" class="form-control" v-model="password">
        </div>
        <div class="col">
            <input type="button" class="btn btn-primary" value="Login" @click="uploadData">
        </div>
    </form>
</template>

<script>
export default {
    name: "Login",
    props: ['auth'],
    data: () => ({
        email: '',
        password: '',
    }),
    methods: {
        uploadData(){
            const data = new FormData(document.getElementById('authForm'))
            data.append('password', this.password)
            data.append('email', this.email)
            axios.post('/login', data, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
                .then(({data}) => {
                    console.log(data)
                    if (data.status === true) {
                        window.location.href = 'http://chatalara.loc/chat';
                    }
                })
                .catch(error =>{
                    console.log(error.response)
                })
        },
    },
}
</script>

<style scoped>

</style>
