<template>
    <div class="row">
      <div class="col-sm-6">
    <ul class="pagination">
      <li :class="['page-item', {disabled: current_page <= 1}]">
        <a class="page-link" href="" @click.prevent="change(1)">&laquo;</a>
      </li>
      <li :class="['page-item', {disabled: current_page <= 1}]">
        <a class="page-link" href="#" @click.prevent="change(current_page - 1)">&lt;</a>
      </li>
      <li v-for="page in pages" :key="page" :class="['page-item', {active: page === current_page}]">
        <a class="page-link" href="#" @click.prevent="change(page)">{{page}}</a>
      </li>
      <li :class="['page-item', {disabled: current_page >= last_page}]">
        <a class="page-link" href="#" @click.prevent="change(current_page + 1)">&gt;</a>
      </li>
      <li :class="['page-item', {disabled: current_page >= last_page}]">
        <a class="page-link" href="#" @click.prevent="change(last_page)">&raquo;</a>
      </li>
    </ul>
      </div>
    </div>
</template>
<script>
export default {
  data() {
    return {
      current_page: 1,
      last_page: 1,
      total: 1,
      from: 0,
      to: 0
    };
  },
  mounted() {
    const page = this.$route.query.page || 1;
    this.load(page);
  },
  methods: {
    load(page) {
      axios.get("/api/get/articles?page=" + page).then(({ data }) => {
        this.$parent.articles = data.data;
        this.current_page = data.current_page;
        this.last_page = data.last_page;
        this.total = data.total;
        this.from = data.from;
        this.to = data.to;
      });
    },
    change(page) {
      if (page >= 1 && page <= this.last_page) this.load(page);
      this.$router.push(`/?page=${page}`);
    }
  },
    computed: {
    //現在のページを中央に置いて5ページ分の配列を算出
    pages() {
      let start = _.max([this.current_page - 2, 1]);
      let end = _.min([start + 5, this.last_page + 1]);
      start = _.max([end - 5, 1]);
      return _.range(start, end);
    }
  }
};
</script>
<style scoped>

</style>