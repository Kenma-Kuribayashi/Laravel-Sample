<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ログイン</div>

                <div v-show="message !== ''">
                    <div class="alert alert-primary">{{ message }}</div>
                </div>

                <validation-observer ref="obs" v-slot="{ invalid }">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Eメール</label>
                            <div class="col-md-6">
                                <ValidationProvider rules="required|email" v-slot="{ errors }">
                                    <input id="email" class="form-control" name="email" type="email" v-model="email"
                                           autofocus/>
                                    <div class="text-danger" v-show="errors[0]">{{ errors[0] }}</div>
                                </ValidationProvider>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>
                            <div class="col-md-6">
                                <ValidationProvider rules="required|min:8" v-slot="{ errors }">
                                    <input id="password" type="password"
                                           class="form-control" name="password" v-model="password">
                                    <div class="text-danger" v-show="errors[0]">{{ errors[0] }}</div>
                                </ValidationProvider>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           name="remember" id="autoLogin" v-model="isAutoLogin">
                                    <label class="form-check-label" for="autoLogin">
                                        自動ログイン
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary"
                                        @click="onClickSubmitButton()" :disabled="invalid">
                                    ログインする
                                </button>
                                <!--                                todo:API作成次第-->
                                <!--                                <a class="btn btn-link" href="{{ route('password.request') }}">-->
                                <!--                                    パスワードを忘れてしまった方はこちら-->
                                <!--                                </a>-->
                            </div>
                        </div>
                    </div>
                </validation-observer>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Login",
    props: {
        auth: {
            type: Object,
            required: false,
        },
    },
    data() {
        return {
            message: "",
            email: "",
            password: "",
            isAutoLogin: false,
        };
    },
    mounted() {
        if (Object.keys(this.auth).length) {
            this.$router.push({ name: 'articleList' });
        }
    },
    methods: {
        async onClickSubmitButton() {
            try {
                await axios.post("/api/auth/login", {
                    email: this.email,
                    password: this.password,
                    remember: this.isAutoLogin
                });

                this.$router.go({ name: 'login' });
            } catch (err) {
                this.message = err.response.data.message;
            }
        },
    },
}
</script>

<style scoped>

</style>
