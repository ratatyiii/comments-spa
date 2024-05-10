import {createStore} from 'vuex'

const store = createStore({
    state() {
        return {
            comments: [],
        }
    },
    mutations: {
        setComments(state, comments) {
            state.comments = comments
        },
        addComment(state, newComment) {
            if (!newComment.replies) {
                newComment.replies = []
            }

            const addCommentRecursively = (comments, newComment) => {
                for (let comment of comments) {
                    if (comment.id === newComment.parent_id) {
                        comment.replies.push(newComment)
                        return
                    }

                    if (comment.replies && comment.replies.length > 0) {
                        addCommentRecursively(comment.replies, newComment)
                    }
                }
            }

            if (newComment.parent_id) {
                addCommentRecursively(state.comments, newComment)
            } else {
                state.comments.push(newComment)
            }
        }
    },
    actions: {
        fetchComments({commit}) {
            axios.get('/api/comments').then(response => {
                const comments = response.data

                commit('setComments', comments)
            }).catch(reason => {
                console.log(reason)
            })
        }
    },
    getters: {
        getComments(state) {
            return state.comments
        },
    }
})

export default store
