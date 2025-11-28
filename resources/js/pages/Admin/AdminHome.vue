<template>
  <div class="common">
    <AdminHeader />
    <CommonLayout
      leftImage="/images/bear.jpg"
      rightImage="/images/truck.jpg"
    >

    <main>
      <h1>管理画面TOPページ</h1>
      <ButtonColors :buttons="buttons" @navigate="goPage" />
    </main>
    </CommonLayout>
  </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import ButtonColors from '../../components/buttonColors.vue'
import AdminHeader from '../../components/AdminHeader.vue'
import CommonLayout from'../../components/CommonLayout.vue'

const buttons = [
  { label: "お知らせ管理", path: "/admin/AdminNewsEdit", class: "news-btn"},
  { label: "ブログ管理", path: "/admin/AdminBlogList", class: "blog-btn"},
  { label: "仮予約履歴", path: "/admin/AdminReservationHistory", class: "reservation-btn" },
  { label: "お問い合わせ履歴", path: "/admin/AdminContactHistory", class: "contact-btn" }
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
