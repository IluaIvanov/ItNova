export default {
	install: (app) => {
		app.provide("$toast", app.config.globalProperties.$toast)
	}
}
