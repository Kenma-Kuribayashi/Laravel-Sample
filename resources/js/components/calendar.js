import Vue from 'vue'
import App from './Calendar.vue'

new Vue({
  el: 'app', // 「el」はアプリケーションを紐付ける要素のセレクタ
  components: {
    app: App //使用するコンポーネントの名称と使うコンポーネントを指定（app:名称, App:使うコンポーネント）
  }
})