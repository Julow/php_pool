
var TODO = (function()
{
	var todo_list = {};

	function addTodo(id, str)
	{
		todo_list[id] = str;
		$("#ft_list").prepend($("<div></div>").text(str).on("click", function()
			{
				if (confirm("Souhaitez vous supprimer ce to do ? FDP"))
				{
					var e = $(this);
					$.ajax({
						"url": "delete.php",
						"data": {
							"id": id
						}
					}).done(function(data)
					{
						delete todo_list[id];
						e.remove();
					});
				}
			}));
	}

	function newTodo()
	{
		var todo = prompt("Add a ToDo to the list");
		if (todo == null || todo.length == 0)
			return ;
		$.ajax({
			"url": "insert.php",
			"data": {
				"todo": todo
			}
		}).done(function(data)
		{
			if (data.length == 0
				|| (data = data.split("\n")[0]).length == 0)
				return ;
			addTodo(data, todo);
		});
	}

	function loadTodoList()
	{
		$.ajax({
			"url": "select.php"
		}).done(function(data)
		{
			data = data.split("\n");
			for (var i in data)
			{
				if (data[i].length == 0)
					continue ;
				i = data[i].split(";");
				addTodo(i[0], decodeURIComponent(i[1]));
			}
		});
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
