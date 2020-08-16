      <!--管理者の場合は投稿者でなくても表示-->
      <button
        v-show="isAuthor || auth.is_admin"
        class="btn btn-danger"
        @click="onClickDeleteButton()"
      >削除</button>

    onClickDeleteButton() {
       axios.delete("/api/articles/" +this.articleId).then(({data})  => {
        if (data === "success") {
          this.message = "記事を削除しました。"
          this.$router.push({ path: '/', query: { message: '記事を削除しました。' } });
        }
      });
    },
