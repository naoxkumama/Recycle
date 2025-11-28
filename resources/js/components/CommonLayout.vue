<template>
    <div class="common">
        <!-- 左右の固定画像 -->
        <img :src="leftImage" alt="左側の画像" class="side-image left"/>
        <img :src="rightImage" alt="右側の画像" class="side-image right"/>

        <!-- 中央コンテンツ -->
        <main class="main-content">
            <slot></slot>
        </main>
    </div>
</template>

<script setup lang="ts">
defineProps<{leftImage: string; rightImage: string;}>()
</script>

<style scoped>
.common{
    text-align:center;
}

.main-content {
    padding-left: 270px;
    padding-right: 270px;
}

.side-image{
    position: fixed;
    top: 80px;
    transform: none;
    width: 250px;
    height :calc(100vh - 80px);
    object-fit :cover;
    object-position: center;
    z-index: 5;
}

.side-image.left {
    left: 0;
}

.side-image.right {
    right: 0;
}
</style>