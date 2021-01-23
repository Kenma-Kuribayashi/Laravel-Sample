<template>
  <div class="row">
    <div class="col-sm-6">
      <ul class="pagination">
        <li :class="['page-item', { disabled: current_page <= 1 }]">
          <a class="page-link" href @click.prevent="change(1)">&laquo;</a>
        </li>
        <li :class="['page-item', { disabled: current_page <= 1 }]">
          <a
            class="page-link"
            href="#"
            @click.prevent="change(current_page - 1)"
            >&lt;</a
          >
        </li>
        <li
          v-for="page in pages"
          :key="page"
          :class="['page-item', { active: page === current_page }]"
        >
          <a class="page-link" href="#" @click.prevent="change(page)">{{
            page
          }}</a>
        </li>
        <li :class="['page-item', { disabled: current_page >= last_page }]">
          <a
            class="page-link"
            href="#"
            @click.prevent="change(current_page + 1)"
            >&gt;</a
          >
        </li>
        <li :class="['page-item', { disabled: current_page >= last_page }]">
          <a class="page-link" href="#" @click.prevent="change(last_page)"
            >&raquo;</a
          >
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    current_page: {
      type: Number,
      required: true,
    },
    last_page: {
      type: Number,
      required: true,
    },
    total: {
      type: Number,
      required: true,
    },
    from: {
      type: Number,
      required: true,
    },
    to: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {};
  },
  mounted() {},
  methods: {
    change(page) {
      this.$emit('clicked-pagination', page);
    },
  },
  computed: {
    //現在のページを中央に置いて5ページ分の配列を算出
    pages() {
      let start = _.max([this.current_page - 2, 1]);
      let end = _.min([start + 5, this.last_page + 1]);
      start = _.max([end - 5, 1]);
      return _.range(start, end);
    },
  },
};
</script>
<style scoped>
</style>