<template>
    <form id="messageForm">
    <div>
        <div class="row border position-relative" style="width: 100%; height: 54em">
            <ul class="list-unstyled position-absolute bottom-0 end-0">
            <li v-for="message in messages.slice().reverse()">
                <figure class="text-end">
                    <blockquote class="blockquote">
                        <div class="border">
                           <span>
                               <h6>{{message.name}}</h6>
                               <h5> {{message.message}}</h5>
                           </span>
                        </div>
                    </blockquote>
                </figure>
            </li>
            </ul>
        </div>
            <div class="input-group mb-3">
                <textarea class="form-control" style="height: 4em" v-model="msg" aria-describedby="button-addon2"></textarea>
                <button class="btn btn-primary" v-if="msg!==''" @click="sendMessage" type="button" id="button-addon2">Button</button>
                <button class="btn btn-primary" disabled v-if="msg===''" @click="sendMessage" type="button">Button</button>
            </div>
    </div>
    </form>
</template>

<script>
setInterval(function(){
    window.location.reload(true);
},5000)
export default {
    name: "Chat",
    props: ['messages'],
    data: () => ({
       msg: '',
    }),
    methods: {
        sendMessage() {
            const data = new FormData(document.getElementById('messageForm'))
            data.append('message', this.message)
            axios.post('/message/save', data, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
                .then(({data}) => {
                    console.log(data)
                    if (data.status === true)
                    {
                        window.location.reload(true);
                    }
                })
                .catch(error =>{
                    console.log(error.response)
                })
        },
    }
}
</script>

<style scoped>

</style>
