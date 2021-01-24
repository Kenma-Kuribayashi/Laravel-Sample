<template>
  <div>
    <h1>記事の新規投稿</h1>

    <div v-show="hasMessage">
      <div class="alert alert-primary">{{ message }}</div>
    </div>

    <!-- <modal
      v-bind:modalMessage="modalMessage"
      @click-articleList="onClickArticleListButton()"
      v-show="showModal"
    /> -->

    <ValidationProvider rules="required|min:3|max:50" v-slot="{ errors }">
      <p>タイトル:</p>
      <input class="form-control" name="title" v-model="title" />
      <div class="text-danger" v-show="errors[0]">{{ errors[0] }}</div>
    </ValidationProvider>

    <ValidationProvider rules="required|max:100" v-slot="{ errors }">
      <p>本文:</p>
      <textarea class="form-control" name="body" v-model="body"></textarea>
      <div class="text-danger" v-show="errors[0]">{{ errors[0] }}</div>
    </ValidationProvider>

    <ValidationProvider rules="required" v-slot="{ errors }">
      <p>記事の公開日:</p>
      <input
        class="form-control"
        type="date"
        name="published_at"
        v-model="publishedAt"
      />
      <div class="text-danger" v-show="errors[0]">{{ errors[0] }}</div>
    </ValidationProvider>

        <p>タグ:</p>
    <select class="form-control" v-model="tagId">
      <option disabled value="">1つ選択してください</option>
      <option v-for="tag in tags" :key="tag.id" v-bind:value="tag.id">{{ tag.name }}</option>
    </select>

    <ValidationProvider rules="image" v-slot="{ errors, validate }">
      <p>画像:</p>
      <div class="form_parts">
        <input
          type="file"
          name="image"
          ref="file"
          @change="validate() && onChangeImage()"
        />
        <div class="text-danger" v-show="errors[0]">{{ errors[0] }}</div>
      </div>
    </ValidationProvider>

    <div class="btn-container">
      <button
        @click="onClickSubmitButton()"
        class="btn btn-primary"
      >
        新規投稿
      </button>
    </div>
  </div>
</template>

<script>
import dayjs from "dayjs";
import "dayjs/locale/ja";
dayjs.locale("ja");
import { ValidationProvider, extend } from "vee-validate";
import { required, min, max } from "vee-validate/dist/rules";
extend("required", {
  ...required,
  message: "{_field_}は必須です",
});
extend("max", {
  ...max,
  message: "{_field_}は{length}文字以内で入力してください",
});
extend("min", {
  ...min,
  message: "{_field_}は{length}文字以上で入力してください",
});
// extend("image", {
//   ...image,
//   message: "{_field_}はjpegもしくはpngファイルを選択してください。",
// });

export default {
  components: {
    ValidationProvider,
    // Modal,
  },
  props: {},
  data() {
    return {
      errors: [],
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      message: "",
      title: "",
      body: "",
      publishedAt: "",
      tags: [],
      image_data: {
        image: "",
        name: "",
      },
      tagId: "",
      showModal: false,
      modalMessage: "",
    };
  },
  computed: {
    hasMessage() {
      if (this.message !== "") {
        return true;
      }
      return false;
    },
  },
  mounted() {
    this.publishedAt = dayjs().format("YYYY-MM-DD");

    this.$axios.get("/api/tags").then((response) => {
      this.tags = response.data.data;
    });
  },
  methods: {
    async onClickSubmitButton() {
      const form = new FormData();
      form.append("title", this.title);
      form.append("body", this.body);
      form.append("published_at", this.publishedAt);
      form.append("tag_id", this.tagId);
      form.append("image", this.image_data);

      try {
        this.isSending = true;

        await this.$axios.post("/api/articles/", form, {
          headers: { "content-type": "multipart/form-data;" },
        });

        this.isModal = true;
      } catch (e) {
        this.message = "記事の新規作成に失敗しました。";
      }
      this.isSending = false;
    },
    onChangeImage() {
      const files = this.$refs.file;
      this.image_data = files.files[0];
    },
  },
  watch: {},
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
