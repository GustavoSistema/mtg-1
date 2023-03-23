import Alpine from "alpinejs";
import flatpickr from "flatpickr";
import Quill from "quill";
import * as FilePond from "filepond";
import { createPopper } from "@popperjs/core";
import focus from "@alpinejs/focus";

Alpine.plugin(focus);

window.flatpickr = flatpickr;
window.FilePond = FilePond;
window.Quill = Quill;
window.createPopper = createPopper;
window.Alpine = Alpine;

window.Alpine.start();

// Create a FilePond instance
