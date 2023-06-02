<template>
    <div>
        <li
            class="list-group-item"
            :class="chatColorChange"
            aria-current="true"
        >
            <slot></slot>
        </li>
        <button
            @click.prevent="$emit('chatItemDelete', keyData)"
            class="btn btn-warning btn-sm float-right"
        >
            Delete
        </button>
        <small class="badge float-right mb-1" :class="sendMessageUser"
            >You</small
        >
    </div>
</template>

<script>
export default {
    name: "ChatItem",
    props: ["color", "userIdentifierColor", "keyData"],
    data() {
        return {};
    },
    computed: {
        chatColorChange() {
            return "list-group-item-" + this.color;
        },
        sendMessageUser() {
            return "badge-" + this.userIdentifierColor;
        },
    },
    methods: {
        deleteMessage() {
            console.log(this.keyData);
        },
    },
};
</script>

<style lang="scss" scoped></style>
