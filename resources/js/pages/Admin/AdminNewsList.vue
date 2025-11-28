<template>
    <div class="common">
    <AdminHeader />
    <CommonLayout
        leftImage="/images/bear.jpg"
        rightImage="/images/truck.jpg"
    >

        <main>
            <h1>お知らせ管理 📺</h1>
            <a href="https://yahoo.co.jp" target="_blank">新着お知らせ➂</a>
            <p></p>
            <a href="https://google.co.jp" target="_blank">新着お知らせ➁</a>
            <p></p>
            <a href="https://youtube.co.jp" target="_blank">新着お知らせ➀</a>
        </main>
        <ButtonColors :buttons="buttons" @navigate="goPage" />
        </CommonLayout>
    </div>
</template>

<script setup lang="ts">

import { router } from '@inertiajs/vue3'
import ButtonColors from '../../components/buttonColors.vue'
import AdminHeader from '../../components/AdminHeader.vue'
import CommonLayout from'../../components/CommonLayout.vue'

const buttons = [
    { label: "管理画面TOPへ戻る", path: "/admin/AdminHome", class: "home-btn" },
]

const goPage = (path: string) => {
    router.visit(path)
}
</script>

<style scoped>
.common {
    text-align: center;
    margin-top: 10px;
}

button {
    padding: 0.6rem 1.2rem;
    border: none;
    border-radius: 6px;
    background: #3498db;
    color: white;
    font-size: 1rem;
    cursor: pointer;
}
</style>