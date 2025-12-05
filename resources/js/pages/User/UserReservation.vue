<template>
  <div class="common">
    <UserHeader />
    <CommonLayout
      leftImage="/images/bear.jpg"
      rightImage="/images/truck.jpg"
    >

    <main>
        <h1>仮予約 🖊</h1>

        <div class="form-group">
          <label for="name">お名前</label>
          <input v-model="form.name" type="text" id="name" required />
        </div>

        <div class="form-group">
          <label for="phone">電話番号</label>
          <input v-model="form.phone" type="phone" id="phone" required />
        </div>

        <div class="form-group">
          <label for="name">メールアドレス</label>
          <input v-model="form.email" type="email" id="email" required />
        </div>

        <div class="form-group">
          <label>第一希望</label>
          <input type="datetime-local" v-model="form.first" />
        </div>

        <div class="form-group">
          <label>第二希望</label>
          <input type="datetime-local" v-model="form.second" />
        </div>

        <div class="form-group">
          <label>第三希望</label>
          <input type="datetime-local" v-model="form.third" />
        </div>

        <div class="form-group">
          <label for="message">備考</label>
          <textarea v-model="form.message" id="message" rows="7" required></textarea>
        </div>

        <button type="button" @click="submitButton">送信</button>
    </main>
      <ButtonColors :buttons="buttons" @navigate="goPage" />
  </CommonLayout>
  <CommonFooter />
  </div>
</template>

<script setup lang="ts">
import { useForm, router } from '@inertiajs/vue3';
import ButtonColors from '../../components/buttonColors.vue'
import UserHeader from '../../components/UserHeader.vue'
import CommonFooter from'../../components/CommonFooter.vue'
import CommonLayout from'../../components/CommonLayout.vue'

const form = useForm({
  name: '',
  phone: '',
  first: '',
  second: '',
  third: ''
})

const submitButton = () => {
  form.post('/user/UserReservation', {
    onSuccess: () => {
      form.reset()
      router.visit('/user/UserReservationComplete')
    }
  })
}

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

form {
  margin: 0 auto; /* 中央寄せ */
}

.form-group {
  margin-bottom: 1rem;
  text-align: center; /* ラベルと入力欄を左揃え */
}

label {
  display: block;
  text-align: center;
  margin-bottom: 0.3rem;
  font-weight: bold;
}

input {
  width: 400px;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}

input,
textarea {
    width: 400px;
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
    box-sizing: border-box;
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
</style>
