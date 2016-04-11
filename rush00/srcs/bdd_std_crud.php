<?php

/*
** UNUSED
*/

include "file_save.php";

function std_load($bdd_file)
{
	return (load_from_file($bdd_file));
}

function std_save($bdd_file, $bdd_std)
{
	return (save_to_file($bdd_file, $bdd_std));
}

/*
** CREATE_ELEMENT
** return false if element name already exist
** return true otherwise
*/
function std_add($bdd_file, $element)
{
	//echo "element: " . $element . "\n";
	if (std_get($bdd_file, $element))
		return ($element . " already exist");
	if (!($bdd_std = std_load($bdd_file)))
		return ("Database not found");
	$bdd_std[] = $element;
	if (!(std_save($bdd_file, $bdd_std)))
		return ("Unable to apply change to the database");
	return (TRUE);
}

/*
** READ_ELEMENT
** return false if element name doesn't match
** return element name otherwise
*/
function std_get($bdd_file, $element)
{
	if (!($bdd_std = std_load($bdd_file)))
		return ("Unable to access the database");
	foreach ($bdd_std as $elem)
		if ($element == $elem)
			return ($element);
	return (FALSE);
}

/*
** READ_KEY
** return false if element name doesn't match
** return element's key otherwise
*/
function std_get_key($bdd_file, $element)
{
	if (!($bdd_std = std_load($bdd_file)))
		return ("Unable to access the database");
	foreach ($bdd_std as $key => $value)
		if ($element == $value)
			return ($key);
	return (FALSE);
}

/*
** DELETE_ELEMENT
** return false if element name doesn't exist
** return true otherwise
*/
function std_del($bdd_file, $element)
{
	if (!($bdd_std = std_load($bdd_file)))
		return ("Unable to access the database");
	foreach ($bdd_std as $key => $value)
	{
		if ($element == $value)
		{
			unset($bdd_std[$key]);
			std_save($bdd_file, $bdd_std);
			return (TRUE);
		}
	}
	return ($element . " not found");
}
?>
