<template>
  <div class="pagination">
    <button @click="handlePreviousPage" :disabled="currentPage === 1">Previous</button>
    <span v-for="page in pageNumbers" :key="page" @click="handlePageChange(page)" :class="{ active: currentPage === page }">{{ page }}</span>
    <button @click="handleNextPage" :disabled="currentPage === totalPages">Next</button>
  </div>
</template>

<script>
export default {
  props: {
    totalComments: {
      type: Number,
      required: true,
    },
    currentPage: {
      type: Number,
      required: true,
    },
    perPage: {
      type: Number,
      required: true,
    },
  },
  computed: {
    totalPages() {
      return Math.ceil(this.totalComments / this.perPage);
    },
    pageNumbers() {
      const startPage = Math.max(1, this.currentPage - 2);
      const endPage = Math.min(this.totalPages, this.currentPage + 2);
      return Array.from({ length: endPage - startPage + 1 }, (_, i) => startPage + i);
    },
  },
  methods: {
    handlePreviousPage() {
      if (this.currentPage > 1) {
        this.$emit('update-page', this.currentPage - 1);
      }
    },
    handlePageChange(page) {
      this.$emit('update-page', page);
    },
    handleNextPage() {
      if (this.currentPage < this.totalPages) {
        this.$emit('update-page', this.currentPage + 1);
      }
    },
  },
};
</script>

<style scoped>
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}

.pagination button {
  margin: 0 5px;
  padding: 5px 10px;
  border: 1px solid #ccc;
  cursor: pointer;
}

.pagination button:disabled {
  opacity: 0.5;
  cursor: default;
}

.pagination .active {
  background-color: #eee;
}
</style>