import Vue from 'vue'
import Router from 'vue-router'
import ArticleList from './components/page/ArticleList'
import ArticleDetail from './components/page/ArticleDetail'
import ArticleSearchResults from './components/page/ArticleSearchResults'
import ArticleCreate from './components/page/ArticleCreate'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'articleList',
            component: ArticleList
        },
        {
            path: '/articles/create',
            name: 'ArticleCreate',
            component: ArticleCreate
        },
        {
            path: '/articles/articles-search-result',
            name: 'ArticleSearchResults',
            component: ArticleSearchResults
        },
        {
            path: '/articles/:articleId',
            name: 'articleDetail',
            component: ArticleDetail
        },


    ]
})
