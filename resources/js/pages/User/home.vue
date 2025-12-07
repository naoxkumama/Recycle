<template>
  <div class="top-page">
    <UserHeader />
    <BackgroundClouds />

    <CommonLayout
      leftImage="/images/bear.jpg"
      rightImage="/images/truck.jpg"
    >
      <h1 class="page-title">TOPページ</h1>

      <!-- 事業紹介 -->
      <section class="intro">
        <h2>くままの不用品回収について</h2>
        <p>
          家具・家電・生活雑貨などの不用品を迅速に回収するサービスです。<br>
          1点からでもお気軽にご利用ください。<br>
          明瞭な料金と丁寧なスタッフで、安心してご利用いただけます。
        </p>
      </section>

      <!-- 特徴カード -->
      <section class="features">
        <h2>くままの特徴 ✨</h2>
        <div class="features-grid">
          <div class="feature-card">
            <div class="icon">🚚</div>
            <h3>スピード対応</h3>
            <p>即日・急ぎ・引越し前でもOK！</p>
          </div>

          <div class="feature-card">
            <div class="icon">💰</div>
            <h3>明朗会計</h3>
            <p>見積り無料・追加費用なしで安心💡</p>
          </div>

          <div class="feature-card">
            <div class="icon">🧸</div>
            <h3>1点からでもOK</h3>
            <p>少量の不用品も回収可！</p>
          </div>
        </div>
      </section>

      <!-- CTA -->
      <section class="cta">
        <h2>まずは無料お見積りから📸</h2>
        <p>LINEやフォームから写真を送るだけ！</p>
        <button class="cta-btn" @click="goContact">無料で見積りする</button>
      </section>

      <!-- 対応エリア -->
      <section class="area">
        <h2>対応エリア🗾</h2>
        <p>東京23区・多摩地域を中心に対応しています。</p>
        <p class="note">上記以外の地域もご相談ください🐻</p>
      </section>

      <!-- お客様の声（3件ずつスライド） -->
      <section class="reviews">
        <h2>お客様の声💬</h2>
        <div class="slider">
          <div class="slide" v-for="(slide, i) in slides" :key="i" v-show="current === i">
            <div v-for="(item, j) in slide" :key="j" class="review-card">
              <p class="text">"{{ item.text }}"</p>
              <p class="name">- {{ item.name }}</p>
            </div>
          </div>
        </div>
        <div class="slider-controls">
          <button @click="prev">←</button>
          <button @click="next">→</button>
        </div>
      </section>

    </CommonLayout>

    <UserFooter />
    <CommonFooter />
  </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
import UserHeader from '../../components/UserHeader.vue'
import UserFooter from '../../components/UserFooter.vue'
import CommonFooter from '../../components/CommonFooter.vue'
import CommonLayout from '../../components/CommonLayout.vue'
import BackgroundClouds from '../../components/BackgroundClouds.vue'

const reviews = ref([
  { text: "すごく丁寧で安心してお願いできました！", name: "30代 女性" },
  { text: "急な依頼にも対応してくれて助かりました！", name: "40代 男性" },
  { text: "料金が明確でわかりやすかったです！", name: "20代 女性" },
  { text: "スタッフが親切で安心しました！", name: "50代 女性" },
  { text: "早くて助かりました！", name: "30代 男性" },
  { text: "また利用したいです！", name: "40代 女性" },
])

// 3件ずつのスライドに分割
const slides = ref<Array<{text:string, name:string}[]>>([])
onMounted(() => {
  for (let i = 0; i < reviews.value.length; i += 3) {
    slides.value.push(reviews.value.slice(i, i + 3))
  }
})

const current = ref(0)
const next = () => current.value = (current.value + 1) % slides.value.length
const prev = () => current.value = (current.value - 1 + slides.value.length) % slides.value.length
const goContact = () => router.visit('/user/UserContact')
</script>

<style scoped>
/* メイン */
.common { text-align: center; margin-top: 10px; position: relative;}
section { margin: 40px auto; max-width: 800px; text-align: center; position: relative;}

/* 事業紹介 */
.intro {
  background: #fff7fa;
  border-radius: 16px;
  padding: 24px;
  margin: 20px;
  border: 2px solid #ffd5e5;
}
.intro h2 { font-size: 1.6rem; margin-bottom: 12px; color: #333; z-index: 1;}
.intro p { line-height: 1.7; font-size: 1rem; color: #444; z-index: 1;}

/* 特徴カード */
.features-grid {
  display: flex;
  gap: 15px;
  justify-content: center;
  flex-wrap: wrap;
  position: relative;
  z-index: 1;
}
.feature-card {
  background: #fff7fa;
  border: 2px solid #ffd5e5;
  border-radius: 16px;
  padding: 20px;
  width: 200px;
  transition: transform 0.3s, box-shadow 0.3s;
}
.feature-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 8px 16px rgba(231,128,164,0.35);
}
.icon { font-size: 2.2rem; margin-bottom: 10px; }

/* CTA */
.cta {
  background: #fff7fa;
  border: 2px solid #ffd5e5;
  border-radius: 16px;
  padding: 30px 20px;
}
.cta-btn {
  padding: 0.8rem 1.6rem;
  background: linear-gradient(135deg, #ff6fb4, #ff8fce);
  border: none;
  border-radius: 8px;
  font-size: 1.1rem;
  color: white;
  cursor: pointer;
}
.cta-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 14px rgba(231,128,164,0.35);
}

/* 対応エリア */
.area {
  background: #fff7fa;
  border-radius: 16px;
  padding: 24px;
  margin: 20px auto;
  max-width: 800px;
  border: 2px solid #ffd5e5;
}

/* レビュー */
.reviews {
  background: #fff7fa;
  border-radius: 16px;
  padding: 24px;
  margin: 20px auto;
  max-width: 800px;
  border: 2px solid #ffd5e5;
}
.slide {
  display: flex;
  gap: 16px;
  justify-content: center;
  min-height: 80px;
}
.review-card {
  flex: 1;
  background: #fff;
  border-radius: 8px;
  padding: 12px;
  border: 1px solid #ffd5e5;
}
.text { font-size: 1.1rem; font-style: italic; }
.name { margin-top: 10px; color: #666; }
.slider-controls button { margin: 10px 5px; padding: 0.4rem 1rem; }

/* レスポンシブ */
@media (max-width: 600px) {
  .feature-card { width: 100%; }
  .slide { flex-direction: column; }
}
</style>
v