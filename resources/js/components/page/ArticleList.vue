<template>
  <div>
    <!-- <tag-list-tab /> -->

    <div class="nav-body">
      <ul class="nav nav-tabs">
        <li class="nav-item" v-for="tag in tags" :key="tag">
          <button
            :class="['nav-link', { active: currentTag === tag }]"
            @click="onClickTabButton(tag)"
          >{{ tag }}</button>
        </li>
      </ul>
    </div>

    <div class="articles">
      <article v-for="(article, index) in articles" :key="index">
        <figure>
          <img
            v-if="article.image_path !== null"
            :src="`https://test-bucket-sample-news.s3-ap-northeast-1.amazonaws.com/myprefix/${ article.image_path }`"
            class="news-image"
            width="75px"
            height="50px"
          />
          <img
            v-else
            :src="`data:img/png;base64,${article.image}`"
            class="news-image"
            width="75px"
            height="50px"
          />
        </figure>
        <div class="news-li">
          <a :href="`/articles/${article.id}`">{{ article.title }}</a>
        </div>
        <div class="created-time">{{ createdAt(article.created_at) }}</div>
      </article>
    </div>

    <!-- <the-pagination /> -->

    <div class="row">
      <div class="col-sm-6">
        <ul class="pagination">
          <li :class="['page-item', {disabled: current_page <= 1}]">
            <a class="page-link" href @click.prevent="change(1)">&laquo;</a>
          </li>
          <li :class="['page-item', {disabled: current_page <= 1}]">
            <a class="page-link" href="#" @click.prevent="change(current_page - 1)">&lt;</a>
          </li>
          <li
            v-for="page in pages"
            :key="page"
            :class="['page-item', {active: page === current_page}]"
          >
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
  </div>
</template>

<script>
// import TagListTab from "../parts/TagListTab";
// import ThePagination from "../parts/ThePagination";

import dayjs from "dayjs";
import "dayjs/locale/ja";
dayjs.locale("ja");

export default {
  name: "app",
  components: {
    // TagListTab,
    // ThePagination
  },
  data() {
    return {
      articles: [],
      currentTag: "主要",
      //主要はDBから取得していないので、最初から入れておく
      tags: ["主要"],
      current_page: 1,
      last_page: 1,
      total: 1,
      from: 0,
      to: 0,
    };
  },
  mounted() {
    this.$http.get("/api/tags").then((response) => {
      response.data.data.forEach((element) => {
        this.tags.push(element);
      });
      const page = this.$route.query.page || 1;
      this.currentTag = this.$route.query.tag || "主要";

      this.load(page);
    });
  },
  props: {},
  methods: {
    createdAt(date) {
      return dayjs(date).format("M/D(ddd) HH:mm");
    },
    onClickTabButton(tag) {
      this.currentTag = tag;
      //現在のタグで絞り込んだ記事を取得する
      //タグが押された時は1ページ目を表示する
      this.load(1);

      this.$router.push(`/?tag=${tag}`);
    },
    load(page) {
      axios
        .get("/api/get/articles/" + this.currentTag + "?page=" + page)
        .then(({ data }) => {
          this.articles = data.data;
          this.current_page = data.current_page;
          this.last_page = data.last_page;
          this.total = data.total;
          this.from = data.from;
          this.to = data.to;
        });
    },
    change(page) {
      if (page >= 1 && page <= this.last_page) {
        this.load(page);
      }
      //タグで絞り込み&ページネーションを使った時の再読み込み対策
      if (this.currentTag === "主要") {
        this.$router.push(`/?page=${page}`);
      } else {
        this.$router.push(`/?tag=${this.currentTag}&page=${page}`);
      }
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
.nav-link {
  background: #44739c;
  color: white;
}
</style>