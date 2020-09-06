<template>
  <div>
    <tag-list-tab v-bind:currentTag="currentTag" @click-tab="onClickTabButton" />

    <!-- <ul v-show="hasErrors">
      <li v-for="(error, index) in errors" :key="index">{{ error }}
      </li>
    </ul>-->

    <div v-show="hasMessage">
      <div class="alert alert-primary">{{ message }}</div>
    </div>

    <div class="panel panel-default">
      <figure v-show="article.hasImagePath">
        <img :src="article.imagePath" width="533px" height="400px" />
      </figure>
    </div>

    <h1>{{ article.title }}</h1>

    <article>
      <div class="body">{{ article.body }}</div>
    </article>
    <div v-show="article.hasTags">
      <h5>Tags:</h5>
      <ul>
        <li v-for="(tag) in article.tags" :key="tag.id">{{ tag.name }}</li>
      </ul>
    </div>

    <div class="my-modal" v-show="isModal">
      <div class="my-modal-dialog">
        <div class="modal-body">
          <p>記事を削除しました。</p>
          </div>
      <div class="modal-footer">
        <router-link :to="{ name: 'articleList'}" class="btn btn-secondary float-right">一覧へ戻る</router-link>
      </div>
      </div>
    </div>

    <div v-if="auth.length !== 0">
      <!-- 投稿したユーザーのidとログインユーザーのidが一致する場合表示 -->

      <a v-show="isAuthor" href="#" class="btn btn-primary">編集</a>
      <!--管理者の場合は投稿者でなくても表示-->
      <button
        v-show="isAuthor || auth.is_admin"
        class="btn btn-danger"
        @click="onClickDeleteButton()"
      >削除</button>

      <!-- <form id="delete-form" :action="`api/articles/${articleId}`" method="post">
        <input type="hidden" name="_token" :value="csrf" /> -->
        <!-- <input type="hidden" name="_method" value="DELETE"> -->
        <!-- <input type="submit" value="delete!!" />
      </form> -->

      <br />
      <br />
      <div v-show="isAuthor">
        <div class="red">※画像ファイルは50KB以下でお願いします。(現在改良中のため)</div>
        <!-- <form
        action="/upload/{{ $article->getArticleId() }}"
        method="POST"
        enctype="multipart/form-data"
        class="post_form"
        >-->
        <div class="form_parts">
          <label for="photo">画像ファイル:</label>
          <input type="file" class="form-control" name="image" />
          <br />
          <!-- {{ csrf_field() }} -->
          <button class="btn btn-success">投稿</button>
        </div>
        <!-- </form> -->
      </div>
    </div>

    <router-link :to="{ name: 'articleList'}" class="btn btn-secondary float-right">一覧へ戻る</router-link>

    <br />
    <div class>おすすめの記事</div>

    <div class="articles" v-for="(article, index) in recommendedArticles" :key="index">
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
        >{{ article.title }}</button>

        <div class="created-time">{{ createdAt(article.created_at) }}</div>
      </article>
    </div>
  </div>
</template>

<script>
import TagListTab from "../parts/TagListTab";
import dayjs from "dayjs";
import "dayjs/locale/ja";
dayjs.locale("ja");

export default {
  components: {
    TagListTab,
  },
  props: {
    auth: {
      type: Object | Array,
    },
    errors: {
      type: Object | Array,
    },
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
      isModal: false,
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
      axios.delete("/api/articles/" + this.articleId).then(({status}) => {
        if (status === 200) {
          this.isModal = true;
        }
        
      });
    },
  },
  computed: {
    // hasErrors() {
    //   if (this.errors[0]) {
    //     return true;
    //   }
    //   return false;
    // },
    hasMessage() {
      if (this.message != "") {
        return true;
      }
      return false;
    },
    isAuthor() {
      if (this.article.userId === this.auth.id) {
        return true;
      }
      return false;
    },
  },
  watch: {
    $route: {
      handler: function () {
        this.articleId = this.$route.params.articleId;

        axios.get("/api/get/article/" + this.articleId).then(({ data }) => {
          this.article = data.data;
        });

        //おすすめ記事の取得
        axios
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
.my-modal {
  position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background: rgba(0, 0, 0, 0.5);
}

.my-modal-dialog {
  position: absolute;
  top: 30px;
  left: calc(50% - 150px);
  width: 400px;
  background: white;
}
</style>