let flashMessage = document.querySelector(
	"p.flashMessagesuccess, p.flashMessageerror, p.flashMessagepartialError"
);

flashMessage.onclick = function () {
	flashMessage.remove();
};
