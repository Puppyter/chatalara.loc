<template>
    <form id="messageForm">
        <div ref="scroll" class="border position-relative" style="overflow:auto; width: 100%; height: 54em">
            <div class="border bg-light bg-gradient"
                 v-for="message in messages.slice().reverse()" v-model="messages"
                 style="height: 5em; margin-top: 1px; margin-bottom: 1px">
                <figure class="text-end">
                    <blockquote class="blockquote">
                           <span>
                               <h6>{{ message.name }}</h6>
                               <h5 class="text-break"> {{ message.message }}</h5>
                           </span>
                    </blockquote>
                </figure>
            </div>
        </div>
        <div class="input-group">
            <input type="hidden" v-model="changeRecipient" v-if="this.recipient!=={}">
            <textarea class="form-control" style="height: 4em" v-model="msg"
                      aria-describedby="button-addon2"></textarea>
            <button class="btn btn-primary" v-if="msg!==''" @click="sendMessage" type="button">Button</button>
            <button class="btn btn-primary" disabled v-if="msg===''" type="button">Button</button>
        </div>
    </form>
</template>

<script>
export default {
    name: "Chat",
    props: ['recipient'],
    data: () => ({
        msg: '',
        messages: [],
        time: '',
        recipientId: null,
    }),
    mounted() {
        this.getMessages();
        // this.$refs.scroll.scrollTop = this.$refs.scroll.scrollHeight;
        setInterval(this.getMessages, 5000)

    },
    computed: {
      changeRecipient(){
          this.recipientId = this.recipient.id;
          this.msg = this.recipient.name;
      }
    },
    methods: {
        sendMessage() {
            const data = new FormData(document.getElementById('messageForm'))
            data.append('message', this.msg)
            data.append('recipient_id', this.recipientId)
            axios.post('/message/save', data, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
                .then(({data}) => {
                    console.log(data)
                    if (data.status === true) {
                        this.getMessages();
                    }

                })
                .catch(error => {
                    console.log(error.response)
                })
                .finally(() => {
                    this.msg = '';
                    this.$refs.scroll.scrollTop = this.$refs.scroll.scrollHeight;
                })
        },
        getMessages() {
            axios.get('/message/get' + '?' + 'time=' + this.time, {
                timeout: 5000
            }).then(({data}) => {
                data.messages.forEach(message => {
                    const found = this.messages.find(msg => msg.id === message.id);
                    if (!found) {
                        if (this.time ==='') {
                            this.messages.push(message);
                            this.scrollDown();
                        }
                        else{
                            this.messages.unshift(message);
                        }
                    }

                });
                this.time = data.time;
                console.log(data)
            })
                .catch(error => {
                    console.log(error.response);
                })
        },
        changeActivity() {
            this.activity = !this.activity;
            axios.post('/users/change', [{'activity': this.activity}])
                .then(({data}) => {
                    console.log(data)
                })

        },
        changeUser() {
            if (this.msg!== undefined)
            {
                this.msg = undefined;
            }

            this.msg = this.recipient.name;

        },
        scrollDown() {
            this.$refs.scroll.scrollTop = this.$refs.scroll.scrollHeight;
        }
    }
}
</script>

<style scoped>

</style>
