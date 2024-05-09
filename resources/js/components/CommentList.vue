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
                <button v-if="!replyVisible[comment.id]" class="btn btn-primary" @click="toggleReply(comment)">
                    Ответить
                </button>

                <div class="card" v-if="replyVisible[comment.id]">
                    <div class="card-header">
                        <span>Добавление комментария</span>
                    </div>
                    <div class="card-body">
                        <comment-form :comment="comment" @form-submitted="toggleReply(comment)"></comment-form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nested Comments (Replies) -->
        <div class="ml-4">
            <comment-list v-if="comment.replies.length > 0" :replies="comment.replies"></comment-list>
        </div>
    </div>

    <!--    <div class="pagination">-->
    <!--      <button @click="handlePreviousPage" :disabled="currentPage === 1">Previous</button>-->
    <!--      <span v-for="page in pageNumbers" :key="page" @click="handlePageChange(page)" :class="{ active: currentPage === page }">{{ page }}</span>-->
    <!--      <button @click="handleNextPage" :disabled="currentPage === totalPages">Next</button>-->
    <!--    </div>-->
</template>

<script>
import CommentForm from './CommentForm.vue'

export default {
    name: 'CommentList',
    components: {CommentForm},
    props: {
        replies: {
            type: Object,
            required: false
        }
    },
    data() {
        return {
            replyVisible: {}
        }
    },
    methods: {
        toggleReply(comment) {
            this.replyVisible[comment.id] = !this.replyVisible[comment.id]

            if (this.replyVisible[comment.id]) {

            }
        }
    },
    computed: {
        comments() {
            return this.replies ? this.replies : this.$store.getters.getComments
        }
    },
    mounted() {
        if (!this.replies) {
            this.$store.dispatch('fetchComments')
        }
    }
}
</script>

<style scoped lang="less">
.card {
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
}

.card-body {
    padding: 10px;
}

.card-title {
    font-weight: bold;
}

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
