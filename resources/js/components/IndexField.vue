<template>
  <div class="inline-flex items-center" @click="handleClick">
    <span class="inline-flex" v-for="button of field.buttons">
      <a
        class="cursor-pointer text-70 hover:text-primary mr-3 inline-flex items-center has-tooltlip"
        :href="button.url"
        v-tooltip="button.tooltip"
        @click="handleLinkClick(button)"
      >
        <span class="block" v-html="button.icon" v-if="!button.isLoading"></span>
        <span class="block w-4" v-if="button.showLoading && button.isLoading">
           <LoaderSpinner/>
        </span>
      </a>
    </span>
  </div>
</template>

<script>
import LoaderSpinner from "./LoaderSpinner.vue";

export default {
  components: {LoaderSpinner},
  props: ['resourceName', 'field'],

  computed: {
    fieldValue() {
      return this.field.displayedAs || this.field.value
    },
  },

  methods: {
    handleClick(e) {
      e.stopPropagation();
    },
    handleLinkClick(button) {
      if (button.showLoading) {
        button.isLoading = true;
      }
    }
  },
}
</script>
