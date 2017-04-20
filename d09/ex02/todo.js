var myArray;

function removeToDo() {
		var index = myArray.length - 1;
		var elem = this;

		while ((elem = elem.previousSibling)) {
			index--;
		}
		index = myArray.length - 1 - index;

		if (confirm("T'es sur mon gars?")) {
			this.parentNode.removeChild(this);
			myArray.splice(index, 1);
			document.cookie = JSON.stringify(myArray);
		}
}

function addToDo(content, place) {
	var parentDiv = document.getElementById('ft_list');
	var prevNode = parentDiv.childNodes[0];
	var newNode = document.createElement("div");
	var textnode = document.createTextNode(content);

	newNode.appendChild(textnode);
	newNode.addEventListener("click", removeToDo);

	if (prevNode == null) {
		prevNode = parentDiv.appendChild(newNode);
	} else {
		prevNode = (place == 'top') ? parentDiv.insertBefore(newNode, prevNode) : parentDiv.appendChild(newNode);
	}
}


if (document.cookie !== "") {
	myArray = JSON.parse(document.cookie);
	for (var content in myArray) {
		addToDo(myArray[content], 'bottom');
	}
} else {
	myArray = new Array;
}


document.getElementById('new').onclick = function () {
	var content = prompt("Renseignez le prochain toudou", "Nouveau toudou");

	addToDo(content, 'top');
	myArray.unshift(content);
	document.cookie = JSON.stringify(myArray);
};
