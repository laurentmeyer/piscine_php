var myArray;

$(document).ready( function () {

	if (document.cookie !== "") {
		myArray = JSON.parse(document.cookie);
		for (var content in myArray) {
			$("#ft_list").append('<div>' + myArray[content] + '</div>');
		}
	} else {
		myArray = new Array;
	}

	$("#new", this).click (function () {
		var content = prompt('vas-y balance', 'toudou');
		$("#ft_list").prepend('<div>' + content + '</div>');
		$("#content").val("");
		myArray.unshift(content);
		document.cookie = JSON.stringify(myArray);
	});

	$("#ft_list").on('click', 'div', (function () {
		var index;
		
		if (confirm("T'es sur mon gars?")) {
			index = $("#ft_list div").index(this);
			myArray.splice(index, 1);
			document.cookie = JSON.stringify(myArray);
			$(this).remove();
		}
	}) );

});
