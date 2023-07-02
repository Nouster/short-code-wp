let flashMessage = document.querySelector(
	"p.flashMessagesuccess, p.flashMessageerror, p.flashMessagepartialError"
);

flashMessage.onclick = function () {
	flashMessage.remove();
};

var currentDate = new Date();

var currentYear = currentDate.getFullYear();

document.querySelector("input[number]").max = currentYear;
