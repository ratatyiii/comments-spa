import {createStore} from 'vuex'

const store = createStore({
    state() {
        return {
            comments: {},
        }
    },
    mutations: {
        setComments(state, comments) {
            state.comments = comments
        },
        addComment(state, comments) {
            state.comments.push(comments)
        },
        addReply(state, newComment) {
            function findCommentById(comments, id) {
                for (let comment of comments) {
                    if (comment.id === id) {
                        return comment;
                    }

                    if (comment.replies && comment.replies.length > 0) {
                        const foundComment = findCommentById(comment.replies, id);
                        if (foundComment) {
                            return foundComment;
                        }
                    }
                }

                return null;
            }

            const parentComment = findCommentById(state.comments, newComment.parent_id);

            if (parentComment) {
                parentComment.replies.push(newComment);
            }
        }
    },
    actions: {
        fetchComments({commit}) {

            axios.get('/api/comments').then(response => {
                const comments = response.data;

                commit('setComments', comments)
            }).catch(reason => {
                console.log(reason)
            })
        }
    },
    getters: {
        getComments(state) {
            return state.comments
        }
    }
})

export default store
