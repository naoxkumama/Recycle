<template>
  <div class="common">
    <UserHeader />
    <CommonLayout
      leftImage="/images/bear.jpg"
      rightImage="/images/truck.jpg"
    >
      <main v-if="post">
        <h1>{{ news.title }}</h1>
        <p>{{ news.content }}</p>

        <button class="back-btn" @click="goBack">
          一覧に戻る
        </button>
      </main>
      <p v-else>記事が存在しません</p>
    </CommonLayout>
    <UserFooter />
    <CommonFooter />
  </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import UserHeader from '../../components/UserHeader.vue'
import UserFooter from '../../components/UserFooter.vue'
import CommonFooter from'../../components/CommonFooter.vue'
import CommonLayout from'../../components/CommonLayout.vue'

const props = defineProps<{
  news: {
    id: number
    title: string
    content: string
  }
}>()

const goBack = () => {
  router.visit('user.news.index')
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
