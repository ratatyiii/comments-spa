<template>
  <div class="row">
    <form @submit.prevent="handleSubmit">
      <div class="mb-3">
        <label for="username" class="form-label">User Name</label>
        <input v-model="username" id="username" type="text" required class="form-control"/>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input v-model="email" id="email" type="email" required class="form-control"/>
      </div>

      <div class="mb-3">
        <label for="home_page" class="form-label">Home page</label>
        <input v-model="home_page" id="home_page" type="url" class="form-control"/>
      </div>

      <div class="mb-3">
        <label for="text" class="form-label">Text</label>
        <Editor
            v-model="text"
            api-key="vqbom09n6rl0qj6uwhl8pb9vowy3encvfqj2i5xrzxpcug1n"
            :init="{
              plugins: 'link code wordcount'
            }"
        />
      </div>

<!--      <div class="mb-3">-->
<!--        <label for="captcha" class="form-label">Captcha</label>-->
<!--        <input v-model="captcha" id="captcha" type="text" class="form-control" placeholder="тут капча сделать"-->
<!--               disabled/>-->
<!--      </div>-->

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue'

export default {
  components: { Editor },
  props: {
    commentId: {
      type: Number,
      required: false
    }
  },
  data ()
  {
    return {
      username: '',
      email: '',
      home_page: '',
      captcha: '',
      text: '',
    }
  },
  methods: {
    handleSubmit ()
    {
      if (this.commentId !== undefined)
      {
        this.$emit('form-submitted', this.commentId)
      }
    },
  },
}
</script>

<style scoped>

</style>
