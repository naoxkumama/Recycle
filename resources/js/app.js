import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import '@fortawesome/fontawesome-free/css/all.min.css';


const pages = import.meta.glob('./pages/**/*.vue', { eager: true })

createInertiaApp({
  resolve: name => {
    const key = `./pages/${name}.vue`
    // まずキーで探す
    let page = pages[key]
    // 見つからなければ末尾一致で探す（サブフォルダやパス表記の違いに柔軟に対応）
    if (!page) {
      const fallback = Object.keys(pages).find(k => k.endsWith(`/${name}.vue`))
      page = fallback ? pages[fallback] : undefined
    }
    if (!page) {
      throw new Error(`Page not found: ${name}`)
    }
    // eager のときは Module.default にコンポーネントが入っている

    return page.default
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})
