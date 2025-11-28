<template>
  <div class="common">
    <AdminHeader />

      <h1>お問い合わせ履歴 🖊</h1>

    <SearchBox
      :filters="page.props.filters"
      searchUrl="/admin/AdminContact/History"
      :groups="[
        {
          label: '基本情報',
          fields: [
            { key: 'name', label: '名前', type: 'text' },
            { key: 'email', label: 'メールアドレス', type: 'text' },
            { key: 'message', label: '本文', type: 'text' }
          ],
        },
        {
          label: '日付条件',
          fields: [
          { key: 'created', label: '作成日', type: 'dateRange'},
          ],
        },
      ]"
    />

    <Table
    :data="contacts"
    :columns="columns"
    emptyMessage="お問い合わせはまだありません。"
    />

    <Pagination :pagination="page.props.contacts" />
    <ButtonColors :buttons="buttons" @navigate="goPage" />
  </div>
</template>

<script setup lang="ts">
import { usePage, router } from '@inertiajs/vue3';
import { computed } from 'vue'
import ButtonColors from '../../components/buttonColors.vue'
import AdminHeader from '../../components/AdminHeader.vue'
import Pagination from '../../components/Pagination.vue'
import Table from '../../components/Table.vue'
import SearchBox from '../../components/SearchBox.vue'

const page = usePage()

const contacts = computed(() =>page.props.contacts.data || [])

const columns = [
  {label: 'ID', field: 'id', sortable: true },
  {label: '名前', field: 'name', sortable: false },
  {label: 'メールアドレス', field: 'email', sortable: false },
  {label: '本文', field: 'message', sortable: false },
  {label: '作成日', field: 'created_at', type: 'date', sortable: true },
]

const buttons = [
  { label: "管理画面TOPへ戻る", path: "/admin/AdminHome", class: "home-btn" },
]

const goPage = (path: string) => {
  router.visit(path)
}
</script>

<style scoped>
.common{
text-align:center;
margin: 10px auto;
max-width: 900px;
padding: 1.5rem;
}

button {
  padding: 0.4rem 0.8rem;
  border-radius: 6px;
  font-size: 1rem;
  cursor: pointer;
  transition: background 0.3s;
}

button:hover {
  background-color: #2980b9;
}

.home-btn {
  background-color: #2ecc71;
}

.home-btn:hover {
  background-color: #27ae60;
}

.admin-main {
  padding: 2rem;
}

</style>