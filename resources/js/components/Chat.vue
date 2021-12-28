<template>
    <form id="messageForm">
        <div ref="scroll" class="row border position-relative" style="overflow:auto; width: 100%; height: 54em">
            <div class="border" v-for="message in messages.slice().reverse()" style="margin-top: 1px; margin-bottom: 1px">
                <figure class="text-end">
                    <blockquote class="blockquote">
                           <span>
                               <h6>{{message.name}}</h6>
                               <h5> {{message.message}}</h5>
                           </span>
                    </blockquote>
                </figure>
            </div>
        </div>
        <div class="input-group">
                <textarea class="form-control" style="height: 4em" v-model="msg" aria-describedby="button-addon2"></textarea>
                <button class="btn btn-primary" v-if="msg!==''" @click="sendMessage" type="button" id="button-addon2">Button</button>
                <button class="btn btn-primary" disabled v-if="msg===''" @click="sendMessage" type="button">Button</button>
        </div>
    </form>
</template>

<script>


export default {
    name: "Chat",
    props: ['messages'],
    data: () => ({
        msg: '',
        page: 1,
    }),
    mounted() {
            const div = this.$refs.scroll;
            div.scrollTop = div.scrollHeight;
        setInterval(function(){
            window.location.reload(true);
        },5000)
    },
    methods: {
        sendMessage() {
            const data = new FormData(document.getElementById('messageForm'))
            data.append('message', this.msg)
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
        // infiniteHandler($state) {
        //     axios.get('/message/get', {
        //         params: {
        //             page: this.page,
        //         },
        //     }).then(({data}) => {
        //         if (data.messages.length) {
        //             this.page += 1;
        //             this.messages.push(...data.messages);
        //             $state.loaded();
        //         } else {
        //             $state.complete();
        //         }
        //     });
        // },
    }
}
</script>

<style scoped>

</style>
