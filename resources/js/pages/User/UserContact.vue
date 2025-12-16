<template>
    <div class="common">
    <UserHeader />
    <CommonLayout
        leftImage="/images/bear.jpg"
        rightImage="/images/truck.jpg"
    >

    <main>
        <section class="contact">
        <h1>お問い合わせページ 📩</h1>
        <form @submit.prevent="submitButton">
            <div class="form-group">
                <label for="name">お名前</label>
                <input v-model="form.name" type="text" id="name" required />
            </div>

            <div class="form-group">
                <label for="phone">電話番号</label>
                <input v-model="form.phone" type="phone" id="phone" required />
            </div>

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input v-model="form.email" type="email" id="email" required />
            </div>

            <div class="form-group">
                <label for="message">本文</label>
                <textarea v-model="form.message" id="message" rows="7" required></textarea>
            </div>

            <button type="button" @click="submitButton">送信</button>
        </form>

        </section>
    </main>
    <ButtonColors :buttons="buttons" @navigate="goPage" />
    </CommonLayout>
    <UserFooter />
    <CommonFooter />
    </div>
</template>

<script setup lang="ts">
import { useForm, router } from '@inertiajs/vue3';
import ButtonColors from '../../components/buttonColors.vue'
import UserHeader from '../../components/UserHeader.vue'
import UserFooter from '../../components/UserFooter.vue'
import CommonFooter from'../../components/CommonFooter.vue'
import CommonLayout from'../../components/CommonLayout.vue'

const form = useForm({
    name: '',
    phone: '',
    email: '',
    message: ''
})

const submitButton = () => {
    form.post('/user/UserContact', {
    onSuccess: () => {
        form.reset()
        router.visit('/user/UserContactComplete')
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

.form-group {
    margin-bottom: 1.2rem;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center
}

label {
    font-weight: bold;
    margin-bottom: 0.5rem;
    text-align: left;   /* ← 左寄せ */
    display: block;
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
</style>