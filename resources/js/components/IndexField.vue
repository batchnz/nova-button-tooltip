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
    <Modal
      v-if="showModal"
      @modal-close="closeModal"
      :show="showModal"
      role="alertdialog"
      size="md"
    >
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden space-y-6">
        <div class="space-y-6">
          <h3 class="uppercase tracking-wide font-bold text-xs border-b border-gray-100 dark:border-gray-700 py-4 px-8" v-text="modalConfig.title || 'Confirm Action'"></h3>
          <p class="px-8 text-gray-700 dark:text-gray-300" v-text="modalConfig.message || 'Are you sure you want to proceed?'"></p>
        </div>

        <div class="bg-gray-100 dark:bg-gray-700 px-6 py-3 flex">
          <div class="flex items-center ml-auto">
            <button
              type="button"
              @click="closeModal"
              class="border text-left appearance-none cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 relative disabled:cursor-not-allowed inline-flex items-center justify-center border-transparent h-9 px-3 text-gray-500 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-300 ml-auto mr-3"
            >
              <span class="flex items-center gap-1">
                {{ modalConfig.cancelText || 'Cancel' }}
              </span>
            </button>

            <button
              type="button"
              @click="confirmAction"
              :disabled="confirmingAction"
              class="border text-left appearance-none cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 relative disabled:cursor-not-allowed inline-flex items-center justify-center shadow h-9 px-3 bg-primary-500 border-primary-500 hover:bg-primary-400 hover:border-primary-400 text-white dark:text-gray-900"
            >
              <span class="flex items-center gap-1">
                <svg v-if="confirmingAction" class="animate-spin -ml-1 mr-1 h-3 w-3 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ confirmingAction ? 'Processing...' : (modalConfig.confirmText || 'Continue') }}
              </span>
            </button>
          </div>
        </div>
      </div>
    </Modal>
  </div>
</template>

<script>
import LoaderSpinner from "./LoaderSpinner.vue";

export default {
  components: {LoaderSpinner},
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
