<template>
  <div class="common">
    <AdminHeader />

    <main>
        <h1>管理者ログイン</h1>
        <form @submit.prevent="submitButton">

          <div class="form-group">
            <label for="email">メールアドレス</label>
            <input v-model="form.email" id="email" type="email" required :class="{ 'is-invalid' : form.errors.email}"/>
            <p v-if="form.errors.email" class="error-msg">
              {{ form.errors.email }}
            </p>

          </div>

          <div class="form-group password-wrapper">
            <label for="password">パスワード</label>

            <div class="password-field">
              <input v-model="form.password"
                id="password"
                :type="showPassword ? 'text' : 'password'"
                required :class="{ 'is-invalid': form.errors.password }"/>

              <button type="button" class="toggle-btn" @click="togglePassword" >

                <i v-if="!showPassword" class="fas fa-eye"></i>
                <i v-else class="fas fa-eye-slash"></i>
              </button>
            </div>

            <p v-if="form.errors.password" class="error-msg">
              {{ form.errors.password }}
            </p>
            <p v-if="form.errors.message" class="error-msg">
              {{ form.errors.message }}
            </p>
          </div>

          <button type="submit">送信</button>
        </form>

    </main>
    <ButtonColors :buttons="buttons" @navigate="goPage" />
    <CommonFooter />
  </div>
</template>

<script setup lang="ts">
import { useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue'
import ButtonColors from '../../components/buttonColors.vue'
import AdminHeader from '../../components/AdminHeader.vue'
import CommonFooter from'../../components/CommonFooter.vue'

const form = useForm({
  email: '',
  password: '',
})

const submitted = ref(false)
const showPassword = ref(false)

const togglePassword = () => {
  showPassword.value = !showPassword.value
}

const submitButton = () => {
  form.clearErrors()

  form.post('/admin/Login', {
    onFinish: () => {
      if (form.hasErrors) {
        console.log('ログイン失敗', form.errors)
      } else {
        console.log('ログイン成功')
      }
    },
  })
}

const buttons = [
  { label: "ユーザーTOPへ戻る", path: "/user/home", class: "home-btn" },
]

const goPage = (path: string) => {
  router.visit(path)
}
</script>

<style scoped>
.common {
  text-align: center;
  margin-top: 50px;
}

.form-group {
  margin-bottom: 1.2rem;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center
}

.password-wrapper {
  width: 100%;
  display: flex;
  justify-content: center; /* 中央寄せ */
}

.password-field {
  position: relative;
  width: 300px; /* input の表示幅をここで揃える */
}

.password-field input {
  width: 100%;
  padding: 0.5rem;
  padding-right: 2.6rem; /* アイコン分の余白 */
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 1rem;
  box-sizing: border-box;
}

.toggle-btn {
  position: absolute;
  right: 8px;
  top: 50%;
  transform: translateY(-50%);
  background: transparent;      /* 青背景を打ち消す */
  border: none;
  padding: 0.15rem;
  cursor: pointer;
  font-size: 1.05rem;
  color: #666;
  z-index: 2;
}

.toggle-btn:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(52,152,219,0.15);
}

.submit-btn {
  padding: 0.6rem 1.2rem;
  border: none;
  border-radius: 6px;
  background: #3498db;
  color: white;
  font-size: 1rem;
  cursor: pointer;
}

label {
  font-weight: bold;
  margin-bottom: 0.5rem;
  text-align: left;   /* ← 左寄せ */
  display: block;
}

input,
textarea {
  width: 300px;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 1rem;
  box-sizing: border-box;
}

.form {
  max-width: 350px;
  margin: 0 auto; /* 中央寄せ */
  text-align: left;

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

.error-msg {
  width: 300px;
  margin: 0.35rem auto 0;
  text-align: left;
  color: #e74c3c;
  font-size: 0.9rem;
}

.is-invalid {
  border-color: #e74c3c !important;
  box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.12);
}
</style>
