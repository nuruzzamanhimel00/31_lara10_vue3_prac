<template>
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">
            <div class="col-md-4 chat">
                <div class="card mb-sm-3 mb-md-0 contacts_card">
                    <div class="card-header">
                        <div class="input-group">
                            <input
                                type="text"
                                placeholder="Search..."
                                name=""
                                class="form-control search"
                            />
                            <div class="input-group-prepend">
                                <span class="input-group-text search_btn"
                                    ><i class="fas fa-search"></i
                                ></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body contacts_body">
                        <ui class="contacts">
                            <li class="active">
                                <div class="d-flex bd-highlight">
                                    <div class="img_cont">
                                        <img
                                            src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                            class="rounded-circle user_img"
                                        />
                                        <span class="online_icon"></span>
                                    </div>
                                    <div class="user_info">
                                        <span>Khalid</span>
                                        <p>Kalid is online</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex bd-highlight">
                                    <div class="img_cont">
                                        <img
                                            src="https://2.bp.blogspot.com/-8ytYF7cfPkQ/WkPe1-rtrcI/AAAAAAAAGqU/FGfTDVgkcIwmOTtjLka51vineFBExJuSACLcBGAs/s320/31.jpg"
                                            class="rounded-circle user_img"
                                        />
                                        <span
                                            class="online_icon offline"
                                        ></span>
                                    </div>
                                    <div class="user_info">
                                        <span>Taherah Big</span>
                                        <p>Taherah left 7 mins ago</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex bd-highlight">
                                    <div class="img_cont">
                                        <img
                                            src="https://i.pinimg.com/originals/ac/b9/90/acb990190ca1ddbb9b20db303375bb58.jpg"
                                            class="rounded-circle user_img"
                                        />
                                        <span class="online_icon"></span>
                                    </div>
                                    <div class="user_info">
                                        <span>Sami Rafi</span>
                                        <p>Sami is online</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex bd-highlight">
                                    <div class="img_cont">
                                        <img
                                            src="http://profilepicturesdp.com/wp-content/uploads/2018/07/sweet-girl-profile-pictures-9.jpg"
                                            class="rounded-circle user_img"
                                        />
                                        <span
                                            class="online_icon offline"
                                        ></span>
                                    </div>
                                    <div class="user_info">
                                        <span>Nargis Hawa</span>
                                        <p>Nargis left 30 mins ago</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex bd-highlight">
                                    <div class="img_cont">
                                        <img
                                            src="https://static.turbosquid.com/Preview/001214/650/2V/boy-cartoon-3D-model_D.jpg"
                                            class="rounded-circle user_img"
                                        />
                                        <span
                                            class="online_icon offline"
                                        ></span>
                                    </div>
                                    <div class="user_info">
                                        <span>Rashid Samim</span>
                                        <p>Rashid left 50 mins ago</p>
                                    </div>
                                </div>
                            </li>
                        </ui>
                    </div>
                    <!-- <div class="card-footer"></div> -->
                </div>
            </div>
            <div class="col-md-8 chat">
                <div class="card">
                    <div class="card-body msg_card_body">
                        <div class="d-flex justify-content-start mb-4">
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
                                <span class="msg_time_send"
                                    >8:55 AM, Today</span
                                >
                            </div>
                            <div class="img_cont_msg">
                                <img
                                    src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                    class="rounded-circle user_img_msg"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text attach_btn"
                                    ><i class="fas fa-paperclip"></i
                                ></span>
                            </div>
                            <textarea
                                @keyup.enter="sendMessage"
                                v-model="message"
                                class="form-control type_msg"
                                placeholder="Type your message..."
                            ></textarea>
                            <div class="input-group-append">
                                <span class="input-group-text send_btn"
                                    ><i class="fas fa-location-arrow"></i
                                ></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "GroupChatComponent",
    props: ["authUser"],

    data() {
        return {
            messages: [],
            groupId: "",
            message: "",
        };
    },
    created() {
        const url = window.location.href;
        const groupId = url.split("/").slice(-1)[0];
        this.groupId = groupId;
        console.log(groupId);
        this.fetchMessages();

        Echo.private(`sendsinglemessage${groupId}`).listen(
            "SendMessageEvent",
            (e) => {
                let self = this;
                console.log("litcher", e);
                // this.form.messages.push(e.message);
                // self.form.colors.push("warning");
                // self.form.users.push(e.user.name);
                // self.form.times.push(this.getTimes());
            }
        );
    },
    methods: {
        async sendMessage() {
            let self = this;
            await axios
                .post("/mychat/group/" + this.groupId + "/sendMessage", {
                    user_id: this.authUser.id,
                    message: this.message,
                })
                .then(function (response) {
                    let data = {
                        time: self.getTimes(),
                        message: response.message,
                        type: "send",
                    };
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
        },
        async fetchMessages() {
            await axios
                .get("/mychat/group/" + this.groupId + "/messages")
                .then(function (response) {
                    console.log("fetchMessages", response);
                })
                .catch(function (error) {
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
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
