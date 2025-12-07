<template>
  <div class="common">
    <UserHeader />
    <BackgroundClouds />
    <CommonLayout
      leftImage="/images/bear.jpg"
      rightImage="/images/truck.jpg"
    >

    <main>
      <section class="price-cards">
        <h2>料金プラン 🧸</h2>

        <div class="card">
          <h3>軽トラック積み放題</h3>
          <p class="price">¥12,000〜</p>
          <p class="desc">一人暮らしの片付けに最適</p>
        </div>

        <div class="card">
          <h3>軽トラ半分プラン</h3>
          <p class="price">¥7,000〜</p>
          <p class="desc">少量ならこれで十分</p>
        </div>

        <div class="card">
          <h3>単品回収</h3>
          <p class="price">¥500〜</p>
          <p class="desc">小型家具や家電など</p>
        </div>
      </section>

      <section class="info-cards">
        <div class="info-card">
          <h3>追加料金について 🧾</h3>

          <p class="desc">以下の場合、追加料金が発生することがございます。</p>

          <ul>
            <li>2階以上でエレベーターが無い場合の搬出</li>
            <li>解体が必要な大型家具</li>
            <li>特殊な搬出作業が必要な場合</li>
          </ul>

          <p class="note">
            ※追加が必要な場合は、<span>事前にご案内いたします</span>のでご安心ください。
          </p>
        </div>

        <div class="info-card">
          <h3>お得な割引 🎀</h3>

          <p class="desc">まとめての回収や、リピーターの方にお得な割引があります。</p>

          <ul>
            <li>まとめて回収割引：最大15%OFF</li>
            <li>リピーター割引：¥500〜¥2,000 OFF</li>
            <li>事前予約割引：¥500 OFF</li>
          </ul>
        </div>

        <div class="info-card">
          <h3>お見積りについて 💬</h3>

          <p class="desc">
            お見積りは<span>完全無料</span>です。<br>
            LINE・メール・お電話にてお気軽にご相談ください。
          </p>
        </div>

        <div class="info-card">
          <h3>対応エリア 🗺️</h3>

          <p class="desc">
            東京23区・多摩地域を中心に対応しています。<br>
            対象外エリアでもお気軽にご相談ください。
          </p>
        </div>
      </section>

      <form class="simulator">
        <h3>料金シュミレーター 💰</h3>
          <label>
            荷物の量
            <select name="volume" v-model="volume">
              <option value="small">袋 1〜2袋</option>
              <option value="medium">軽トラ半分</option>
              <option value="large">軽トラ1台</option>
            </select>
          </label>

          <label>
            2階以上でエレベーター無し
            <input type="checkbox" v-model="stairs">
          </label>

        <button @click.prevent="calcPrice">概算を計算する</button>

        <p v-if="price">概算料金：<strong>{{ price }}円</strong></p>
      </form>

      <section class="faq-section">
        <h2>よくある質問（FAQ）🐻</h2>

        <div
          v-for="(item, index) in faqList"
          :key="index"
          class="faq-item"
          @click="toggle(index)"
        >
          <div class="faq-question">
            {{ item.q }}
            <span class="icon">{{ openIndex === index ? '−' : '+' }}</span>
          </div>

          <div class="faq-answer" v-show="openIndex === index">
            {{ item.a }}
          </div>
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
import { ref } from 'vue'
import ButtonColors from '../../components/buttonColors.vue'
import UserHeader from '../../components/UserHeader.vue'
import UserFooter from '../../components/UserFooter.vue'
import CommonFooter from'../../components/CommonFooter.vue'
import CommonLayout from'../../components/CommonLayout.vue'
import BackgroundClouds from '../../components/BackgroundClouds.vue'

const openIndex = ref<number | null>(null)

const toggle = (index: number) => {
  openIndex.value = openIndex.value === index ? null : index
}

const faqList = [
  {
    q: "支払い方法は何がありますか？",
    a: "現金・クレジットカード・PayPayが使えます🐻💳"
  },
  {
    q: "深夜でも対応できますか？",
    a: "相談OKです🌙 ただし、騒音を避けるため一部作業が翌日になる可能性があります。"
  },
  {
    q: "回収できない品目はありますか？",
    a: "法律で処分できない物品は回収できませんが、代替案をご案内します。"
  },
  {
    q: "回収前に分別は必要ですか？",
    a: "基本的に不要です🧸 そのままで大丈夫！ ※液体物・危険物だけ分けてもらえると嬉しいです"
  },
  {
    q: "家具の解体もお願いできますか？",
    a: "はい！経験豊富なので安心してください💪🧸"
  },
  {
    q: "当日の急な依頼でも対応できますか？",
    a: "予約状況により可能です！お気軽にご相談ください。"
  },
  {
    q: "見積り後にキャンセルできますか？",
    a: "作業前であればキャンセル料はかかりません。"
  },
  {
    q: "立ち会いは必要ですか？",
    a: "可能であればお願いしておりますが、ご事情により柔軟に対応します。"
  },
  {
    q: "女性スタッフは来てくれますか？",
    a: "ご希望に応じて対応いたします。お気軽にお申し付けください。"
  },
  {
    q: "汚れていても大丈夫ですか？",
    a: "問題ありません！そのままの状態で大丈夫です。"
  }
]

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

h2 {
  font-size: 1.2rem;
  margin-top: 20px;
  color: #333;
}

p {
  margin: 10px 0;
  line-height: 1.6;
}

ul {
  list-style: disc;
  text-align: left;
  margin: 10px auto;
  width: fit-content;
}

li {
  margin-bottom: 6px;
}

/* --- Price Card --- */
.price-cards {
  margin-top: 30px;
}

.price-cards h2 {
  font-size: 1.4rem;
  margin-bottom: 20px;
  color: #e8558e;
}

.card {
  background: #ffe1ec;
  border-radius: 16px;
  padding: 16px 20px;
  margin: 14px auto;
  max-width: 380px;
  text-align: center;
  box-shadow: 0 3px 10px rgba(231, 128, 164, 0.3);
  transition: all .2s ease;
}

.card:hover {
  transform: translateY(-3px);
  box-shadow: 0 5px 14px rgba(231, 128, 164, 0.4);
}

.card h3 {
  font-size: 1.2rem;
  font-weight: bold;
  color: #e8558e;
}

.price {
  font-size: 1.6rem;
  font-weight: bold;
  margin: 6px 0;
  color: #d6336c;
}

.desc {
  font-size: .9rem;
  color: #444;
}

.simulator {
  margin-top: 20px;
  padding: 16px;
  background: #fff7f8;
  border-radius: 12px;
}

.simulator h3{
  background: #ffe1ec;
  padding: 8px 12px;
  border-radius: 12px;
  display: inline-block;
}

.simulator label {
  display: block;
  margin-bottom: 12px;
}

button {
  padding: 8px 16px;
  border-radius: 12px;
  background: #ffadc3;
  color: white;
}

/* --- FAQ --- */
.faq-section {
  margin-top: 40px;
  width: 90%;
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
}

.faq-section h2 {
  text-align: center;
  font-size: 1.4rem;
  color: #e8558e;
  margin-bottom: 20px;
}

.faq-item {
  background: #fff5f8;
  border-radius: 14px;
  padding: 16px 20px;
  margin-bottom: 12px;
  box-shadow: 0 2px 6px rgba(231, 128, 164, 0.2);
  cursor: pointer;
  transition: all .2s ease;
}

.faq-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(231, 128, 164, 0.3);
}

.faq-question {
  font-weight: bold;
  font-size: 1rem;
  color: #444;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.icon {
  font-size: 1.4rem;
  line-height: 1;
  color: #e8558e;
}

.faq-answer {
  margin-top: 12px;
  font-size: .95rem;
  color: #555;
  line-height: 1.6;
  animation: fadeIn .2s ease;
}

/* --- Info Cards Wrapper --- */
.info-cards {
  margin-top: 40px;
  display: grid;
  gap: 18px;
}

/* --- Info Card --- */
.info-card {
  background: #fff5f8;
  border-radius: 16px;
  padding: 18px 22px;
  box-shadow: 0 2px 8px rgba(231, 128, 164, 0.25);
  transition: all .2s ease;
}

.info-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 14px rgba(231, 128, 164, 0.35);
}

.info-card h3 {
  background: #ffe1ec;
  padding: 8px 12px;
  border-radius: 12px;
  display: inline-block;
}

/* --- Text --- */
.desc {
  color: #555;
  font-size: .95rem;
  line-height: 1.7;
  margin-bottom: 12px;
}

.desc span {
  font-weight: bold;
  color: #e8558e;
}

/* --- List --- */
.info-card ul {
  list-style: disc;
  padding-left: 20px;
  margin: 10px 0 8px;
  color: #444;
}

.info-card li {
  margin-bottom: 6px;
  font-size: .92rem;
}

/* --- Note text --- */
.note {
  margin-top: 10px;
  font-size: .9rem;
  color: #777;
  line-height: 1.6;
}

.note span {
  color: #e8558e;
  font-weight: bold;
}

/* animations */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-6px); }
  to { opacity: 1; transform: translateY(0); }
}

@media (min-width: 700px) {
  .info-cards {
    grid-template-columns: repeat(2, 1fr);
  }
}
</style>
