"use strict";

// Get toast element
const toastEl = document.getElementById("toast");
const overlayEl = document.getElementById("overlay-toast");
const toastCloseButtonEl = document.getElementById("toast-close-btn");

export function forceHideToast() {
  toastEl.children[0].innerHTML = "";
  toastEl.classList.add("hidden");
  overlayEl.classList.add("hidden");

  toastEl.classList.remove("toast-green");
  toastEl.classList.remove("toast-blue");
  toastEl.classList.remove("toast-red");
}

export function showSuccessToast(msg) {
  toastEl.children[0].innerHTML = msg;
  toastEl.classList.remove("hidden");
  overlayEl.classList.remove("hidden");
  toastEl.classList.add("toast-green");

  setTimeout(() => {
    toastEl.classList.add("hidden");
    overlayEl.classList.add("hidden");
    toastEl.classList.remove("toast-green");
  }, 5 * 1000);
}

export function showErrorToast(msg) {
  toastEl.children[0].innerHTML = msg;
  toastEl.classList.remove("hidden");
  overlayEl.classList.remove("hidden");
  toastEl.classList.add("toast-red");

  setTimeout(() => {
    toastEl.classList.add("hidden");
    overlayEl.classList.add("hidden");
    toastEl.classList.remove("toast-red");
  }, 5 * 1000);
}

export function showInformationToast(msg) {
  toastEl.children[0].innerHTML = msg;
  toastEl.classList.remove("hidden");
  overlayEl.classList.remove("hidden");
  toastEl.classList.add("toast-blue");

  setTimeout(() => {
    toastEl.classList.add("hidden");
    overlayEl.classList.add("hidden");
    toastEl.classList.remove("toast-blue");
  }, 5 * 1000);
}

toastCloseButtonEl.addEventListener("click", (e) => {
  e.preventDefault();

  forceHideToast();
});

overlayEl.addEventListener("click", (e) => {
  e.preventDefault();

  forceHideToast();
});
