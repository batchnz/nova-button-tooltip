Nova.booting((Vue, router, store) => {
  Vue.component('index-actions', require('./components/IndexField'))
  Vue.component('detail-actions', require('./components/DetailField'))
  Vue.component('form-actions', require('./components/FormField'))
})
