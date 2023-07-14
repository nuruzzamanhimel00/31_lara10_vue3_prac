<template>
    <div class="card-body msg_card_body">
        <div
            v-for="message in messages"
            :key="message.id"
            class="d-flex justify-content-start mb-4"
            :class="
                message.user_id == authUser.id
                    ? 'justify-content-end'
                    : 'justify-content-start'
            "
        >
            <div class="img_cont_msg">
                <img
                    src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                    class="rounded-circle user_img_msg"
                />
            </div>
            <div class="msg_cotainer">
                {{ message.message }}
                <span class="msg_time">{{
                    createdAtFormate(message.created_at)
                }}</span>
                <!-- <span class="msg_time">8:40 AM, Today</span> -->
            </div>
        </div>

        <!-- <div class="d-flex justify-content-start mb-4">
            <div class="img_cont_msg">
                <img
                    src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                    class="rounded-circle user_img_msg"
                />
            </div>
            <div class="msg_cotainer">
                Hi, how are you samim?
                <span class="msg_time">8:40 AM, Today</span>
            </div>
        </div>
        <div class="d-flex justify-content-end mb-4">
            <div class="msg_cotainer_send">
                Hi Khalid i am good tnx how about you?
                <span class="msg_time_send">8:55 AM, Today</span>
            </div>
            <div class="img_cont_msg">
                <img
                    src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                    class="rounded-circle user_img_msg"
                />
            </div>
        </div> -->
    </div>
</template>

<script>
import moment from "moment";
export default {
    name: "GroupChatMessages",
    props: ["messages", "authUser"],
    data() {
        return {};
    },
    components: {
        moment,
    },
    methods: {
        createdAtFormate(created_at) {
            return moment(created_at).format("h:mm a MMMM Do YYYY ");
            // return moment().format();
        },
    },
};
</script>

<style lang="scss" scoped></style>
