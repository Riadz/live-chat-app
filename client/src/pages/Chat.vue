<template>
  <base-layout>
    <div class="chat-wrapper">
      <div class="chat-container">
        <div class="chat-messages" ref="scrollable">
          <ul>
            <li
              v-for="msg in msgs"
              :class="{ outbound: msg.user === $store.state.userName }"
              :key="msg.id"
            >
              <div class="user">
                <img class="avatar" src="assets/globe.svg" />
                <span>{{ msg.user }}</span>
              </div>
              <div class="message">
                <p>
                  {{ msg.message }}
                </p>
                <span>{{ formateDate(msg.updated_at) }}</span>
              </div>
            </li>
          </ul>
        </div>
        <form @submit.prevent="storeMessages" class="chat-input">
          <input v-model="input" placeholder="Enter message here" required />
          <button>
            <ion-icon :icon="send"></ion-icon>
          </button>
        </form>
      </div>
    </div>
  </base-layout>
</template>

<script>
import { ref } from "vue";

import { send } from "ionicons/icons";
import { IonIcon } from "@ionic/vue";
export default {
  components: { IonIcon },
  data: () => ({
    send,
  }),

  setup() {
    var moment = require("moment");

    let input = ref("");

    let msgs = ref([]);

    const formateDate = (timestamp) => {
      return moment(timestamp).format("LT");
    };

    return { msgs, input, formateDate };
  },
  mounted() {
    // fetching messages
    this.fetchMessages();

    window.Echo.channel("public-chat").listen(".message-created", (e) => {
      this.msgs.push(e.message);

      this.scrollToBottom();
    });
  },
  methods: {
    async fetchMessages() {
      let url = this.$store.state.server;

      let res = await fetch(`${url}/messages`);
      let messages = await res.json();

      this.msgs = messages;

      this.scrollToBottom();
    },

    async storeMessages() {
      let url = this.$store.state.server;
      let userName = this.$store.state.userName;
      let data = JSON.stringify({
        user: userName,
        message: this.input,
      });

      let res = await fetch(`${url}/messages`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: data,
      });

      let result = await res.text();

      console.log(result);

      this.scrollToBottom();
      this.input = "";
    },

    scrollToBottom() {
      this.$nextTick(() => {
        let scrollable = this.$refs.scrollable;

        scrollable.scrollTop = scrollable.scrollHeight;
      });
    },
  },
};
</script>

<style scoped>
.chat-wrapper {
  display: flex;
  flex-direction: column;
  height: 100%;
  padding: 1.2rem;
}
.chat-container {
  position: relative;
  overflow-y: hidden;

  height: 100%;
  display: flex;
  flex-direction: column;

  padding: 1.2rem;

  background-color: #f3f6fb;
  border-radius: 16px;
}

.chat-messages {
  height: 100%;
  overflow: scroll;
  margin-bottom: calc(60px + 1.2rem);

  border-radius: 8px;
}
.chat-messages ul {
  display: flex;
  flex-direction: column;
}
.chat-messages li {
  display: flex;
}
.chat-messages li:not(:last-child) {
  margin-bottom: 1rem;
}
.user {
  align-self: flex-start;

  margin-right: 0.8rem;
  min-width: 40px;
  max-width: 40px;
}
.user img {
  object-fit: cover;
  width: 100%;

  border-radius: 50%;
  border: 3px solid lightcoral;
}
.user span {
  display: block;
  margin-top: 0.1rem;
  width: 100%;

  white-space: nowrap;
  overflow-x: hidden;

  font-weight: 600;
}
.message {
  display: flex;
  flex-direction: column;
}
.message p {
  padding: 0.6rem 0.8rem;
  border-radius: 8px;

  font-weight: 600;
  color: #05054f;
  background-color: #f5d7d7;
}
.message span {
  text-align: right;
  display: block;
  margin-top: 0.2rem;
  color: #6f6f6f;
}
.outbound {
  flex-direction: row-reverse;
}
.outbound .user {
  margin: 0 0 0 0.8rem;
}
.outbound .user img {
  border-color: #396eeb;
}
.outbound .message p {
  color: #fff;
  background-color: #0084ff;
}
.outbound .message span {
  text-align: left;
}

.chat-input {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 1.2rem;

  display: flex;
  box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.3);
  background-color: #f3f6fb;
  border-radius: 8px;
}
.chat-input input {
  flex-grow: 1;
  padding: 1rem;
  background-color: #fefeff;
  border-radius: 8px 0 0 8px;

  transition: box-shadow 0.3s ease;
}
.chat-input input:focus {
  outline: 0;
  box-shadow: inset 0 0 0 2px #0084ff;
}
.chat-input button {
  display: flex;
  align-items: center;

  padding: 1rem;
  background-color: #0084ff;
  border-radius: 0 8px 8px 0;
  outline-color: transparent;
}
ion-icon {
  color: #fff;
  font-size: 1.5rem;
}
</style>