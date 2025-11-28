<template>
  <div class="common">
    <UserHeader />
    <CommonLayout
      leftImage="/images/bear.jpg"
      rightImage="/images/truck.jpg"
    >

      <main>
          <h1>スタッフブログ 📚</h1>

          <!-- ブログがある場合 -->
          <div v-if="posts.length">
              <div v-for="(post, index) in reversedPosts" :key="index" class="blog-item">
                <h2 @click="goPost(index)" class="clickable">{{ post.title }}</h2>
                <p class="content">{{ getPreview(post.content) }}</p>
                <hr />
              </div>
          </div>

          <!-- ブログがまだない場合 -->
          <p v-else>まだブログがありません。</p>
      </main>
      <ButtonColors :buttons="buttons" @navigate="goPage" />
    </CommonLayout>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import ButtonColors from '../../components/buttonColors.vue'
import UserHeader from '../../components/UserHeader.vue'
import CommonLayout from'../../components/CommonLayout.vue'

const posts = ref<{ title: string; content: string }[]>([])

// ✅ ページ読み込み時に localStorage から読み込み
onMounted(() => {
  const saved = localStorage.getItem('blogPosts')
  posts.value = saved ? JSON.parse(saved) : []
})

// 新しい順で表示
const reversedPosts = computed(() => [...posts.value].reverse())

const getPreview = (text: string) => {
  if (!text) return ''
  return text.length > 20 ? text.slice(0, 20) + '...' : text
}

const goPost = (index: number) => {
  router.visit(`/user/UserBlogDetail/${index}`)
}

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
}

main {
  max-width: 900px;
  margin: 0 auto;
  text-align: left;
}

.blog-item {
  background: #fff;
  padding: 1rem;
  margin-bottom: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.blog-item h2 {
  font-size: 1.3rem;
  margin-bottom: 0.5rem;
  color: #333;
}

.blog-item .content {
  font-size: 1rem;
  line-height: 1.6;
  color: #444;
  white-space: pre-wrap; /* 改行を反映 */
}

hr {
  border: none;
  border-bottom: 1px solid #ddd;
  margin-top: 1rem;
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
