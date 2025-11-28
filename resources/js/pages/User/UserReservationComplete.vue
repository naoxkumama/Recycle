<template>
    <div class="common">
        <UserHeader />
        <CommonLayout
            leftImage="/images/bear.jpg"
            rightImage="/images/truck.jpg"
        >
            <main>
                <h1>仮予約完了 ✅</h1>
                <p>仮予約ありがとうございます。折り返しのお電話をもって予約の確定とさせていただきます。</p>
                <button @click="goPage('/user/UserReservation')">仮予約ページへ戻る</button>
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