<template>
  <div class="common">
    <AdminHeader />
    <CommonLayout
      leftImage="/images/bear.jpg"
      rightImage="/images/truck.jpg"
    >

    <div class="notifications">
      <p v-if="reserveCount > 0" class="alert link" @click="goReservationList">
        🔔 仮予約が {{ reserveCount }} 件あります
      </p>

      <p v-if="contactCount > 0" class="alert link" @click="goContactList">
        📩 お問い合わせが {{ contactCount }} 件あります
      </p>
    </div>

    <main>
      <h1>管理画面TOPページ</h1>
    </main>
    </CommonLayout>
    <AdminFooter />
    <CommonFooter />
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import AdminHeader from '../../components/AdminHeader.vue'
import AdminFooter from '../../components/AdminFooter.vue'
import CommonFooter from '../../components/CommonFooter.vue'
import CommonLayout from '../../components/CommonLayout.vue'

const reserveCount = ref(0)
const contactCount = ref(0)

const fetchCounts = async () => {
  const r = await fetch('/api/admin/reservations/unread')
  const c = await fetch('/api/admin/contacts/unread')

  reserveCount.value = (await r.json()).count
  contactCount.value = (await c.json()).count
}

// 初回だけ取得
onMounted(fetchCounts)

const goReservationList = () => {
  reserveCount.value = 0   // 🔥 ここで確実に消える
  router.visit('/admin/AdminReservationHistory')
}

const goContactList = () => {
  contactCount.value = 0
  router.visit('/admin/AdminContactHistory')
}
</script>

<style scoped>
.common {
  text-align: center;
  margin-top: 10px;
}

.notifications {
  margin-top: 20px;
}

.alert {
  color: #d32f2f;
  font-weight: bold;
  margin: 10px 0;
}

.alert.link {
  cursor: pointer;
  text-decoration: underline;
}

.alert.link:hover {
  opacity: 0.7;
}

.alert.link:active {
  transform: scale(0.98);
}
</style>
