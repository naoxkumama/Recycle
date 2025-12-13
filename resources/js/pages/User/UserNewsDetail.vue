<template>
    <div class="common">
    <UserHeader />
        <main v-if="post">
            <h1>{{ post.title }}</h1>
            <p>{{ post.content }}</p>

            <div class="button-group">
                <button @click="goBack">一覧に戻る</button>
            </div>
        </main>
        <p v-else>記事が存在しません</p>
    <UserFooter />
    </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import UserHeader from '../../components/UserHeader.vue'
import UserFooter from'../../components/UserFooter.vue'

const props = defineProps<{
    posts: { id: number; title: string; content: string }
}>()

const post = props.posts

const goBack = () => router.visit('/user/UserNewsList')

const buttons = [
  { label: "ホームへ戻る", path: "/user/home", class: "home-btn" },
]

const goPage = (path: string) => {
  router.visit(path)
}
</script>

<style scoped>
.common {
    text-align: center;
    margin-top: 10px;
    color:#333;
    font-family: "Hiragino Sans", "Noto Sans JP", "Noto Serif JP", serif;
    line-height: 1.8;
    background-color: #f9fafb;
    min-height: 100vh;
}

/* 記事全体のカード */
main {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    padding: 3rem 2.5rem;
    width: 90%;
    max-width: 900px;
    margin: 3rem auto;
    text-align: left;
    transition: box-shadow 0.3s ease;
}

main:hover {
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1)
}

/* タイトル */
h1 {
    font-size: 1.05rem;
    white-space: pre-line;
    color: #444;
    margin-bottom: 2rem;
    line-height: 1.9;
}

/* 本文 */
p {
    font-size: 1.1rem;
    white-space: pre-line;
    color: #444;
    margin-bottom: 2rem;
    line-height: 1.9;
}

/* ボタン */
.button-group {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}


button {
    display: inline-block;
    background: linear-gradient(135deg, #4fa3ff, #007bff);
    color: white;
    border: none;
    padding: 0.7rem 1.6rem;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: background 0.3s, transform 0.2s;
}

button:hover {
    background: linear-gradient(135deg, #66b3ff, #3399ff);
    transform: translateY(-2px);
}

button:active {
    transform: translateY(0);
}
</style>
