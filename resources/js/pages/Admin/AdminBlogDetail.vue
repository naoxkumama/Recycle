<template>
    <div class="common">
    <AdminHeader />
        <main v-if="post">
            <h1>{{ post.title }}</h1>
            <p>{{ post.content }}</p>

            <div class="button-group">
                <button @click="editPost(index)" class="edit-btn">編集 ✏️</button>
                <button @click="deletePost(index)" class="delete-btn">削除 ✖</button>
                <button @click="goBack">一覧に戻る</button>
            </div>
        </main>
        <p v-else>記事が存在しません</p>
    <AdminFooter />
    <CommonFooter />
    </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import AdminHeader from '../../components/AdminHeader.vue'
import AdminFooter from'../../components/AdminFooter.vue'
import CommonFooter from'../../components/CommonFooter.vue'

// 👇 Laravel から props を受け取る
const props = defineProps<{
    blog: { id: number; title: string; content: string }
}>()
const post = props.blog

const editPost = (id: number) => {
    router.visit(`/Admin/AdminBlogEdit/${id}/edit`)
}

const deletePost = (id: number) => {
    if (!confirm('本当に削除しますか？')) return

    router.delete(`/Admin/AdminBlogList/${id}`, {
    onSuccess: () => {
        alert('削除しました。')
        router.visit('/Admin/AdminBlogList')
    }
    })
}

const goBack = () => router.visit('/admin/AdminBlogList')
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

.edit-btn {
    background: #f0ad4e;
    color: white;
}

.edit-btn:hover {
    background: #ec971f
}

.delete-btn {
    background: #e74c3c;
    color: white;
}

.delete-btn:hover {
    background: #c0392b;
}
</style>