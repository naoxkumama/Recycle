<template>
  <header class="user-header">
    <h2 class="main-title">くままの不用品回収🧸</h2>
    <div class="right">
      <button class="btn btn-primary" @click="goPage('/admin/AdminHome')">管理者ページ</button>
      <button class="btn btn-secondary" @click="goPage('/user/home')">TOPページ</button>
      <div class="phone">
        <a href="tel:090-1234-5678">📞 090-1234-5678</a>
      </div>

      <!-- ハンバーガー -->
      <button class="menu-toggle" @click="toggleMenu">
        ☰
      </button>

      <!-- オーバーレイ -->
      <div v-if="open" class="overlay" @click="closeMenu">
        <nav class="drawer" @click.stop>
          <!-- 閉じるボタン -->
          <button class="close-menu-btn" @click="closeMenu">✕ 閉じる</button>
          <div class="drawer-phone">
            <a href="tel:090-1234-5678">📞 090-1234-5678</a>
          </div>
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
import { ref } from "vue"
import { router } from "@inertiajs/vue3"

const goPage = (path: string) => {
  router.visit(path)
}

const open = ref(false)

const toggleMenu = () => {
  open.value = !open.value
}
const closeMenu = () => open.value = false

const navigate = (path: string) => {
  open.value = false // 閉じる
  router.visit(path)
}

const buttons = [
  { label: "お知らせ", path: "/user/UserNewsList", class: "news-btn"},
  { label: "ブログ", path: "/user/UserBlogList", class: "blog-btn"},
  { label: "営業時間", path: "/user/UserDate", class: "date-btn" },
  { label: "料金", path: "/user/UserFee", class: "fee-btn" },
  { label: "仮予約", path: "/user/UserReservation", class: "reservation-btn" },
  { label: "お問い合わせ", path: "/user/UserContact", class: "contact-btn" }
]
</script>

<style scoped>
.user-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 40px;
  background: #e8e9fa;
  color: white;
  position: sticky;
  top: 0;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  z-index: 11; /* メニューより上 */
}

.left{
  display: flex;
  align-items: baseline;
  justify-content: left;
  gap: 10px;
  flex : 1;
  text-align: right;
}

.main-title {
  font-size: 1.4rem;
  font-weight: bold;
  margin: 0;
  letter-spacing: 1px;
  color: #2c3e50
}


.right {
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
  transition: all 0.2s ease;
}

.btn-primary {
  background-color: #3498db;
  color: white;
  border: 1px solid #3498db;
}

.btn-primary:hover {
  background-color: #256b9b;
  color: white;
  border: 1px solid #256b9b;
}

.btn-secondary {
  background-color: white;
  color: #3498db;
  border: 1px solid #3498db;
}

.btn-secondary:hover {
  background-color: #ecf0f1;
}

.phone a {
  font-size: 1.1rem;
  color: #333;
  text-decoration: none;
  font-weight: bold;
}

.phone a:hover {
  color: #007bff;
}

.menu-toggle {
  font-size: 2rem;
  background: none;
  border: none;
  cursor: pointer;
}

/* オーバーレイ */
.overlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,.4);
  display: flex;
  justify-content: flex-end;
  z-index: 10; /* 背景画像より上 */
}

/* ドロワー */
.drawer {
  width: 250px;
  background: white;
  padding: 20px;
  border-left: 2px solid #ffd5e5;
  display: flex;
  flex-direction: column;
  gap: 12px;
  animation: slideIn .25s ease;
}

.drawer-phone a {
  display: block;
  margin-bottom: 12px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}

.drawer-phone a:hover {
color: #007bff;
}

.close-menu-btn {
align-self: flex-end;
background: none;
border: none;
font-size: 1.2rem;
cursor: pointer;
margin-bottom: 10px;
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

@keyframes slideIn {
  from { transform: translateX(100%); }
  to   { transform: translateX(0); }
}

/* スマホ・タブレット用 */
@media (max-width: 768px) {
  .right {
    gap: 8px;
    flex-wrap: nowrap;
  }

  .btn-primary,
  .btn-secondary {
    display: none; /* ボタンはハンバーガー内に統合 */
  }

  .phone {
    display: none; /* 必要に応じてハンバーガー内に移動 */
  }

  .menu-toggle {
    display: block;
  }

  .main-title {
    font-size: 1.2rem; /* タイトル小さめ */
  }
}
</style>
