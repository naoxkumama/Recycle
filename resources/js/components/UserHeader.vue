<template>
  <header class="user-header">
    <h2 class="main-title">くままの不用品回収🧸</h2>
    <div class="right">
      <button class="btn btn-primary" @click="goPage('/admin/AdminHome')">管理者ページ</button>
      <button class="btn btn-secondary" @click="goPage('/user/home')">TOPページ</button>
      <div class="phone">
        <a href="tel:090-1234-5678">📞 090-1234-5678</a>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'

const goPage = (path: string) => {
  router.visit(`https://recycle-api-staging.onrender.com${path}`)
}
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
</style>
