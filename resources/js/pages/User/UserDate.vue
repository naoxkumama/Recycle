<template>
  <div class="common">
    <UserHeader />
    <CommonLayout
      leftImage="/images/bear.jpg"
      rightImage="/images/truck.jpg"
    >

    <main>
        <h1>営業時間 📅</h1>
        <p>回収日  月～金  9:00-19:00</p>
        <p>電話受付  月～日  9:00-21:00</p>
        <p>電話番号  012-3456-789</p>
        <p>お問い合わせフォームからの連絡には１営業日以内に返信します</p>
        <p>お急ぎの方は電話でお問い合わせください</p>
    </main>
      <ButtonColors :buttons="buttons" @navigate="goPage" />
  </CommonLayout>
  </div>
</template>

<script setup lang="ts">

import { router } from '@inertiajs/vue3'
import ButtonColors from '../../components/buttonColors.vue'
import UserHeader from '../../components/UserHeader.vue'
import CommonLayout from'../../components/CommonLayout.vue'

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
