<template>
  <div>
    <div v-show="hasMessage">
      <div class="alert alert-primary">{{ message }}</div>
    </div>

    <div class="alert alert-danger" v-show="isError">キーワードを入力してください</div>
    <input v-model="searchWord" placeholder="キーワードを入力" />
    <button @click="onClickSearchButton()" class="btn-default">検索</button>

    <tag-list-tab v-bind:currentTag="currentTag" @click-tab="onClickTabButton" />

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
            :to="{ name: 'articleDetail', params: { articleId: article.id }}"
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
import TagListTab from "../parts/TagListTab";
import ThePagination from "../parts/ThePagination";

import dayjs from "dayjs";
import "dayjs/locale/ja";
dayjs.locale("ja");

export default {
  name: "app",
  components: {
    TagListTab,
    ThePagination,
  },
  data() {
    return {
      articles: [],
      currentTag: "主要",
      //主要はDBから取得していないので、最初から入れておく
      current_page: 1,
      last_page: 1,
      total: 1,
      from: 0,
      to: 0,
      sort: "new",
      searchWord: "",
      isError: false,
      message: "",
    };
  },
  mounted() {
    this.message = this.$route.query.message;
    //メッセージがない時は初期の空文字にする
    if (this.$route.query.message === undefined) {
      this.message = "";
    } else {
      //メッセージがあった場合はmessageのクエリパラメータを削除する
      var query = Object.assign({}, this.$route.query);
      delete query.message;
      this.$router.push({ query: query });
    }

    this.currentTag = this.$route.query.tag;
    if (this.$route.query.tag === undefined) {
      this.currentTag = "主要";
    }

    this.load();
  },
  props: {},
  methods: {
    createdAt(date) {
      return dayjs(date).format("M/D(ddd) HH:mm");
    },
    onClickTabButton(tag) {
      this.currentTag = tag;

      this.$router.push(`/?tag=${tag}`);
      //現在のタグで絞り込んだ記事を取得する
      //タグが押された時は1ページ目を表示する
      this.load();
    },
    load() {
      const page = this.page;

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
        //タグで絞り込み&ページネーションを使った時の再読み込み対策
        if (this.currentTag === "主要") {
          this.$router.push(`/?page=${page}`);
        } else {
          this.$router.push(`/?tag=${this.currentTag}&page=${page}`);
        }
        this.load();
      }
    },
    onClickSearchButton() {
      if (this.searchWord == "") {
        this.isError = true;
      } else {
        this.isError = false;
        this.$router.push(
          `/articles-search-result?searchword=${this.searchWord}`
        );
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
    hasMessage() {
      if (this.message != "") {
        return true;
      }
      return false;
    },
  },
};
</script>
<style scoped>
</style>