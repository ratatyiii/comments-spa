<template>
    <div class="container">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mt-2 mb-4 border-bottom">
                <router-link :to="{name: 'Index'}"
                             class="d-flex align-items-center link-body-emphasis text-decoration-none">
                    <span class="fs-4">Laravel (SPA-app)</span>
                </router-link>

                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <router-link :to="{name: 'Index'}" class="me-3 py-2 link-body-emphasis text-decoration-none">
                        Главная
                    </router-link>
                    <router-link :to="{name: 'CommentAdd'}" class="me-3 py-2 link-body-emphasis text-decoration-none">
                        Добавление
                    </router-link>
                </nav>
            </div>
        </header>

        <router-view/>
    </div>
</template>

<script>

export default {
    name: 'App',
}
</script>

<style scoped>

</style>
