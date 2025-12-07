declare module 'ziggy-js' {
    interface Ziggy {
        url: string
        port?: string
        defaults?: Record<string, any>
        routes: Record<string, { uri: string, methods: string[] }>
    }

    interface RouteOptions {
        params?: Record<string, any>
        absolute?: boolean
        root?: string
    }

    export default function route(name: string, params?: Record<string, any>, absolute?: boolean, config?: Ziggy): string;
}
