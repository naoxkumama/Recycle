<template>
  <div class="common">
    <AdminHeader />
    <CommonLayout
      leftImage="/images/bear.jpg"
      rightImage="/images/truck.jpg"
    >

    <main>
      <h1>管理画面TOPページ</h1>
    </main>
    </CommonLayout>
    <AdminFooter />
    <CommonFooter />
  </div>
</template>

<script setup lang="ts">
import AdminHeader from '../../components/AdminHeader.vue'
import AdminFooter from'../../components/AdminFooter.vue'
import CommonFooter from'../../components/CommonFooter.vue'
import CommonLayout from'../../components/CommonLayout.vue'

</script>

<style scoped>
.common {
  text-align: center;
  margin-top: 10px;
}
</style>
