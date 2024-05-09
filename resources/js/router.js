import { createRouter, createWebHistory } from 'vue-router'
import Comment from './components/Comment.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', name: 'Comment', component: Comment },
  ],
});

export default router;