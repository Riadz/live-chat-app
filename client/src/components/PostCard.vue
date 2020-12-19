<template>
  <div class="flex flex-col p-4 m-4 rounded-md shadow-xl bg-white">
    <div class="flex flex-col">
      <h2 class="text-lg text-green-400">
        {{ post.title }}
      </h2>
      <span class="text-sm">
        By <span class="text text-green-800">user_id_{{ post.userId }}</span>
      </span>
    </div>
    <p class="p-4">
      {{ post.body }}
    </p>
  </div>
</template>

<script>
export default {
  props: ["post"],
};
</script>

<style>
</style>