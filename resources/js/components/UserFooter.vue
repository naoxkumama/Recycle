<template>
    <ButtonColors :buttons="buttons" @navigate="goPage" />
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import ButtonColors from '../components/buttonColors.vue'

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
</script>