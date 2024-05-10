<template>
    <comment-list :comments="paginatedComments"></comment-list>
    <comment-pagination
        :total-pages="totalPages"
        :current-page="currentPage"
        @change-page="changePage"
        @select-page="selectPage">
    </comment-pagination>
</template>

<script>
import CommentList from './CommentList.vue'
import CommentPagination from './CommentPagination.vue'

export default {
    name: 'Comment',
    components: {CommentList, CommentPagination},
    data() {
        return {
            perPage: 25,
            currentPage: 1,
        }
    },
    mounted() {
        this.$store.dispatch('fetchComments')
    },
    methods: {
        selectPage(page) {
            this.currentPage = page
        },
        changePage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.currentPage = page
            }
        }
    },
    computed: {
        comments() {
            return this.$store.getters.getComments
        },
        paginatedComments() {
            const startIndex = (this.currentPage - 1) * this.perPage
            const endIndex = startIndex + this.perPage

            return this.comments.slice(startIndex, endIndex)
        },
        totalPages() {
            return Math.ceil(this.comments.length / this.perPage)
        }
    },
}
</script>

<style scoped>

</style>
