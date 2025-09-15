<template>
  <PanelItem :index="index" :field="field">
    <template #value>
      <div class="inline-flex items-center">
        <span class="inline-flex" v-for="button of field.buttons">
          <a
            class="text-70 hover:text-primary has-tooltlip mr-3 inline-flex cursor-pointer items-center"
            :href="button.modalConfig ? '#' : button.url"
            v-tooltip="button.tooltip"
            @click="handleClick(button, $event)"
          >
            <span
              class="block"
              v-html="button.icon"
              v-if="!button.isLoading"
            ></span>
            <span
              class="block w-4"
              v-if="button.showLoading && button.isLoading"
            >
              <LoaderSpinner />
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
          <div
            class="dark:bg-gray-800 space-y-6 overflow-hidden rounded-lg bg-white shadow-lg"
          >
            <div class="space-y-6">
              <h3
                class="border-gray-100 dark:border-gray-700 border-b px-8 py-4 text-xs font-bold uppercase tracking-wide"
                v-text="modalConfig.title || 'Confirm Action'"
              ></h3>
              <p
                class="px-8"
                v-text="
                  modalConfig.message || 'Are you sure you want to proceed?'
                "
              ></p>
            </div>

            <div class="bg-gray-100 dark:bg-gray-700 flex px-6 py-3">
              <div class="ml-auto flex items-center">
                <button
                  type="button"
                  @click="closeModal"
                  class="ring-primary-200 dark:ring-gray-600 text-gray-500 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-300 relative ml-auto mr-3 inline-flex h-9 cursor-pointer appearance-none items-center justify-center rounded border border-transparent px-3 text-left text-sm font-bold focus:outline-none focus:ring disabled:cursor-not-allowed"
                >
                  <span class="flex items-center gap-1">
                    {{ modalConfig.cancelText || 'Cancel' }}
                  </span>
                </button>

                <button
                  type="button"
                  @click="confirmAction"
                  :disabled="confirmingAction"
                  class="ring-primary-200 dark:ring-gray-600 bg-primary-500 border-primary-500 hover:bg-primary-400 hover:border-primary-400 dark:text-gray-900 relative inline-flex h-9 cursor-pointer appearance-none items-center justify-center rounded border px-3 text-left text-sm font-bold text-white shadow focus:outline-none focus:ring disabled:cursor-not-allowed"
                >
                  <span class="flex items-center gap-1">
                    <svg
                      v-if="confirmingAction"
                      class="-ml-1 mr-1 h-3 w-3 animate-spin text-current"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                    >
                      <circle
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                      ></circle>
                      <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                      ></path>
                    </svg>
                    {{
                      confirmingAction
                        ? 'Processing...'
                        : modalConfig.confirmText || 'Continue'
                    }}
                  </span>
                </button>
              </div>
            </div>
          </div>
        </Modal>
      </div>
    </template>
  </PanelItem>
</template>

<script>
import LoaderSpinner from './LoaderSpinner.vue';

export default {
  components: { LoaderSpinner },
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],

  data() {
    return {
      showModal: false,
      modalConfig: {},
      currentButton: null,
      confirmingAction: false,
    };
  },

  methods: {
    handleClick(button, event) {
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
    },
  },
};
</script>
