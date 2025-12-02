import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import '@fortawesome/fontawesome-free/css/all.min.css';
import { router } from '@inertiajs/vue3'

// 環境ごとのベースURLを設定
// 本番やステージングでは .env で管理するのが理想
const BASE_URL = import.meta.env.VITE_APP_BASE_URL || ''

const pages = import.meta.glob('./pages/**/*.vue', { eager: true })

createInertiaApp({
  resolve: name => {
    const key = `./pages/${name}.vue`
    let page = pages[key]
    if (!page) {
      const fallback = Object.keys(pages).find(k => k.endsWith(`/${name}.vue`))
      page = fallback ? pages[fallback] : undefined
    }
    if (!page) throw new Error(`Page not found: ${name}`)
    return page.default
  },
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) })
      .use(plugin)

    // グローバルメソッドを定義
    app.config.globalProperties.$goPage = (path) => {
      // 絶対URLでInertiaを呼ぶ
      const url = path.startsWith('http') ? path : `${BASE_URL}${path}`
      router.visit(url)
}

    app.mount(el)
  },
})
