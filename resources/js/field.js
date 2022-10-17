Nova.booting((Vue, router, store) => {
  Vue.component('index-button-tooltip', require('./components/IndexField').default)
  Vue.component('detail-button-tooltip', require('./components/DetailField').default)
  Vue.component('form-button-tooltip', require('./components/FormField').default)
})
