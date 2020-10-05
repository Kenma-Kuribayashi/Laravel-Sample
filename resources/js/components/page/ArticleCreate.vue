<template>
    <div>

        <h1>記事の新規投稿</h1>

        <div v-show="hasMessage">
            <div class="alert alert-primary">{{ message }}</div>
        </div>

        <p>タイトル:</p>
        <input class="form-control" name="title" v-model="title"/>

        <p>本文:</p>
        <textarea class="form-control" name="body" v-model="body"></textarea>

        <p>記事の公開日:</p>
        <input class="form-control" type="date" name="published_at" v-model="publishedAt">

        <p>タグ:</p>
        <select class="form-control">
            <option disabled value="">1つ選択してください</option>
            <option v-for="tag in tags" name="" v-bind:value="tags">{{ tag }}</option>
        </select>

        <div class="form_parts">
            <input type="file" ref="file" @change="setImage"/>
        </div>

        <div class="btn-container">
            <button @click="onClickSubmitButton()" class="btn btn-primary">新規投稿</button>
        </div>

    </div>
</template>

<script>
import dayjs from "dayjs";
import "dayjs/locale/ja";

dayjs.locale("ja");

export default {
    components: {},
    props: {
        auth: {
            type: Object | Array,
        },
        errors: {
            type: Object | Array,
        },
    },
    data() {
        return {
            // errors: [],
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
        };
    },
    mounted() {
        this.publishedAt = dayjs().format('YYYY-MM-DD');

        this.$http.get("/api/tags").then((response) => {
            response.data.data.forEach((tag) => {
                this.tags.push(tag.name);
            });
        });
    },
    methods: {
        onClickSubmitButton() {
            console.log(this.image_data);

            //const FormData = require('form-data');
            const form = new FormData();
            form.append('title', this.title);
            form.append('body', this.body);
            form.append('published_at', this.publishedAt);
            form.append('tags', this.tag);
            form.append('image', this.image_data);

            axios.post("/api/articles/",
                form,
                { headers:  {'content-type': 'multipart/form-data;'}}
            )
                .then(() => {
                    this.isModal = true;
                }).catch(err => {
                this.message = "記事の新規作成に失敗しました。"
            }).finally(() => this.isSending = false);
        },
        setImage(e) {
            const files = this.$refs.file;
            this.image_data = files.files[0];
            //const fileImg = files.files[0];
            //console.log(fileImg);
            // if (fileImg.type.startsWith("image/")) {
            //     this.image_data.image = window.URL.createObjectURL(fileImg);
            //     this.image_data.name = fileImg.name;
            //     this.image_data.type = fileImg.type;
            // }
        }
    },
    computed: {
        hasMessage() {
            if (this.message !== "") {
                return true;
            }
            return false;
        }
        ,
    }
    ,
    watch: {}
    ,
}
;
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
