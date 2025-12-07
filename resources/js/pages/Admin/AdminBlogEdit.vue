<template>
    <div class="common">
        <AdminHeader />
        <main>
            <h1>{{ isEdit ? 'ブログ編集 ✏️' : '新規ブログ作成 🆕' }}</h1>

            <form @submit.prevent="savePost">
                <div class="form-group">
                    <label>タイトル</label>
                    <input v-model="form.title" type="text" required placeholder="タイトルを入力"/>
                </div>

                <div class="form-group">
                    <label>内容</label>
                    <textarea v-model="form.content" rows="8" required placeholder="ブログ本文を入力"></textarea>
                </div>

                <button type="submit" class="save-btn">
                    {{  isEdit ? '更新する' : '保存する' }}
                </button>
            </form>
        </main>

        <ButtonColors :buttons="buttons" @navigate="goPage" />
        <AdminFooter />
        <CommonFooter />
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import ButtonColors from '../../components/buttonColors.vue'
import AdminHeader from '../../components/AdminHeader.vue'
import AdminFooter from'../../components/AdminFooter.vue'
import CommonFooter from'../../components/CommonFooter.vue'

type BlogForm = {
    id?: number
    title: string
    content: string
}

const form = ref<BlogForm>({
    id: undefined,
    title: '',
    content: ''
})
const isEdit = ref(false)

// 初期処理
const props = defineProps<{ blog?: { id: number; title: string; content: string } }>()
if (props.blog) {
    form.value = { ...props.blog }
    isEdit.value = true
}

// 保存処理
const savePost = () => {
    if (isEdit.value && form.value.id) {
        router.put(`/admin/blog/${form.value.id}`, form.value, {
            onSuccess: () => {
                alert('ブログを更新しました！')
                router.visit('/admin/blog')
            }
        })
    } else {
        router.post('/admin/blog', form.value, {
            onSuccess: () => {
                alert('新規ブログを作成しました！')
                router.visit('/admin/blog')
            }
        })
    }
}


const buttons = [
    { label: "ブログ管理へ戻る", path: "/admin/AdminBlogList", class: "home-btn" },
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