<template>
  <div class="common">
    <UserHeader />
    <CommonLayout
      leftImage="/images/bear.jpg"
      rightImage="/images/truck.jpg"
    >

    <main>
        <h1>料金 💰</h1>

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
