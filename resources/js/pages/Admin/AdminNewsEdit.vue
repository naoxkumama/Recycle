<template>
    <div class="common">
        <AdminHeader />
        <main>
            <h1>{{ isEdit ? 'お知らせ編集 ✏️' : '新規お知らせ作成 🆕' }}</h1>

            <form @submit.prevent="savePost">
                <div class="form-group">
                    <label>タイトル</label>
                    <input v-model="form.title" type="text" required placeholder="タイトルを入力"/>
                </div>

                <div class="form-group">
                    <label>内容</label>
                    <textarea v-model="form.content" rows="8" required placeholder="お知らせ本文を入力"></textarea>
                </div>

                <button type="submit" class="save-btn">
                    {{  isEdit ? '更新する' : '保存する' }}
                </button>
            </form>
        </main>

        <ButtonColors :buttons="buttons" @navigate="goPage" />
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import ButtonColors from '../../components/buttonColors.vue'
import AdminHeader from '../../components/AdminHeader.vue'

const params = new URLSearchParams(window.location.search)
const indexParam = params.get('index')

const posts = ref<{ title: string; content: string }[]>([])
const form = ref({ title: '', content: ''})
const isEdit = ref(false)

// 初期処理
onMounted(() => {
    const saved = localStorage.getItem('newsPosts')
    posts.value = saved ? JSON.parse(saved) : []

    // 編集モードの場合
    if (indexParam !== null) {
        const index = parseInt(indexParam)
        const post = posts.value[index]
        if (post) {
            form.value.title = post.title
            form.value.content = post.content
            isEdit.value = true
        }
    }
})

// 保存処理
const savePost = () => {
    if (isEdit.value && indexParam !== null) {
        // 上書き保存
        const index = parseInt(indexParam)
        posts.value[index] = { ...form.value }
    } else {
        // 新規追加
        posts.value.push({ ...form.value})
    }

    localStorage.setItem('newsPosts', JSON.stringify(posts.value))
    alert(isEdit.value ? 'お知らせを更新しました！' : '新規お知らせを追加しました！')
    router.visit('/admin/AdminNewsList')
}

const buttons = [
    { label: "お知らせ管理へ戻る", path: "/admin/AdminNewsList", class: "home-btn" },
    { label: "管理画面TOPへ戻る", path: "/admin/AdminHome", class: "home-btn" },
]

const goPage = (path: string) => {
    router.visit(path)
}
</script>

<style scoped>
.common {
    text-align: center;
    max-width: 900px;
    margin: 10px auto;
    padding: 2rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    text-align: left;
}

label {
    font-weight: bold;
    margin-bottom: 0.5rem;
}

input {
    width: 100%;
    max-width: 900px;
    padding: 0.8rem;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1.1rem;
    box-sizing: border-box;
}

textarea {
    width: 100%;
    max-width: 900px;
    min-height: 250px;
    padding: 0.8rem;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1rem;
    line-height: 1.6;
    resize: vertical;
    box-sizing: border-box;
}

.save-btn {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 0.6rem 1.2rem;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}

.save-btn:hover {
    background-color: #43a047;
}
</style>