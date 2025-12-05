<template>
  <div class="common">
    <AdminHeader />
      <main>
        <div class="header-row">
          <h1>お知らせ管理📚</h1>
          <button class="write-btn" @click="goWritePage">新規作成 ✏️</button>
        </div>
          <div v-if="posts.length" class="news-list">
            <div v-for="post in posts" :key="post.id" class="news-item">
              <div class="news-header">
                <h2 @click="viewPost(post.id)" class="clickable">{{ post.title }}</h2>
                <div class="action-buttons">
                  <button class="edit-btn" @click="editPost(post.id)">編集 ✏️</button>
                  <button class="delete-btn" @click="deletePost(post.id)">削除 ✖</button>
                </div>
              </div>
              <p class="preview-text">{{ getPreview(post.content) }}</p>
            </div>
          </div>
          <p v-else>まだお知らせがありません。</p>
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

const props = defineProps<{ news?: { id: number; title: string; content: string }[] }>()
const posts = ref<{ id: number; title: string; content: string }[]>(props.news || [])

const getPreview = (text: string) => {
  if(!text) return ''
  return text.length > 120 ? text.slice(0, 120) + '...' :text
}

const goWritePage = () => {
  router.visit("/admin/AdminNewsEdit")
}

const editPost = (id: number) => router.visit(`/admin/AdminNewsEdit/${id}/edit`);
const viewPost = (id: number) => router.visit(`/admin/AdminNewsList/${id}`);

const deletePost = (id: number) => {
    if (!confirm('本当に削除しますか？')) return;

    router.delete(`/admin/AdminNewsList/${id}`, {
        onSuccess: () => {
            alert('削除しました');
            // ページリロードまたは posts を更新
            posts.value = posts.value.filter(p => p.id !== id);
        }
    });
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

/* --- お知らせ一覧 --- */
.news-list {
  display: flex;
  flex-direction: column;
  gap :1rem;
  max-width: 900px;
  margin: 0 auto;
}

.news-item {
  background: #f9f9f9;
  border-radius: 10px;
  padding: 1rem 1.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1)
}

.news-header {
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