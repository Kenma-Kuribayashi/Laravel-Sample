<template>
    <div>
        <div v-show="isLoading">
            <div class="text-center">
                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>

        <div v-show="isError">
            <div>登録が失敗しました。</div>
            <p>登録が失敗した理由として以下が考えられます。</p>
            <ul>
                <li>①本登録用のURLの有効期限が切れてしまっている</li>
                <li>②すでに本登録済みである</li>
                <li>③通信エラーで失敗してしまった</li>
            </ul>
            <p>そのため、以下をご確認の上、再度お試し頂けますでしょうか。</p>
            <ul>
                <li>①の場合、再度会員登録をお願いいたします。</li>
                <li>③の場合、時間を置いて再度メールの「メールアドレスの確認」ボタンをクリックしてください。</li>
            </ul>

            <!--todo:会員登録画面作成する-->
            <!--            <router-link :to="{ name: '' }" class="btn btn-primary">-->
            <!--                会員登録ページへ-->
            <!--            </router-link>-->
        </div>
    </div>
</template>

<script>

export default {
    name: "Activate",
    data() {
        return {
            id: null,
            expires: null,
            signature: null,
            isLoading: true,
            isError: false,
        };
    },
    async mounted() {
        this.isLoading = true;

        this.id = this.$route.query.id !== undefined ? this.$route.query.id : null;
        this.expires = this.$route.query.expires !== undefined ? this.$route.query.expires : null;
        this.signature = this.$route.query.signature !== undefined ? this.$route.query.signature : null;

        try {
            //会員登録メール認証API
            await this.$axios
                .post(`/api/users/register/activate?expires=${this.expires}&id=${this.id}&signature=${this.signature}`,
                    {
                        id: this.id
                    });

            this.$router.push({name: 'articleList'});
        } catch (err) {
            this.isError = true;
        }

        this.isLoading = false;
    },
}
</script>

<style scoped>

</style>
