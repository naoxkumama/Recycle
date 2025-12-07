<template>
  <div class="common">
    <AdminHeader />
      <main>
        <div class="header-row">
          <h1>ブログ管理📚</h1>
          <button class="write-btn" @click="goWritePage">新規作成 ✏️</button>
        </div>
          <div v-if="blogs.length" class="blog-list">
            <div v-for="post in blogs" :key="post.id">
              <h2>{{ post.title }}</h2>
              <button @click="editPost(post.id)">編集</button>
              <button @click="deletePost(post.id)">削除</button>
            </div>
          </div>

          <p v-else>まだブログがありません。</p>
      </main>

      <ButtonColors :buttons="buttons" @navigate="goPage" />
      <AdminFooter />
      <CommonFooter />
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'
import ButtonColors from '../../components/buttonColors.vue'
import AdminHeader from '../../components/AdminHeader.vue'
import AdminFooter from'../../components/AdminFooter.vue'
import CommonFooter from'../../components/CommonFooter.vue'


const props = defineProps<{ blogs: Blog[] }>()
const blogs = computed(() => props.blogs)

const getPreview = (content: string) => {
  if (!content) return ''
  return content.length > 120 ? content.substring(0, 120) + '...' : content
}

const editPost = (id: number) => {
  router.visit('admin.blog.edit', { id })
}

const deletePost = (id: number) => {
  if (!confirm('削除しますか？')) return

  router.delete('admin.blog.destroy', { id })
}

const goWritePage = () => {
  router.visit('/admin/blog/create')
}

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
  margin-top: 0px;
}

/* --- 新規作成ボタン配置 --- */
.header-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  width: 900px;
  margin-inline: auto;
}

h1 {
  flex: 1;
  text-align: center;
  margin-top: 1rem;
}

.write-btn {
  background: linear-gradient(135deg, #4CAF50, #45A049);
  color: white;
  border: none;
  border-radius: 8px;
  padding: 0.6rem 1.2rem;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.2s;
}

.write-btn:hover {
  transform: translateY(-4px);
  box-shadow: 0.4px 8px rgba(76, 175, 80, 0.3);
}

/* --- ブログ一覧 --- */
.blog-list {
  display: flex;
  flex-direction: column;
  gap :1rem;
  max-width: 900px;
  margin: 0 auto;
}

.blog-item {
  background: #f9f9f9;
  border-radius: 10px;
  padding: 1rem 1.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1)
}

.blog-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.clickable {
  cursor: pointer;
  color: #007bff;
  font-weight: bold;
  font-size: 1rem;
  margin: 0;
  transition: color 0.2s;
}

.clickable:hover {
    color: #0056b3;
}

.preview-text {
  display: -webkit-box;
  -webkit-line-clamp: 4;
  -webkit-box-orient: vertical;
  overflow: hidden; 
  text-align: left;
  color: #555;
  font-size: 0.9rem;
  margin: 0.5rem 0 0 0;
  line-height: 1.4;
  white-space: pre-line;
}

/* --- 編集・削除ボタン --- */
.action-buttons {
  display: flex;
  gap:0.4rem;
}

.edit-btn,
.delete-btn {
  border: none;
  border-radius: 5px;
  padding: 0.25rem 0.6rem;
  font-size: 0.8rem;
  cursor: pointer;
  transition: background 0.2s;
}

.edit-btn {
  background: #688fb6;
  color: white;
}

.edit-btn:hover {
  background: #4e6781;
}

.delete-btn {
  background: #e74c3c;
  color: white;
}

.delete-btn:hover {
  background: #c0392b;
}
</style>