<template>
  <svg class="loader-spinner w-full h-full fill-current" viewBox="0 0 32 32">
    <circle
      class="loader-spinner__path stroke-current"
      cx="16"
      cy="16"
      r="14"
      fill="none"
      stroke-width="4"
    ></circle>
  </svg>
</template>

<style scoped>
.loader-spinner {
  animation: animateSpinner 2s linear infinite;
}

.loader-spinner__path {
  stroke-linecap: butt;
  animation: animateSpinnerPath 1.5s ease-in-out infinite;
}

@keyframes animateSpinner {
  100% {
    transform: rotate(360deg);
  }
}

@keyframes animateSpinnerPath {
  0% {
    stroke-dasharray: 1, 150;
    stroke-dashoffset: 0;
  }
  50% {
    stroke-dasharray: 90, 150;
    stroke-dashoffset: -40;
  }
  100% {
    stroke-dasharray: 90, 150;
    stroke-dashoffset: -124;
  }
}
</style>
