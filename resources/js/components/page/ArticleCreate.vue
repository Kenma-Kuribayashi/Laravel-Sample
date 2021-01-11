<template>
  <div>
    <h1>記事の新規投稿</h1>

    <div v-show="message !== ''">
      <div class="alert alert-primary">{{ message }}</div>
    </div>

    <div v-for="(error, index) in errors" :key="index" class="text-danger">
      {{ error }}
    </div>

    <modal
      v-bind:modalMessage="modalMessage"
      @click-articleList="onClickArticleListButton()"
      v-show="showModal"
    />

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
      <option v-for="(tag, index) in tags" :key="index" :value="tag.id">
        {{ tag.name }}
      </option>
    </select>

    <ValidationProvider rules="required|image" v-slot="{ errors }">
      <p>画像:</p>
      <div class="form_parts">
        <input type="file" name="image" ref="file" @change="setImage" />
        <div class="text-danger" v-show="errors[0]">{{ errors[0] }}</div>
      </div>
    </ValidationProvider>

    <div class="btn-container">
      <button
        @click="onClickSubmitButton()"
        :disabled="!ablePost"
        class="btn btn-primary"
      >
        新規投稿
      </button>
    </div>
  </div>
</template>

<script>
import Modal from "../parts/Modal";
import axios from "axios";
import dayjs from "dayjs";
import "dayjs/locale/ja";
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

export default {
  components: {
    ValidationProvider,
    Modal,
  },
  props: {
    auth: {
      type: Object,
      required: true,
    },
    // errors: {
    //     type: Array | Object,
    //     required: true,
    // }
  },
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
      tagId: 1,
      showModal: false,
      modalMessage: "",
    };
  },
  mounted() {
    this.publishedAt = dayjs().format("YYYY-MM-DD");

    this.$http.get("/api/tags").then((response) => {
      this.tags = response.data.data;
    });
  },
  methods: {
    async onClickSubmitButton() {
      const form = new FormData();
      form.append("title", this.title);
      form.append("body", this.body);
      form.append("published_at", this.publishedAt);
      form.append("tagId", this.tagId);
      form.append("image", this.image_data);

      try {
        this.isSending = true;

        await axios.post("/api/articles/", form, {
          headers: { "content-type": "multipart/form-data;" },
        });

        this.modalMessage = "記事の新規作成しました。";
        this.showModal = true;
      } catch (err) {
        for (let k in err.response.data.errors) {
          err.response.data.errors[k].forEach((a) => {
            this.errors.push(a);
          });
          this.message = "記事の新規作成に失敗しました。";
        }
      }
      this.isSending = false;
    },
    setImage() {
      const files = this.$refs.file;
      this.image_data = files.files[0];
    },
    onClickArticleListButton() {
      this.$router.push({ name: 'articleList' });
    },
  },
  computed: {
    ablePost() {
      if (
        this.title.length >= 3 &&
        this.title.length <= 50 &&
        this.body !== "" &&
        this.body.length <= 100 &&
        this.image_data.image !== ""
      ) {
        return true;
      }
      return false;
    },
  },
  watch: {},
};
</script>

<style scoped>
</style>
