<template>
    <div class="row">
        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="username" class="form-label">Имя пользователя <span>*</span></label>
                <input
                    id="username"
                    v-model="form.username"
                    @change="form.validate('username')"
                    type="text"
                    required
                    :class="{'form-control' : true, 'is-invalid': form.invalid('username')}"
                    placeholder="Введите имя пользователя"/>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-Mail <span>*</span></label>
                <input
                    id="email"
                    v-model="form.email"
                    @change="form.validate('email')"
                    type="email"
                    required
                    :class="{'form-control' : true, 'is-invalid': form.invalid('email')}"
                    placeholder="Введите свою почту"/>
            </div>

            <div class="mb-3">
                <label for="home_page" class="form-label">Ссылка</label>
                <input
                    id="home_page"
                    v-model="form.home_page"
                    @change="form.validate('home_page')"
                    type="url"
                    :class="{'form-control' : true, 'is-invalid': form.invalid('home_page')}"
                    placeholder="Ссылка"/>
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">Текст <span>*</span></label>
                <Editor
                    v-model="form.text"
                    @change="form.validate('text')"
                    api-key="vqbom09n6rl0qj6uwhl8pb9vowy3encvfqj2i5xrzxpcug1n"
                    :init="editConfig"
                    :class="{'form-control' : true, 'is-invalid': form.invalid('home_page')}"
                />
            </div>

            <button type="submit" class="btn btn-primary" :disabled="form.processing">
                Submit
            </button>
        </form>
    </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue'

import {useForm} from 'laravel-precognition-vue'

export default {
    name: 'CommentForm',
    components: {Editor},
    props: {
        comment: {
            type: Object,
            required: false
        },
    },
    data() {
        return {
            form: useForm('post', '/api/comments', {
                parent_id: this.comment ? this.comment.id : null,
                username: null,
                email: null,
                home_page: null,
                // text: this.comment ? `<strong>${this.comment.username}</strong>,` : null,
                text: null,
                recaptcha: null
            }),
        }
    },
    methods: {
        submit() {
            this.form.submit().then((response) => {
                const data = response.data

                if (this.comment === undefined) {
                    this.$store.commit('addComment', data)

                    this.$router.push({name: 'Index'})
                } else {
                    this.$store.commit('addReply', data);
                    this.$emit('form-submitted')
                }
            }).catch((error) => {
                console.log(error)
            });
        },
    },
    computed: {
        editConfig() {
            return {
                valid_elements: 'a[href|target|title|rel],code,i,strong',
                inline_boundaries_selector: 'a[href],a[target],code,i,strong',
                forced_root_block: 'invalid',
                toolbar: 'undo redo | bold | code | link',
                menubar: false,
                plugins: 'link code wordcount',
                placeholder: 'Введите текст',

            }
        }
    },
}
</script>

<style scoped>
form {
    label {
        span {
            color: red;
        }
    }
}
</style>
