import {createRouter, createWebHistory} from 'vue-router'
import Comment from './components/Comment.vue'
import CommentAdd from './components/CommentAdd.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/', name: 'Index', component: Comment},
        {path: '/comment/add', name: 'CommentAdd', component: CommentAdd},
    ],
});

export default router;
