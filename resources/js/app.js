import "./bootstrap";
// Importa FontAwesome
import { library, dom } from "@fortawesome/fontawesome-svg-core";
import { faUserSecret } from "@fortawesome/free-solid-svg-icons";
import { faTwitter } from "@fortawesome/free-brands-svg-icons";

import Swal from "sweetalert2";
import Alpine from "alpinejs";

// Añade íconos a la librería
library.add(faUserSecret, faTwitter);
// Ejecuta para reemplazar todos los <i> en tu HTML con el SVG correspondiente
dom.watch();

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();
