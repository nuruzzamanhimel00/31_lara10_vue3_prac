<template>
    <div>
        <li class="list-group-item active" aria-current="true">
            Personal Chat
            <span class="badge badge-pill badge-danger">{{
                numberOfOnlines
            }}</span>
        </li>
        <span class="badge badge-primary" v-if="typing != ''">{{
            typing
        }}</span>
        <ul class="list-group" style="min-height: 150px">
            <chat-item
                v-for="(message, key) in form.messages"
                :key="key"
                :color="`${form.colors[key]}`"
                :user-identifier-color="`danger`"
                :key-data="key"
                :username="`${form.users[key]}`"
                :times="`${form.times[key]}`"
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
                times: [],
            },
            typing: "",
            numberOfOnlines: 0,
        };
    },
    components: {
        ChatItem,
    },
    watch: {
        message() {
            Echo.private(`chat`).whisper("typing", {
                name: this.message,
            });
            // console.log("messag");
        },
    },
    mounted() {
        Echo.private(`chat`)
            .listen("ChatEvent", (e) => {
                let self = this;
                console.log(e, e.message);
                this.form.messages.push(e.message);
                self.form.colors.push("warning");
                self.form.users.push(e.user.name);
                self.form.times.push(this.getTimes());
            })
            .listenForWhisper("typing", (e) => {
                if (e.name != "") {
                    this.typing = "Typing...";
                } else {
                    this.typing = "";
                }
                console.log(e.name);
            });

        Echo.join(`chat`)
            .here((users) => {
                this.numberOfOnlines = users.length;
                console.log("here", users);
            })
            .joining((user) => {
                this.numberOfOnlines += 1;
                this.$toast.success(`${user.name} is Online..`);
                // this.$toaster.success(`${user.name} is Online..`);
                console.log("joining", user.name);
            })
            .leaving((user) => {
                this.$toast.warning(`${user.name} is offLine..`);
                this.numberOfOnlines -= 1;
                console.log("leaving", user.name);
            })
            .error((error) => {
                console.error("error", error);
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
                        self.form.times.push(this.getTimes());
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
        getTimes() {
            let currentdate = new Date();

            return (
                currentdate.getHours() +
                ":" +
                currentdate.getMinutes() +
                ":" +
                currentdate.getSeconds()
            );
        },
    },
};
</script>

<style lang="scss" scoped></style>
