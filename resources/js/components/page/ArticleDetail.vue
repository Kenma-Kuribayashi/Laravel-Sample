      <!--管理者の場合は投稿者でなくても表示-->
      <button
        v-show="isAuthor || auth.is_admin"
        class="btn btn-danger"
        @click="onClickDeleteButton()"
      >削除</button>

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
      recommendedArticles: [],
    //おすすめ記事の取得
    axios.get("/api/recommend_article/" + this.articleId).then(({ data }) => {
      this.recommendedArticles = data;
    });
    onClickRecommendArticleButton(articleId) {
      this.articleId = articleId;
      this.$router.push(`/articles/${articleId}`);

      axios.get("/api/get/article/" + this.articleId).then(({ data }) => {
        this.article = data.data;
      });

      //おすすめ記事の取得
      axios.get("/api/recommend_article/" + this.articleId).then(({ data }) => {
        this.recommendedArticles = data;
      });
    },
    onClickDeleteButton() {
       axios.delete("/api/articles/" +this.articleId).then(({data})  => {
        if (data === "success") {
          this.message = "記事を削除しました。"
          this.$router.push({ path: '/', query: { message: '記事を削除しました。' } });
        }
      });
    },
