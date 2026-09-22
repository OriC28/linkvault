import Alpine from "alpinejs";
import Tagify from "@yaireo/tagify";
import Notify from "simple-notify";

window.copyToClipboard = function (url) {
    navigator.clipboard
        .writeText(url)
        .then(() => {
            new Notify({
                status: "success",
                title: "Copiar URL.",
                text: "Url copiada exitosamente.",
            });
        })
        .catch((err) => {
            console.error(err);
            new Notify({
                status: "error",
                title: "Copiar URL.",
                text: "No fue posible copiar la url de este marcador.",
            });
        });
};
window.Tagify = Tagify;
window.Notify = Notify;
window.Alpine = Alpine;
Alpine.start();
