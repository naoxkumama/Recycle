import { ref } from 'vue';
import { router} from '@inertiajs/vue3'

export function useServerSortable(initialField = 'created_at', initialOrder: 'asc' | 'desc') {
    const sort = ref<{ field: string; order: 'asc' | 'desc'}>
    ({
        field: initialField,
        order: initialOrder,
    })

    const sortData = (field: string) => {
        if (sort.value.field === field) {
            sort.value.order = sort.value.order ==='asc' ? 'desc' : 'asc'
        } else {
            sort.value.field = field
            sort.value.order = 'asc'
        }
        router.get('/admin/AdminReservationHistory', {
            sort_field: sort.value.field,
            sort_order: sort.value.order
        })
    }
    return { sort, sortData };
}