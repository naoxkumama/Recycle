<template>
  <div class="common">
    <UserHeader />
    <CommonLayout
      leftImage="/images/bear.jpg"
      rightImage="/images/truck.jpg"
    >
      <h1>TOPページ</h1>
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
  { label: "お知らせ", path: "/user/userNews", class: "news-btn"},
  { label: "ブログ", path: "/user/userBlogList", class: "blog-btn"},
  { label: "営業時間", path: "/user/userDate", class: "date-btn" },
  { label: "料金", path: "/user/userFee", class: "fee-btn" },
  { label: "仮予約", path: "/user/userReservation", class: "reservation-btn" },
  { label: "お問い合わせ", path: "/user/userContact", class: "contact-btn" }
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
</style>
