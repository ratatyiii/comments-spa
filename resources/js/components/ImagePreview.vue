<template>
  <div class="image-preview">
    <img :src="imageUrl" alt="Image Preview">
  </div>
</template>

<script>
export default {
  props: {
    imageUrl: {
      type: String,
      required: true,
    },
  },
};
</script>

<style scoped>
.image-preview {
  /* Add your CSS styles for the image preview container */
}

.image-preview img {
  /* Add your CSS styles for the image itself */
  max-width: 100%;
  height: auto;
}
</style>