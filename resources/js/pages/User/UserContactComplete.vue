<template>
    <div class="common">
        <UserHeader />
        <CommonLayout
            leftImage="/images/bear.jpg"
            rightImage="/images/truck.jpg"
        >
            <main>
                <h1>お問い合わせ完了 ✅</h1>
                <p>お問い合わせありがとうございます。折り返しメールにてご連絡させていただきます。</p>
                <p></p>
                <button @click="goPage('/user/UserContact')">お問い合わせページへ戻る</button>
                <button @click="goPage('/user/home')">ホームへ戻る</button>
            </main>
        </CommonLayout>
    </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import UserHeader from '../../components/UserHeader.vue'
import CommonLayout from '../../components/CommonLayout.vue'

const goPage = (path: string) => {
    router.visit(path)
}
</script>

<style scoped>

.common {
    text-align: center;
    margin-top: 10px;
}

p {
    margin-bottom: 5rem;
}

button {
    display: block;
    margin: 1rem auto;
    padding: 0.6rem 1.2rem;
    border: none;
    border-radius: 6px;
    background: #3498db;
    color: white;
    font-size: 1rem;
    cursor: pointer;
}
</style>