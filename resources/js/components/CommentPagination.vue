<template>
    <nav aria-label="Page navigation">
        <ul class="pagination mt-4" style="display: flex; align-items: center;justify-content: center">
            <li :class="{'page-item' : true, 'disabled': currentPage === 1}">
                <a @click="previousPage" class="page-link">Назад</a>
            </li>

            <li v-for="page in pageNumbers" :class="{'page-item' : true, 'active' : currentPage === page}"
                aria-current="page">
                <a @click="selectPage(page)" class="page-link" href="#">{{ page }}</a>
            </li>

            <li :class="{'page-item' : true, 'disabled': currentPage === totalPages}">
                <a @click="nextPage" class="page-link" href="#">Вперед</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: 'CommentPagination',
    props: {
        totalPages: {
            type: Number,
            required: true,
        },
        currentPage: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {}
    },
    computed: {
        pageNumbers() {
            const startPage = Math.max(1, this.currentPage - 2)
            const endPage = Math.min(this.totalPages, this.currentPage + 2)

            return Array.from({length: endPage - startPage + 1}, (_, i) => startPage + i)
        },
    },
    methods: {
        previousPage() {
            this.$emit('change-page', this.currentPage - 1)
        },
        selectPage(page) {
            this.$emit('select-page', page)
        },
        nextPage() {
            this.$emit('change-page', this.currentPage + 1)
        },
    },
}
</script>

<style scoped>

</style>
