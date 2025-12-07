<template>
  <div class="common">
    <UserHeader />
    <CommonLayout
      leftImage="/images/bear.jpg"
      rightImage="/images/truck.jpg"
    >

      <main>
        <h1>お知らせ 📺</h1>

        <!-- お知らせがある場合 -->
          <div v-if="posts?.length">
              <div v-for="post in posts" :key="post.id" class="blog-item">
                <h2 @click="goPost(post.id)" class="clickable">{{ post.title }}</h2>
                <p class="content">{{ getPreview(post.content) }}</p>
                <hr />
              </div>
          </div>

          <!-- お知らせがまだない場合 -->
          <p v-else>まだお知らせがありません。</p>
      </main>
      <ButtonColors :buttons="buttons" @navigate="goPage" />
    </CommonLayout>
    <UserFooter />
    <CommonFooter />
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import ButtonColors from '../../components/buttonColors.vue'
import UserHeader from '../../components/UserHeader.vue'
import UserFooter from '../../components/UserFooter.vue'
import CommonFooter from'../../components/CommonFooter.vue'
import CommonLayout from'../../components/CommonLayout.vue'

const props = defineProps<{ posts: { id: number; title: string; content: string }[] }>()
const posts = ref(props.posts || [])

const getPreview = (text: string) => {
  if (!text) return ''
  return text.length > 20 ? text.slice(0, 20) + '...' : text
}

const goPost = (id: number) => {
  router.visit(`/user/UserBlogDetail/${id}`)
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