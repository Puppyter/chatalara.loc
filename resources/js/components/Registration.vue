<template>
    <form id="registerForm" enctype="multipart/form-data" >
        <input type="hidden" name="_token" :value="csrf">
        <div class="input-group mb-3">
            <label class="input-group-text" for="avatar">Avatar</label>
            <input type="file" name="avatar" class="form-control" ref="avatar" id="avatar">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Username</span>
            <input type="text" class="form-control" v-model="name">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Email</span>
            <input type="text" class="form-control" v-model="email">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Password</span>
            <input type="password" class="form-control" v-model="password">
        </div>
        <div class="col">
            <input type="button" class="btn btn-primary" value="Register" @click="uploadData">
        </div>
    </form>
</template>

<script>
export default {
    name: "Registration",
    props: ['route','routeLogin'],
    data: () => ({
        name: '',
        password: '',
        email: '',
        csrf: ''
    }),
    methods: {
        uploadData(){
            const data = new FormData(document.getElementById('registerForm'))
            let avatar = this.$refs.avatar;
            data.append('avatar', avatar.files[0])
            data.append('name', this.name)
            data.append('password', this.password)
            data.append('email', this.email)
            axios.post('/users/create/store', data, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(({data}) => {
                console.log(data)
                if (data.status === true) {
                    window.location.href = 'http://chatalara.loc/users';
                }
            })
            .catch(error =>{
                console.log(error.response)
            })
        },
    },
    mounted() {
        this.csrf = window.Laravel.csrfToken;
    }
}
</script>

<style scoped>

</style>
