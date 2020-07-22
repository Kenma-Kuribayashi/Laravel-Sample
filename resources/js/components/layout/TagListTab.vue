<template>
  <div class="nav-body">
    <ul class="nav nav-tabs">
      <li class="nav-item" v-for="tag in tags" :key="tag">
        <button
          :class="['nav-link', { active: currentTag === tag }]"
          @click="currentTag = tag"
        >{{ tag }}</button>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  data() {
    return {
      currentTag: "主要",
      //主要はDBから取得していないので、最初から入れておく
      tags: ["主要"]
    };
  },
  mounted() {
    this.$http.get("/api/tags").then(response => {
      response.data.data.forEach(element => {
        this.tags.push(element);
      });
    });
  },
};
</script>
<style scoped>
.nav-link {
  background: #44739c;
  color: white;
}
</style>