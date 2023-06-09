<template>
    <div>
        <li class="list-group-item active" aria-current="true">
            Personal Chat
        </li>
        <ul class="list-group">
            <chat-item
                v-for="(message, key) in form.messages"
                :key="key"
                :color="`${form.colors[key]}`"
                :user-identifier-color="`danger`"
                :key-data="key"
                :username="`${form.users[key]}`"
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
                users: [],
                colors: [],
            },
        };
    },
    components: {
        ChatItem,
    },
    mounted() {
        Echo.private(`chat`).listen("ChatEvent", (e) => {
            let self = this;
            console.log(e, e.message);
            this.form.messages.push(e.message);
            self.form.colors.push("warning");
            self.form.users.push(e.user.name);
        });
    },
    methods: {
        sendMessage() {
            let self = this;
            if (self.message.length > 0) {
                axios
                    .post(route("realtime.chat.bitfums.sendMessage"), {
                        message: self.message,
                    })
                    .then((response) => {
                        self.form.messages.push(self.message);
                        self.form.users.push("You");
                        self.form.colors.push("success");
                        self.message = "";
                        console.log(response);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
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
