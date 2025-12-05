<template>
  <div class="common">
    <UserHeader />
    <CommonLayout
      leftImage="/images/bear.jpg"
      rightImage="/images/truck.jpg"
    >
      <h1>TOPページ</h1>
        <section class="intro">
          <h2>くままの不用品回収について</h2>
          <p>
            家具・家電・生活雑貨などの不用品を迅速に回収するサービスです。<br>
            1点からでもお気軽にご利用ください。<br>
            明瞭な料金と丁寧なスタッフで、安心してご利用いただけます。
          </p>
        </section>

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

        <section class="cta">
          <h2>まずは無料お見積りから📸</h2>
          <p>LINEやフォームから写真を送るだけ！</p>
          <button class="cta-btn" @click="goContact">無料で見積りする</button>
        </section>

        <section class="area">
          <h2>対応エリア🗾</h2>
          <p>東京23区・多摩地域を中心に対応しています。</p>

          <p class="note">上記以外の地域もご相談ください🐻</p>
        </section>

        <section class="reviews">
          <h2>お客様の声💬</h2>

          <div class="slider">
            <div class="slide" v-for="(item, i) in reviews" :key="i" v-show="current === i">
              <p class="text">"{{ item.text }}"</p>
              <p class="name">- {{ item.name }}</p>
            </div>
          </div>

          <div class="slider-controls">
            <button @click="prev">←</button>
            <button @click="next">→</button>
          </div>
        </section>
      <ButtonColors :buttons="buttons" @navigate="goPage" />
    </CommonLayout>
    <CommonFooter />
  </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'
import ButtonColors from '../../components/buttonColors.vue'
import UserHeader from '../../components/UserHeader.vue'
import CommonFooter from'../../components/CommonFooter.vue'
import CommonLayout from'../../components/CommonLayout.vue'

const reviews = ref([
  { text: "すごく丁寧で安心してお願いできました！", name: "30代 女性" },
  { text: "急な依頼にも対応してくれて助かりました！", name: "40代 男性" },
  { text: "料金が明確でわかりやすかったです！", name: "20代 女性" },
])

const current = ref(0)

const next = () => current.value = (current.value + 1) % reviews.value.length
const prev = () => current.value = (current.value - 1 + reviews.value.length) % reviews.value.length

const buttons = [
  { label: "お知らせ", path: "/user/UserNewsList", class: "news-btn"},
  { label: "ブログ", path: "/user/UserBlogList", class: "blog-btn"},
  { label: "営業時間", path: "/user/UserDate", class: "date-btn" },
  { label: "料金", path: "/user/UserFee", class: "fee-btn" },
  { label: "仮予約", path: "/user/UserReservation", class: "reservation-btn" },
  { label: "お問い合わせ", path: "/user/UserContact", class: "contact-btn" }
]

const goPage = (path: string) => {
  router.visit(path)
}
const goContact = () => router.visit('/user/UserContact')
</script>

<style scoped>
.common {
  text-align: center;
  margin-top: 10px;
}

.intro {
  background: #fff7fa;
  border-radius: 16px;
  padding: 24px;
  margin: 20px;
  text-align: center;
  border: 2px solid #ffd5e5;
}

.intro h2 {
  font-size: 1.6rem;
  margin-bottom: 12px;
  color: #333;
}

.intro p {
  line-height: 1.7;
  font-size: 1rem;
  color: #444;
}

/* 共通 */
section {
  margin: 40px auto;
  max-width: 800px;
  text-align: center;
}

/* 特徴カード */
.features-grid {
  display: flex;
  gap: 15px;
  justify-content: center;
  flex-wrap: wrap;
}

.feature-card {
  background: #fff7fa;
  border: 2px solid #ffd5e5;
  border-radius: 16px;
  padding: 20px;
  width: 200px;
}

.icon {
  font-size: 2.2rem;
  margin-bottom: 10px;
}

/* CTA */
.cta {
  background: #fff7fa;
  border: 2px solid #ffd5e5;
  border-radius: 16px;
  padding: 30px 20px;
}

.cta-btn {
  padding: 0.8rem 1.6rem;
  background: #ff69b4;
  border: none;
  border-radius: 8px;
  font-size: 1.1rem;
  color: white;
  cursor: pointer;
}

.cta-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 14px rgba(231, 128, 164, 0.35);
}

/* 対応エリア */
.area {
  background: #fff7fa;
  border-radius: 16px;
  padding: 24px;
  margin: 20px auto;
  max-width: 800px;
  border: 2px solid #ffd5e5;
  text-align: center;
}

/* レビュー */
/* お客様の声 */
.reviews {
  background: #fff7fa;
  border-radius: 16px;
  padding: 24px;
  margin: 20px auto;
  max-width: 800px;
  border: 2px solid #ffd5e5;
}

.slider {
  position: relative;
  min-height: 80px;
}

.slide {
  transition: opacity 0.3s ease;
}

.text {
  font-size: 1.1rem;
  font-style: italic;
}

.name {
  margin-top: 10px;
  color: #666;
}

.slider-controls button {
  margin: 10px 5px;
  padding: 0.4rem 1rem;
}

@media (max-width: 600px) {
  .feature-card {
    width: 100%;
  }
}
</style>
