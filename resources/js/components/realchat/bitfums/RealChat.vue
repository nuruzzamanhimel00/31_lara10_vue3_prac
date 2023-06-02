<template>
    <div>
        <li class="list-group-item active" aria-current="true">
            Personal Chat
        </li>
        <ul class="list-group">
            <chat-item
                v-for="(message, key) in form.messages"
                :key="key"
                :color="`success`"
                :user-identifier-color="`danger`"
                :key-data="key"
                @chatItemDelete="onChatItemDelete"
            >
                {{ message }}
            </chat-item>
        </ul>
        <input
            type="text"
            class="form-control"
            v-model="message"
            @keyup.enter="sendMessage"
        />
    </div>
</template>

<script>
import ChatItem from "./ChatItem.vue";
export default {
    name: "RealChat",
    data() {
        return {
            message: "",
            form: {
                messages: [],
            },
        };
    },
    components: {
        ChatItem,
    },
    methods: {
        sendMessage() {
            let self = this;
            if (self.message.length > 0) {
                self.form.messages.push(self.message);
                self.message = "";
            }
        },
        onChatItemDelete(index) {
            let self = this;
            self.form.messages.splice(index, 1);
            console.log("index", index);
        },
    },
};
</script>

<style lang="scss" scoped></style>
