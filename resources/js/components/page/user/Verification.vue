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
            <p>再度メールの送信をお試し頂けますでしょうか。</p>

            <div class="btn-container">
                <button
                    @click="onClickSendEmailButton()"
                    class="btn btn-primary"
                >
                    メールを再送信する
                </button>
            </div>
        </div>
    </div>
</template>

<script>

import axios from "axios";

export default {
    name: "Verification",
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
                .post(`/api/users/verifications?expires=${this.expires}&id=${this.id}&signature=${this.signature}`,
                    {
                        id: this.id
                    });

            this.$router.push({name: 'articleList'});
        } catch (err) {
            this.isError = true;
        }

        this.isLoading = false;
    },
    methods: {
        async onClickSendEmailButton() {
            await axios.post(`/api/users/${this.id}/emails/verifications`);
        },
    },
}
</script>

<style scoped>

</style>
