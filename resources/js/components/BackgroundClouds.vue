<template>
  <div class="background-clouds">
    <div v-for="(cloud, i) in clouds" :key="i" class="cloud" :style="cloud"></div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'

const clouds = ref<any[]>([])

onMounted(() => {
  for (let i = 0; i < 8; i++) {
    clouds.value.push({
      width: `${150 + Math.random() * 150}px`,
      height: `${80 + Math.random() * 80}px`,
      top: `${10 + Math.random() * 60}%`,
      left: `-${Math.random() * 300}px`,
      animationDuration: `${60 + Math.random() * 60}s`
    })
  }
})
</script>

<style scoped>
body, .top-page {
  margin: 0;
  font-family: 'Noto Sans JP', sans-serif;
  background: linear-gradient(135deg, #FFFAF0, #FFF8E1, #E0F7FA);
  overflow-x: hidden;
}

.background-clouds {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: -1;
  overflow: hidden;
}

.cloud {
  position: absolute;
  background: #ffffffdd;
  border-radius: 50%;
  filter: drop-shadow(0 0 12px rgba(0,0,0,0.1));
  animation: floatClouds linear infinite;
}

@keyframes floatClouds {
  0% { transform: translateX(0); }
  100% { transform: translateX(120vw); }
}
</style>
