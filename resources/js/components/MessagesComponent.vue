<template>
    <div class="row">
        <div class="col-8">
            <div class="card card-default">
                <div class="card-header">Messages</div>
                <div class="card-body p-0">
                    <ul class="list-unstyled" style="height:300px; overflow-y:scroll">
                        <li class="p-2" v-for="(messages, index) in messages" :key="index">
                            <strong>{{message.user.name}}</strong>
                            {{message.message}}
                        </li>
                    </ul>
                </div>

                <input 
                v-model="newMessage"
                @keyup.enter="sendMessage"
                type="text" name="message" class="form-control" placeholder="Type your message">
            </div>
            <span class="text-muted">user is typing...</span>
        </div>

        <div class="col-4">
            <div class="card card-default">
                <div class="card-header">Active USers</div>
                <div class="card-body">
                    <li class="py-2">Messi</li>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default
    {
        props:['user'],

        data() {
            return {
                messages: [],
                newMessage: ''
            }
        },
        
        created() {
            this.fetchMessages();

            Echo.join('texting').listen('MessageSent',(event) => {
                this.messages.push(event.messages);
            })
        },
        
        methods:{
            fetchMessages() {
                axios.get('messages').then(response => {
                    this.messages=response.data;
                })
            },

            sendMessage() {
                this.messages.push({
                    user: this.user,
                    message: this.newMessage 
                });

                 axios.post('messages', {message: this.newMessage});
                 this.newMessage = '';
            }
        }
    }
</script>
