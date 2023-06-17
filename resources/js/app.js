import "./bootstrap";
import { createApp } from "vue";

// for ziggi
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

const app = createApp({});
app.use(ZiggyVue);

import ExampleComponent from "./components/ExampleComponent.vue";
// app.component("example-component", ExampleComponent);

// app.component("real-chat", () =>
//     import("./components/realchat/bitfums/RealChat.vue")
// );

//for v-toster
import Toaster from "@meforma/vue-toaster";
app.use(Toaster);

//vue socroll
import VueChatScroll from "vue-chat-scroll";
app.use(VueChatScroll);

Object.entries(import.meta.glob("./**/*.vue", { eager: true })).forEach(
    ([path, definition]) => {
        app.component(
            path
                .split("/")
                .pop()
                .replace(/\.\w+$/, ""),
            definition.default
        );
    }
);

app.mount("#app");
