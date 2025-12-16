<template>
  <header class="admin-header">
    <div class="left">
      <h1 class="main-title">くままの不用品回収🧸</h1>
      <span class="subtitle">管理画面</span>
    </div>

    <div class="right">
      <button class="btn btn-primary" @click="goPage('/admin/AdminHome')">
        管理画面TOPへ
      </button>
      <button class="btn btn-secondary" @click="goPage('/user/home')">
        ユーザーTOPへ
      </button>
      <button class="btn btn-danger" @click="goPage('/admin/Logout')">
        ログアウト
      </button>

      <!-- 🔔 通知 -->
      <button class="notification" @click="toggleNotify">
        🔔
        <span v-if="totalUnread > 0" class="badge">{{ totalUnread }}</span>
      </button>

      <div v-if="showNotify" class="notify-dropdown">
        <button @click="goReservation">
          仮予約（{{ reservationUnread }}）
        </button>
        <button @click="goContact">
          お問い合わせ（{{ contactUnread }}）
        </button>
      </div>

      <!-- ハンバーガー -->
      <button class="menu-toggle" @click="toggleMenu">
        ☰
      </button>

      <!-- オーバーレイ -->
      <div v-if="open" class="overlay" @click="closeMenu">
        <nav class="drawer" @click.stop>
          <button class="close-menu-btn" @click="closeMenu">
            ✕ 閉じる
          </button>

          <button
            v-for="(btn, i) in buttons"
            :key="i"
            class="menu-item"
            @click="navigate(btn.path)"
          >
            {{ btn.label }}
          </button>
        </nav>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { router } from '@inertiajs/vue3'

/* state */
const totalUnread = ref(0)
const open = ref(false)

/* 未読件数取得 */
const fetchUnread = async () => {
  try {
    const res = await fetch('/api/admin/notifications/unread')
    if (!res.ok) throw new Error('API error')

    const data = await res.json()

    // 🔥 ここが足りなかった
    reservationUnread.value = data.reservations
    contactUnread.value = data.contacts
    totalUnread.value = data.reservations + data.contacts
  } catch (e) {
    console.error('通知取得失敗', e)
  }
}

/* Inertia finish リスナー保持用 */
let stopFinish: (() => void) | null = null

onMounted(() => {
  // 初回取得
  fetchUnread()

  // 画面遷移完了ごとに再取得
  stopFinish = router.on('finish', fetchUnread)
})

onUnmounted(() => {
  // 正しい解除
  if (stopFinish) stopFinish()
})

/* ナビゲーション */
const showNotify = ref(false)
const reservationUnread = ref(0)
const contactUnread = ref(0)

const toggleNotify = () => {
  showNotify.value = !showNotify.value
}

const goReservation = () => {
  showNotify.value = false
  router.visit('/admin/AdminReservationHistory')
}

const goContact = () => {
  showNotify.value = false
  router.visit('/admin/AdminContactHistory')
}

const toggleMenu = () => {
  open.value = !open.value
}

const closeMenu = () => {
  open.value = false
}

const navigate = (path: string) => {
  open.value = false
  router.visit(path)
}

const goPage = (path: string) => {
  path === '/admin/Logout'
    ? router.post(path)
    : router.visit(path)
}

/* メニュー */
const buttons = [
  { label: 'お知らせ管理', path: '/admin/AdminNewsList' },
  { label: 'ブログ管理', path: '/admin/AdminBlogList' },
  { label: '仮予約履歴', path: '/admin/AdminReservationHistory' },
  { label: 'お問い合わせ履歴', path: '/admin/AdminContactHistory' },
]
</script>

<style scoped>
.admin-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 40px;
  background: #e8e9fa;
  position: sticky;
  top: 0;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  z-index: 11;
}

.left {
  display: flex;
  align-items: baseline;
  gap: 10px;
  flex: 1;
}

.main-title {
  font-size: 1.4rem;
  font-weight: bold;
  margin: 0;
  color: #2c3e50;
}

.subtitle {
  font-size: 1.3rem;
  font-weight: 600;
  color: #555;
}

.right {
  position: relative;
  display: flex;
  align-items: center;
  gap: 12px;
}

.btn {
  padding: 6px 14px;
  border: none;
  border-radius: 6px;
  font-size: 0.9rem;
  cursor: pointer;
  font-weight: 600;
}

.btn-primary {
  background: #3498db;
  color: #fff;
}

.btn-primary:hover {
  background: #266c9a;
}

.btn-secondary {
  background: #fff;
  color: #3498db;
  border: 1px solid #3498db;
}

.btn-secondary:hover {
  background: #ecf0f1;
}

.btn-danger {
  background: #e74c3c;
  color: #fff;
}

.btn-danger:hover {
  background: #c0392b;
}

/* 通知 */
.notification {
  position: relative;
  background: none;
  border: none;
  cursor: pointer;
  font-size: 20px;
}

.notification:hover {
  opacity: 0.7;
}

/* 通知ドロップダウン */
.notify-dropdown {
  position: absolute;
  top: 100%;
  right: 0;
  margin-top: 8px;
  background: #ffffff;
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
  min-width: 180px;
  z-index: 20;
  padding: 6px 0;
}

/* ドロップダウン内のボタン */
.notify-dropdown button {
  width: 100%;
  background: none;
  border: none;
  padding: 10px 16px;
  text-align: left;
  font-size: 0.9rem;
  cursor: pointer;
  color: #333;
}

/* hover */
.notify-dropdown button:hover {
  background: #f5f6ff;
}

/* 件数を目立たせる */
.notify-dropdown button span {
  font-weight: bold;
  color: #d32f2f;
}

.badge {
  position: absolute;
  top: -4px;
  right: -8px;
  background: #d32f2f;
  color: #fff;
  border-radius: 999px;
  font-size: 11px;
  padding: 2px 6px;
}

/* メニュー */
.menu-toggle {
  font-size: 2rem;
  background: none;
  border: none;
  cursor: pointer;
}

.overlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,.4);
  display: flex;
  justify-content: flex-end;
  z-index: 10;
}

.drawer {
  width: 250px;
  background: #fff;
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.close-menu-btn {
  align-self: flex-end;
  background: none;
  border: none;
  font-size: 1.2rem;
  cursor: pointer;
}

.menu-item {
  padding: .7rem 1rem;
  background: #fff7fa;
  border: 1px solid #ffd5e5;
  border-radius: 8px;
  cursor: pointer;
  text-align: left;
}

.menu-item:hover {
  background: #ffd5e5;
}
</style>
