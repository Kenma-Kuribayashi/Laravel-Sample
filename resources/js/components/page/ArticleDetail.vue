<template>
  <div>
    <tag-list-tab
      v-bind:currentTag="currentTag"
      @click-tab="onClickTabButton"
    />

    <!-- <ul v-show="hasErrors">
      <li v-for="(error, index) in errors" :key="index">{{ error }}
      </li>
    </ul>-->

    <div v-show="message !== ''">
      <div class="alert alert-danger">{{ message }}</div>
    </div>

    <div class="panel panel-default">
      <figure v-show="article.imagePath !== []">
        <img :src="article.imagePath" width="533px" height="400px" />
      </figure>
    </div>

    <h1>{{ article.title }}</h1>

    <article>
      <div class="body">{{ article.body }}</div>
    </article>
    <div v-show="article.tags !== []">
      <h5>Tags:</h5>
      <ul>
        <li v-for="tag in article.tags" :key="tag.id">{{ tag.name }}</li>
      </ul>
    </div>

    <modal
      v-bind:modalMessage="modalMessage"
      @click-articleList="onClickArticleListButton()"
      v-show="showModal"
    />

    <div v-if="auth.length !== 0">
      <!-- 投稿したユーザーのidとログインユーザーのidが一致する場合表示 -->

      <a v-show="isAuthor" href="#" class="btn btn-primary">編集</a>
      <!--管理者の場合は投稿者でなくても表示-->
      <button
        v-show="isAuthor || auth.is_admin"
        class="btn btn-danger"
        @click="onClickDeleteButton()"
        :disabled="isSending"
      >
        削除
      </button>
    </div>

    <router-link
      :to="{ name: 'articleList' }"
      class="btn btn-secondary float-right"
      >一覧へ戻る</router-link
    >

    <br />
    <div class>おすすめの記事</div>

    <div
      class="articles"
      v-for="(article, index) in recommendedArticles"
      :key="index"
    >
      <article>
        <figure>
          <img
            :src="`data:img/png;base64,${article.image}`"
            class="news-image"
            width="75px"
            height="50px"
          />
        </figure>
        <button
          class="btn btn-link"
          @click="onClickRecommendArticleButton(article.id)"
        >
          {{ article.title }}
        </button>

        <div class="created-time">{{ createdAt(article.created_at) }}</div>
      </article>
    </div>
  </div>
</template>

<script>
import Modal from "../parts/Modal";
import TagListTab from "../parts/TagListTab";
import axios from "axios";
import dayjs from "dayjs";
import "dayjs/locale/ja";
dayjs.locale("ja");

export default {
  components: {
    TagListTab,
    Modal,
  },
  props: {
    auth: {
      type: Object,
      required: true,
    },
    // errors: {
    //   type: Object | Array,
    // },
  },
  data() {
    return {
      currentTag: "主要",
      article: "",
      articleId: "",
      // errors: [],
      recommendedArticles: [],
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      message: "",
      showModal: false,
      isSending: false,
      modalMessage: "",
    };
  },
  mounted() {},
  methods: {
    createdAt(date) {
      return dayjs(date).format("M/D(ddd) HH:mm");
    },
    onClickTabButton(tag) {
      this.currentTag = tag;

      this.$router.push(`/?tag=${tag}`);
    },
    onClickRecommendArticleButton(articleId) {
      this.$router.push(`/articles/${articleId}`);
    },
    onClickDeleteButton() {
      this.isSending = true;

      this.$axios.delete("/api/articles/" + this.articleId)
      .then(() => {
          this.isModal = true;
      }) .catch(err => {
        this.message = "記事の削除に失敗しました。"
      }) .finally(() => this.isSending = false);
    },
  },
  computed: {
    // hasErrors() {
    //   if (this.errors[0]) {
    //     return true;
    //   }
    //   return false;
    // },
    isAuthor() {
      if (this.article.userId === this.auth.id) {
        return true;
      }
      return false;
    },
  },
  watch: {
    $route: {
      handler: async function () {
        this.articleId = this.$route.params.articleId;

        // axios.get("/api/get/article/" + this.articleId).then(({ data }) => {
        //   this.article = data.data;

        // const article = axios.get("/api/get/article/" + this.articleId)
        // console.log(article)

        // const articleThen = article.then((res) => {
        //   console.log(res);
        //   return res;
        //   // this.article = res.data
        // });
        // console.log(articleThen);
        // this.article = articleThen.data

        this.article = (await this.$axios.get("/api/get/article/" + this.articleId)).data

        // const awaitRes = await axios.get("/api/get/article/" + this.articleId)
        // console.log(awaitRes)
        // this.article = awaitRes.data

        const awaitRes = await axios.get("/api/get/article/" + this.articleId);
        //console.log(awaitRes)
        this.article = awaitRes.data.data;
        //console.log(this.article);

        //おすすめ記事の取得
        this.$axios
          .get("/api/recommend_article/" + this.articleId)
          .then(({ data }) => {
            this.recommendedArticles = data;
          });
      },
      immediate: true,
    },
  },
};
</script>

<style scoped>
</style>
