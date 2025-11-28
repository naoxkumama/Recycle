<template>
  <div class="main-buttons">
    <button
      v-for="btn in props.buttons"
      :key="btn.path"
      class="main-btn"
      :class="btn.class"
      @click="$emit('navigate', btn.path)"
    >
      {{ btn.label }}
    </button>
  </div>
</template>

<script setup>
const props = defineProps({
  buttons: {
    type: Array,
    required: true
  }
})
</script>

<style scoped>
.main-buttons {
  display: flex;
  flex-direction: column; /* 縦並び */
  align-items: center;   /* 中央寄せ */
  gap: 20px;             /* ボタン間の余白 */
  margin-top: 50px;
  min-height: 60vh;
}

.main-btn {
  width: 200px;
  padding: 0.8rem 1.2rem;
  border: none;
  border-radius: 6px;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  color: white;
  transition: all 0.2s ease;
  background: var(--btn-color);
}

.main-btn:hover {
  transform: scale(1.05);
  filter: brightness(0.9);
}

.home-btn        { --btn-color: #3498db; }
.date-btn        { --btn-color: #2980b9; }
.fee-btn         { --btn-color: #e74c3c; }
.news-btn        { --btn-color: #f1c40f; color: black; } /* 黄色は黒文字に */
.blog-btn        { --btn-color: #2ecc71; }
.reservation-btn { --btn-color: #e67e22; }
.contact-btn     { --btn-color: #9b59b6; }

.home-btn:hover        {background: #217dbb;}
.date-btn:hover        {background: #1f6391;}
.fee-btn:hover         {background: #c0392b;}
.news-btn:hover        {background: #d4ac0d;}
.blog-btn:hover        {background: #27ae60;}
.reservation-btn:hover {background: #d35400;}
.contact-btn:hover     {background: #8e44ad;}
</style>
