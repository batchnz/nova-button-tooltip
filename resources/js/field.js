import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-button-tooltip', IndexField)
  app.component('detail-button-tooltip', DetailField)
  app.component('form-button-tooltip', FormField)
})
