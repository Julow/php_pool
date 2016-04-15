
function setCookie(cname, cvalue, exdays)
{
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname)
{
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++)
	{
		var c = ca[i];
		while (c.charAt(0)==' ')
			c = c.substring(1);
		if (c.indexOf(name) == 0)
			return c.substring(name.length,c.length);
	}
	return "";
}

var TODO = (function()
{
	var COOKIE_NAME = "TODO_LIST";

	var todo_list = {};

	var todo_id = 0;

	function addTodo(str)
	{
		var id = todo_id++;
		todo_list[id] = str;
		$("#ft_list").prepend($("<div></div>").text(str).on("click", function()
			{
				if (confirm("Souhaitez vous supprimer ce to do ? FDP"))
				{
					delete todo_list[id];
					saveTodoList();
					$(this).remove();
				}
			}));
	}

	function newTodo()
	{
		var todo = prompt("Add a ToDo to the list");
		if (todo == null || todo.length == 0)
			return ;
		addTodo(todo);
		saveTodoList();
	}

	function saveTodoList()
	{
		var cookie = "";
		for (var key in todo_list)
			cookie += (cookie.length ? ":" : "") + encodeURIComponent(todo_list[key]);
		setCookie(COOKIE_NAME, cookie, 7);
	}

	function loadTodoList()
	{
		var todos = getCookie(COOKIE_NAME).split(":");
		for (var t in todos)
			if (todos[t].length > 0)
				addTodo(decodeURIComponent(todos[t]));
	}

	return {
		"new": newTodo,
		"load": loadTodoList
	};

})();

$(document).ready(function()
{
	TODO.load();
	$("#new").on("click", function()
	{
		TODO.new();
	});
});
