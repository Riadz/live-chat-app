<template>
  <base-layout>
    <div class="h-full flex flex-col p-10">
      <h1 class="text-4xl text-center mb-28">Register</h1>
      <div class="relative h-8 text-center mb-4">
        <span v-if="name" class="floating-text">connect as "{{ name }}"</span>
      </div>
      <form @submit.prevent="register">
        <ion-item>
          <ion-label position="floating">Name</ion-label>
          <ion-input v-model="name" required></ion-input>
        </ion-item>
        <button
          class="absolute p-7 text-4xl bg-green-500 text-white rounded-lg"
        >
          Connect !
        </button>
      </form>
    </div>
  </base-layout>
</template>

<script>
import { ref } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";

import { IonItem, IonLabel, IonInput } from "@ionic/vue";
export default {
  components: { IonItem, IonLabel, IonInput },

  setup() {
    const store = useStore();
    const router = useRouter();

    let name = ref("");

    let register = () => {
      store.commit("setUserName", name.value);
      router.push("chat");
    };

    return { name, register, store };
  },
};
</script>

<style scoped>
button {
  bottom: 2rem;
  left: 50%;
  transform: translateX(-50%);
}
.floating-text {
  position: absolute;
  left: 0;
  right: 0;
}
</style>