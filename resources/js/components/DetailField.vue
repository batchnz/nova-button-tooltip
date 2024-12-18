<template>
  <PanelItem :index="index" :field="field">
    <template #value>
      <div class="inline-flex items-center">
        <span class="inline-flex" v-for="button of field.buttons">
          <a
            class="cursor-pointer text-70 hover:text-primary mr-3 inline-flex items-center has-tooltlip"
            :href="button.url"
            v-tooltip="button.tooltip"
            @click="handleClick(button)"
          >
            <span class="block" v-html="button.icon" v-if="!button.isLoading"></span>
            <span class="block w-4" v-if="button.showLoading && button.isLoading">
               <LoaderSpinner/>
            </span>
          </a>
        </span>
      </div>
    </template>
  </PanelItem>
</template>

<script>
import LoaderSpinner from "./LoaderSpinner.vue";

export default {
  components: {LoaderSpinner},
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
  methods: {
    handleClick(button) {
      if (button.showLoading) {
        button.isLoading = true;
      }
    }
  }
}
</script>
