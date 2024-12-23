import "./bootstrap";

import Alpine from "alpinejs";
import focus from "@alpinejs/focus";

import Swal from "sweetalert2";

window.Swal = Swal;
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
