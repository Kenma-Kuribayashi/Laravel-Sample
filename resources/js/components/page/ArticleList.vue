<template>
  <div>
    <tag-list-tab />

    <div class="articles">
      <article v-for="(article, index) in articles" :key="index">
        <figure>
          <!-- <img
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
          />-->
        </figure>
        <div class="news-li">{{ article.title }}</div>
        <div class="created-time">{{ createdAt(article.created_at) }}</div>
      </article>
    </div>

    <div class="row">
      <div class="col-sm-6">
    <ul class="pagination">
      <li :class="['page-item', {disabled: current_page <= 1}]">
        <a class="page-link" href="#" @click="change(1)">&laquo;</a>
      </li>
      <li :class="['page-item', {disabled: current_page <= 1}]">
        <a class="page-link" href="#" @click="change(current_page - 1)">&lt;</a>
      </li>
      <li v-for="page in pages" :key="page" :class="['page-item', {active: page === current_page}]">
        <a class="page-link" href="#" @click="change(page)">{{page}}</a>
      </li>
      <li :class="['page-item', {disabled: current_page >= last_page}]">
        <a class="page-link" href="#" @click="change(current_page + 1)">&gt;</a>
      </li>
      <li :class="['page-item', {disabled: current_page >= last_page}]">
        <a class="page-link" href="#" @click="change(last_page)">&raquo;</a>
      </li>
    </ul>
      </div>
    </div>
  </div>
</template>


  <!-- <div class="articles">
   @foreach($articles as $article)
     <article>
      <figure>
      @if (!empty($article->image_path))

      @else
        <img src='data:img/png;base64,{{$article->image}}' class="news-image" width="75px" height="50px">
      @endif
    </figure>
      @auth
      <a href="{{ url('articles',[$article->id, $currentUser->id]) }}" class="news-li">{{ $article->title }}</a>
      @endauth
      @guest
      <a href="{{ url('articles', $article->id) }}" class="news-li">{{ $article->title }}</a>
      @endguest
      
      <div class="created-time">
        {{ $article->created_at->format('n/d ') . '(' . 
        $week[$article->created_at->format('w')] . ')'}}
        {{ $article->created_at->format('H:i') }}
      </div>
    </article>
   @endforeach
  </div>-->
<script>
import TagListTab from "../layout/TagListTab";

import dayjs from "dayjs";
import "dayjs/locale/ja";
dayjs.locale("ja");

export default {
  name: "app",
  components: {
    TagListTab
  },
  data() {
    return {
      articles: [],
      current_page: 1,
      last_page: 1,
      total: 1,
      from: 0,
      to: 0
    };
  },
  mounted() {
    this.load(1);
    // Laravelで、QueryBuilder::paginate(10)とかで10件取れる
    // LengthAwarePaginator
    // this.$http.get("/api/get/articles").then(response => {
    //オブジェクトが入った配列
    //   this.articles = response.data.data;
    // });
  },
  props: {},
  methods: {
    createdAt(date) {
      return dayjs(date).format("M/D(ddd) HH:mm");
    },
    load(page) {
      axios.get("/api/get/articles?page=" + page).then(({ data }) => {
        this.articles = data.data;
        this.current_page = data.current_page;
        this.last_page = data.last_page;
        this.total = data.total;
        this.from = data.from;
        this.to = data.to;
      });
    },
    change(page) {
      if (page >= 1 && page <= this.last_page) this.load(page);
    }
  },
  computed: {
    //現在のページを中央に置いて5ページ分の配列を算出
    pages() {
      let start = _.max([this.current_page - 2, 1]);
      let end = _.min([start + 5, this.last_page + 1]);
      start = _.max([end - 5, 1]);
      return _.range(start, end);
    }
  }
};
</script>
<style scoped>
/* .pagination {
  display: flex;
  list-style-type: none;
}
.pagination li {
  border: 1px solid #ddd;
  padding: 6px 12px;
  text-align: center;
} */
</style>