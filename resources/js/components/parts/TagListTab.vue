<template>
  <div class="nav-body">
    <ul class="nav nav-tabs">
      <li class="nav-item" v-for="(tag, index) in tags" :key="index">
        <button
          :class="['nav-link', { active: currentTag === tag }]"
          @click="onClickTabButton(tag)"
        >{{ tag }}</button>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  props: {
    currentTag: String,
  },
  data() {
    return {
      //主要はDBから取得していないので、入れておく
      tags: ["主要"],
    };
  },
  mounted() {
    this.$http.get("/api/tags").then((response) => {
      response.data.data.forEach((tag) => {
        this.tags.push(tag.name);
      });
    });
  },
  methods: {
    onClickTabButton(tag) {
      this.$emit("click-tab", tag);
    },
  },
};
</script>
<style scoped>
.nav-link {
  background: #44739c;
  color: white;
}
</style>