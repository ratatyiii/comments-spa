<template>
    <div v-for="comment in comments" :key="comment.id">
        <div class="card mb-2">
            <h5 class="card-header">
          <span class="card-header-left">
            <img src="https://i.pinimg.com/originals/08/d8/85/08d8857ea87db72970c6957879cf8062.png" alt="Avatar">
            <span class="username">{{ comment.username }}</span>
            <span class="date">{{ comment.created_at }}</span>
          </span>
                <span class="card-header-right"></span>
            </h5>
            <div class="card-body">
                <p class="card-text" v-html="comment.text"></p>
                <div class="row">
                    <div class="col align-self-start">
                        <fancybox-wrapper v-if="comment.image" :options="fancyBoxOptions">
                            <a data-fancybox="gallery" :href="comment.image">
                                <img :src="comment.image" height="50" alt="Image">
                            </a>
                        </fancybox-wrapper>
                    </div>
                    <div class="col align-self-end">
                        <button v-if="!replyVisible[comment.id]" @click="toggleReply(comment)"
                                class="btn btn-primary float-end">
                            Ответить
                        </button>
                    </div>
                </div>

                <comment-form
                    v-if="replyVisible[comment.id]"
                    :comment="comment"
                    @form-submitted="toggleReply(comment)"
                    class="mt-4">
                </comment-form>
            </div>
        </div>

        <div class="ml-4">
            <comment-list v-if="comment.replies.length > 0" :comments="comment.replies"></comment-list>
        </div>
    </div>
</template>

<script>
import CommentForm from './CommentForm.vue'
import FancyboxWrapper from './FancyboxWrapper.vue'

export default {
    name: 'CommentList',
    components: {CommentForm, FancyboxWrapper},
    props: {
        comments: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            replyVisible: [],
            fancyBoxOptions: {
                Carousel: {
                    infinite: false,
                },
            }
        }
    },
    methods: {
        toggleReply(comment) {
            this.replyVisible[comment.id] = !this.replyVisible[comment.id]
        }
    },
}
</script>

<style scoped lang="less">
.card-header {
    &-left {
        display: flex;
        align-items: center;

        gap: 15px;

        img {
            width: 40px;
            height: 40px;

            border: 5px solid white;
            border-radius: 50%;
        }

        .username {
            font-weight: bolder;
        }

        .date {
            font-size: 14px;
        }
    }

}

.card-text {
    margin-bottom: 10px;
}

.ml-4 {
    margin-left: 20px;
}
</style>
