<template>
    <div class="chat-composer">
        <input type="text" placeholder="Start typing your message..." v-model="messageText" @keyup.enter="sendMessage">
        <button class="btn btn-primary" @click="sendMessage">Send</button>
    </div>
</template>
 <script>
 export default {
     data() {
         return {
             messageText: 'default' 
         }
     },

     methods: {
         sendMessage(){
            this.$emit('messagesent', {
                message: this.messageText,
                user: {
                    name: $('#navbarDropdown').text()
                }
            });
            this.messageText = ''; 
         }
     }
 }
 </script>

 <style>
 .chat-composer {
     display: flex;
 }

 .chat-composer input{
     flex: 1 auto;
 }

 </style>
 
 