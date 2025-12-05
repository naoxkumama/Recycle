<template>
  <div class="common">
    <UserHeader />
    <CommonLayout
      leftImage="/images/bear.jpg"
      rightImage="/images/truck.jpg"
    >

    <main>
      <section class="business-hours">
        <h2>営業時間・ご対応について</h2>

        <div class="block">
          <h3>回収対応時間 📅</h3>
          <p>月〜金：<strong>9:00〜19:00</strong></p>
          <p>時間外のご相談も可能ですので、お気軽にお問い合わせください。</p>
        </div>

        <div class="block">
          <h3>電話受付時間 ☎️</h3>
          <p>月〜日：<strong>9:00〜21:00</strong></p>
          <p>📞 <strong>012-3456-789</strong></p>
          <p>※作業中などで出られない場合がありますが、折り返しご連絡いたします。</p>
        </div>

        <div class="block">
          <h3>お問い合わせフォーム 📬</h3>
          <p>フォームからのご連絡には、<strong>1営業日以内に返信</strong>いたします。</p>
          <p>写真の添付もOKです。お気軽にご相談ください。</p>
        </div>

        <div class="block urgent">
          <h3>お急ぎの方へ 🐻</h3>
          <p>当日対応をご希望の場合は、<strong>お電話が最もスムーズです！</strong></p>
          <p>可能な限り迅速に対応いたします。</p>
        </div>

      </section>
    </main>
      <ButtonColors :buttons="buttons" @navigate="goPage" />
  </CommonLayout>
  <UserFooter />
  <CommonFooter />
  </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import ButtonColors from '../../components/buttonColors.vue'
import UserHeader from '../../components/UserHeader.vue'
import UserFooter from '../../components/UserFooter.vue'
import CommonFooter from'../../components/CommonFooter.vue'
import CommonLayout from'../../components/CommonLayout.vue'

const buttons = [
  { label: "ホームへ戻る", path: "/user/home", class: "home-btn" },
]

const goPage = (path: string) => {
  router.visit(path)
}
</script>

<style scoped>
.common {
  text-align: center;
  margin-top: 10px;
}

button {
  padding: 0.6rem 1.2rem;
  border: none;
  border-radius: 6px;
  background: #3498db;
  color: white;
  font-size: 1rem;
  cursor: pointer;
}

.business-hours h2 {
  font-size: 1.8rem;
  margin-bottom: 20px;
}

.business-hours .block {
  background: #fff7f8;
  border-radius: 14px;
  padding: 16px 20px;
  margin-bottom: 18px;
}

.business-hours h3 {
  font-size: 1.2rem;
  margin-bottom: 8px;
}

.business-hours p {
  margin: 4px 0;
}

.business-hours .urgent {
  background: #ffeef3;
  border: 2px solid #ffb9ce;
}
</style>
