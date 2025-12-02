<template>
  <header class="admin-header">
    <div class="left">
      <h1 class="main-title">くままの不用品回収🧸</h1>
      <span class="subtitle">管理画面</span>
    </div>

    <div class="right">
      <button class="btn btn-primary" @click="goPage('/admin/AdminHome')">管理画面TOPへ</button>
      <button class="btn btn-secondary" @click="goPage('/user/home')">ユーザーTOPへ</button>
      <button class="btn btn-danger" @click="goPage('/admin/Logout')">ログアウト</button>
    </div>
  </header>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'

const goPage = (path: string) => {
  if (path === '/admin/Logout') {
    router.post(path)
  } else{
    window.location.href = `https://recycle-api-staging.onrender.com${path}`;
  }
}
</script>

<style scoped>
.admin-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 40px;
  background: #e8e9fa;
  color: white;
  position: sticky;
  top: 0;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
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

.subtitle {
  font-size: 1.3rem;
  font-weight: 600;
  color: #555;
  letter-spacing: 0.5px;
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
  background-color: #266c9a;
  color: white;
  border: 1px solid #266c9a;
}

.btn-secondary {
  background-color: white;
  color: #3498db;
  border: 1px solid #3498db;
}

.btn-secondary:hover {
  background-color: #ecf0f1;
}

.btn-danger {
  background-color: #e74c3c;
  color: white;
  border: 1px solid transparent;
}

.btn-danger:hover {
  background-color: #c0392b;
}
</style>
