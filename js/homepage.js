console.log("You Rock!😎");

document.addEventListener("DOMContentLoaded", init);

function init() {
	const txtElement = document.querySelector(".typing");
	const words = JSON.parse(txtElement.getAttribute("data-words"));
	const wait = txtElement.getAttribute("data-wait");

	new typewriter(txtElement, words, wait);
}

const typewriter = function (txtElement, words, wait = 3000) {
	this.txtElement = txtElement;
	this.words = words;
	this.wait = parseInt(wait);
	this.txt = "";
	this.wordIndex = 0;
	this.type();
	this.isDeleting = false;
};

typewriter.prototype.type = function () {
	const index = this.wordIndex % this.words.length;
	const currentWord = this.words[index];
	if (this.isDeleting) {
		this.txt = currentWord.substring(0, this.txt.length - 1);
	} else {
		this.txt = currentWord.substring(0, this.txt.length + 1);
	}

	this.txtElement.innerHTML = `<span class="cursor">${this.txt}</span>`;

	let typespeed = 200;

	if (this.isDeleting) {
		typespeed = 50;
	}

	if (this.txt === currentWord && !this.isDeleting) {
		typespeed = this.wait;
		this.isDeleting = true;
	} else if (this.isDeleting && this.txt === "") {
		this.isDeleting = false;
		this.wordIndex++;
		typespeed = 500;
	}

	setTimeout(() => this.type(), typespeed);
};
