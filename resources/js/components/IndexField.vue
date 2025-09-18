<template>
  <div class="inline-flex items-center" @click="handleClick">
    <span class="inline-flex" v-for="button of field.buttons">
      <a
        class="cursor-pointer text-70 hover:text-primary mr-3 inline-flex items-center has-tooltlip"
        :href="button.modalConfig ? '#' : button.url"
        v-tooltip="button.tooltip"
        @click="handleLinkClick(button, $event)"
      >
        <span class="block" v-html="button.icon" v-if="!button.isLoading"></span>
        <span class="block w-4" v-if="button.showLoading && button.isLoading">
           <LoaderSpinner/>
        </span>
      </a>
    </span>

    <!-- Confirmation Modal -->
    <ConfirmationModal
      :show="showModal"
      :config="modalConfig"
      :confirming="confirmingAction"
      @modal-close="closeModal"
      @cancel="closeModal"
      @confirm="confirmAction"
    />
  </div>
</template>

<script>
import LoaderSpinner from "./LoaderSpinner.vue";
import ConfirmationModal from "./ConfirmationModal.vue";

export default {
  components: {LoaderSpinner, ConfirmationModal},
  props: ['resourceName', 'field'],

  data() {
    return {
      showModal: false,
      modalConfig: {},
      currentButton: null,
      confirmingAction: false,
    };
  },

  computed: {
    fieldValue() {
      return this.field.displayedAs || this.field.value
    },
  },

  methods: {
    handleClick(e) {
      e.stopPropagation();
    },

    handleLinkClick(button, event) {
      if (button.modalConfig) {
        event?.preventDefault();
        this.showConfirmationModal(button);
        return;
      }

      if (button.showLoading) {
        button.isLoading = true;
      }
    },

    showConfirmationModal(button) {
      this.currentButton = button;
      this.modalConfig = button.modalConfig;
      this.showModal = true;
    },

    closeModal() {
      this.showModal = false;
      this.currentButton = null;
      this.modalConfig = {};
      this.confirmingAction = false;
    },

    async confirmAction() {
      if (!this.currentButton) return;

      this.confirmingAction = true;

      try {
        if (this.currentButton.showLoading) {
          this.currentButton.isLoading = true;
        }

        // Navigate to the URL
        if (this.currentButton.url) {
          window.location.href = this.currentButton.url;
        }
      } catch (error) {
        console.error('Error confirming action:', error);
        if (this.currentButton.showLoading) {
          this.currentButton.isLoading = false;
        }
      }

      this.closeModal();
    }
  },
}
</script>
