import { createVNode, render } from "vue";
import ConfirmDialog from "@/Components/ConfirmDialog.vue";

const mountNode = document.createElement('div')
document.body.appendChild(mountNode)

let instance

export default {
    install(app) {
        const container = createVNode(ConfirmDialog)

        render(container, mountNode)
        instance = container.component

        app.config.globalProperties.$confirm = instance.proxy.openDialog
    }
}