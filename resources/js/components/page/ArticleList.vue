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

    <the-pagination />
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
import TagListTab from "../parts/TagListTab";
import ThePagination from "../parts/ThePagination";

import dayjs from "dayjs";
import "dayjs/locale/ja";
dayjs.locale("ja");

export default {
  name: "app",
  components: {
    TagListTab,
    ThePagination
  },
  data() {
    return {
      articles: [],
    };
  },
  mounted() {
  },
  props: {},
  methods: {
    createdAt(date) {
      return dayjs(date).format("M/D(ddd) HH:mm");
    }
  },
  computed: {
  }
};
</script>
<style scoped>
</style>