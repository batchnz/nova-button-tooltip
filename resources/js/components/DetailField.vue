<template>
  <panel-item :field="field">
    <template slot="value">
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
  </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
}
</script>
