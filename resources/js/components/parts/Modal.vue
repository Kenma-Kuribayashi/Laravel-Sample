<template>
  <div class="my-modal">
    <div class="my-modal-dialog">
      <div class="modal-body">
        <p>{{ modalMessage }}</p>
      </div>
      <div class="modal-footer">
        <button
          :to="{ name: 'articleList' }"
          class="btn btn-secondary float-right"
          @click="onClickArticleListButton()"
        >
          一覧へ戻る
        </button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    modalMessage: {
      type: String,
      required: true,
    },
  },
  data() {
    return {};
  },
  methods: {
    onClickArticleListButton() {
      this.$emit("click-articleList");
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