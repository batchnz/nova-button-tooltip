<template>
  <div class="inline-flex items-center">
    <span class="inline-flex" v-for="button of field.buttons">
      <a
        class="cursor-pointer text-70 hover:text-primary mr-3 inline-flex items-center has-tooltlip"
        :href="button.url"
        v-tooltip="button.tooltip"
        v-html="button.icon"
      >
      </a>
    </span>
  </div>
</template>

<script>
export default {
  props: ['resourceName', 'field'],

  computed: {
    fieldValue() {
      return this.field.displayedAs || this.field.value
    },
  }
}
</script>
