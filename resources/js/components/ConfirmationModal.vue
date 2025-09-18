<template>
  <Modal
    v-if="show"
    @modal-close="$emit('modal-close')"
    :show="show"
    role="alertdialog"
    size="md"
  >
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden space-y-6">
      <div class="space-y-6">
        <h3 
          class="uppercase tracking-wide font-bold text-xs border-b border-gray-100 dark:border-gray-700 py-4 px-8" 
          v-text="config.title || 'Confirm Action'"
        ></h3>
        <p 
          class="px-8" 
          v-text="config.message || 'Are you sure you want to proceed?'"
        ></p>
      </div>

      <div class="bg-gray-100 dark:bg-gray-700 px-6 py-3 flex">
        <div class="flex items-center ml-auto">
          <button
            type="button"
            @click="$emit('cancel')"
            class="border text-left appearance-none cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 relative disabled:cursor-not-allowed inline-flex items-center justify-center border-transparent h-9 px-3 text-gray-500 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-300 ml-auto mr-3"
          >
            <span class="flex items-center gap-1">
              {{ config.cancelText || 'Cancel' }}
            </span>
          </button>

          <button
            type="button"
            @click="$emit('confirm')"
            :disabled="confirming"
            class="border text-left appearance-none cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 relative disabled:cursor-not-allowed inline-flex items-center justify-center shadow h-9 px-3 bg-primary-500 border-primary-500 hover:bg-primary-400 hover:border-primary-400 text-white dark:text-gray-900"
          >
            <span class="flex items-center gap-1">
              <svg 
                v-if="confirming" 
                class="animate-spin -ml-1 mr-1 h-3 w-3 text-current" 
                xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 24 24"
              >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ confirming ? 'Processing...' : (config.confirmText || 'Continue') }}
            </span>
          </button>
        </div>
      </div>
    </div>
  </Modal>
</template>

<script>
export default {
  name: 'ConfirmationModal',
  props: {
    show: {
      type: Boolean,
      default: false
    },
    config: {
      type: Object,
      default: () => ({})
    },
    confirming: {
      type: Boolean,
      default: false
    }
  },
  emits: ['modal-close', 'cancel', 'confirm']
}
</script>
