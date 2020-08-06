<template>
  <div>
    <div class="alert alert-danger" v-show="isError">キーワードを入力してください</div>

    <input v-model="searchWord" placeholder="キーワードを入力" />
    <button @click="onClickSearchButton()" class="btn-default">検索</button>

    <div v-show="isSearchResult">
      <h3 class="text-muted">検索結果  {{this.total}}件該当</h3>
    </div>

    <div class="articles">
      <article v-for="(article) in articles" :key="article.id">
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
          <router-link
            :to="{ name: 'articleDetail', params: { articleId: article.id}}"
          >SPA{{ article.title }}</router-link>
          <a :href="`/articles/${article.id}`">{{ article.title }}</a>
        </div>
        <div class="created-time">{{ createdAt(article.created_at) }}</div>
      </article>
    </div>

    <the-pagination
      v-bind:current_page="current_page"
      v-bind:last_page="last_page"
      v-bind:total="total"
      v-bind:from="from"
      v-bind:to="to"
      @clicked-pagination="change"
    />
  </div>
</template>

<script>
import ThePagination from "../parts/ThePagination";

import dayjs from "dayjs";
import "dayjs/locale/ja";
dayjs.locale("ja");

export default {
  name: "app",
  components: {
    ThePagination,
  },
  data() {
    return {
      articles: [],
      current_page: 1,
      last_page: 1,
      total: 1,
      from: 0,
      to: 0,
      searchWord: "",
      isSearchResult: false,
      isError: false,
    };
  },
  mounted() {
    if (this.$route.query.searchword !== undefined) {
      this.searchWord = this.$route.query.searchword;
      this.isSearchResult = true;
      this.load();
    }
  },
  props: {},
  methods: {
    createdAt(date) {
      return dayjs(date).format("M/D(ddd) HH:mm");
    },
    load() {
      const page = this.page;
      const searchWord = this.searchWord;

      axios
        .get(
          "/api/get/articles/" + "?page=" + page + "&searchword=" + searchWord
        )
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
        //タグで絞り込み&ページネーションを使った時の再読み込み対策
        this.$router.push(`/?page=${page}`);

        this.load();
      }
    },
    onClickSearchButton() {
      if (this.searchWord == "") {
        this.isError = true;
      } else {
        this.isError = false;
        this.$router.push(
          `/articles-search-result?page=${this.current_page}&searchword=${this.searchWord}`
        );
        this.isSearchResult = true;
        this.load();
      }
    },
  },
  computed: {
    page() {
      if (this.$route.query.page === undefined) {
        return 1;
      }
      return this.$route.query.page;
    },
  },
};
</script>

<style scoped>
</style>