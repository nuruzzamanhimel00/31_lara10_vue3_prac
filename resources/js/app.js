import "./bootstrap";
import { createApp } from "vue";

import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

const app = createApp({});

import ExampleComponent from "./components/ExampleComponent.vue";
// app.component("example-component", ExampleComponent);

// app.component("real-chat", () =>
//     import("./components/realchat/bitfums/RealChat.vue")
// );

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

app.use(ZiggyVue);

app.mount("#app");
