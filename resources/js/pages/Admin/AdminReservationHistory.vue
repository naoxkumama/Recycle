<template>
  <div class="common">
    <AdminHeader />
    <h1>仮予約履歴 🖊</h1>

    <SearchBox
      :filters="page.props.filters"
      searchUrl="/admin/AdminReservation/History"
      :groups="[
        {
          label: '基本情報',
          fields: [
            { key: 'name', label: '名前', type: 'text' },
            { key: 'phone', label: '電話番号', type: 'text'},
            { key: 'email', label: 'メールアドレス', type: 'text'},
            { key: 'message', label: '備考', type: 'text' }
          ],
        },
        {
          label: '日付条件',
          fields: [
          { key: 'first',  label: '第一希望', type: 'dateRange'},
          { key: 'created', label: '作成日', type: 'dateRange'},
          ],
        },
      ]"
      />

    <Table
    :data="reservations"
    :columns="columns"
    emptyMessage="仮予約はまだありません。"
    />

    <Pagination :pagination="page.props.reservations" />
    <ButtonColors :buttons="buttons" @navigate="goPage" />
    <CommonFooter />
  </div>
</template>

<script setup lang="ts">
import { usePage, router } from '@inertiajs/vue3'
import { computed } from 'vue'
import ButtonColors from '../../components/buttonColors.vue'
import AdminHeader from '../../components/AdminHeader.vue'
import CommonFooter from'../../components/CommonFooter.vue'
import Pagination from '../../components/Pagination.vue'
import Table from '../../components/Table.vue'
import SearchBox from '../../components/SearchBox.vue'

const page = usePage()

const reservations = computed(() =>page.props.reservations.data || [])

const columns = [
  {label: 'ID', field: 'id', sortable: true },
  {label: '名前', field: 'name', sortable: false },
  {label: '電話番号', field: 'phone', sortable: false },
  {label: '第一希望', field: 'first', sortable: true },
  {label: '第二希望', field: 'second', sortable: true },
  {label: '第三希望', field: 'third', sortable: true },
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
h1 {
  margin : 10px 0 15px;
  font-size: 1.4rem;
}
.common{
text-align:center;
margin: 10px auto;
max-width: 900px;
padding: 1rem;
}

.AdminHeader {
  margin-bottom: 10px;
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
