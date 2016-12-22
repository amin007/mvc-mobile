<?php
function addOpp($person,$contact,$description)
{
	global $mysql_link;

	$sql = "insert opportunities(opp_id,opp_person,opp_contact,opp_description) values (NULL,'$person','$contact','$description')";
	$result = mysql_query($sql,$mysql_link);
	if ($result == 1) {
		return "SUCCESS";
	} else {
		return "FAILED";
	}

}
#------------------------------------------------------------------------------------------------------------------------------------------------------
function updateOpp($id,$person,$contact,$description)
{
	global $mysql_link;

	$sql = "update opportunities set opp_person='".$person."',opp_contact= '".$contact."',opp_description='".$description."' where opp_id= ".$id;
	$result = mysql_query($sql,$mysql_link);
	if ($result == 1) {	return "SUCCESS"; } 
	else { return "FAILED";	}
}
#------------------------------------------------------------------------------------------------------------------------------------------------------
function showOpps()
{
	global $mysql_link;

	$COL_OPPID= 0;
	$COL_PERSON= 1;
	$COL_CONTACT= 2;
	$COL_DESCRIPTION= 3;
	$sql ="select * from opportunities order by opp_id desc";
	$result = mysql_query($sql,$mysql_link);
	   
	if(mysql_num_rows($result) == 0)
	{
		print("\t<a data-rel=\"dialog\" data-transition=\"pop\" href=\"index.php?action=addnew\">Tambah Baru</a><br/>");
	}
	if(mysql_num_rows($result))
	{
		print("\t<a data-rel=\"dialog\" data-transition=\"pop\" href=\"index.php?action=addnew\">Add New Opportunity</a><br/>");
		print("\t<ul data-role=\"listview\" data-filter=\"true\">"); 
		while($row = mysql_fetch_row($result)) 
		{
			print("\t\t<li data-ibm-jquery-contact=\"".$row[$COL_CONTACT]."\">");
			print("<a data-rel=\"dialog\" data-transition=\"pop\" href=\"index.php?action=details&id=".$row[$COL_OPPID]."\">");
			print("Person:&nbsp;".$row[$COL_PERSON]."<br/>");
			print("Contact:&nbsp;".$row[$COL_CONTACT]."<br/>");
			print("Description:&nbsp;".$row[$COL_DESCRIPTION]);
			print("</a>");
			
			print("</li>\n");
		}

		print("\t</ul>");
	}
}
#------------------------------------------------------------------------------------------------------------------------------------------------------
function showOneOpp($id)
{
	global $mysql_link;

	//$data['id'] = $data['person'] = $data['contact'] = $data['description'] = "";

	if ($id != -1) 
	{
		$sql ="select * from opportunities where opp_id = " . $id;
		$result = mysql_query($sql,$mysql_link);
		$fields = mysql_num_fields($result); 
		$rows  = mysql_num_rows($result);
			   
			/*if(mysql_num_rows($result)) {
				$row = mysql_fetch_row($result);
				$person = $row[$COL_PERSON];
				$contact = $row[$COL_CONTACT];
				$description = $row[$COL_DESCRIPTION];
			}*/
			
		while($rowMany = mysql_fetch_array($result, MYSQL_ASSOC))
		{	
			foreach($rowMany as $key => $row)
			{
				$data[substr($key,4,100)] = $row;
			}
		}
			
	}
	else
	{
		$sql ="select * from opportunities";
		$result = mysql_query($sql,$mysql_link);
		$fields = mysql_num_fields($result); 
		$rows  = mysql_num_rows($result);
		//mysql_field_name($result,$f)
			for ($f = 0; $f < ($fields); $f++)
			{
				$row = mysql_field_name($result,$f);
				$data[substr($row,4,100)] = null;
				//echo $row . '|';
			}		
	}

	//echo '<pre>'; print_r($data); echo '</pre>';
	binaBorang($data);

}
#------------------------------------------------------------------------------------------------------------------------------------------------------
function binaBorang($data)
{
		//extract($data);
		
		$id = $data['id'];
		if($id != null)
			print("\t<a rel=\"external\" href=\"javascript:deleteEntry($id)\">Delete this entry</a>");
		
		print("<form method=\"post\" rel=\"external\" action=\"index.php\" onsubmit=\"return checkForm();\">");
		print("<input type=\"hidden\" name=\"action\" value=\"upsert\"/>");
		print("<input type=\"hidden\" name=\"id\" value=\"$id\"/>");
		print("<fieldset>");

		foreach ($data as $key => $value):
			if ($key != 'id'):	
				print("<div data-role=\"fieldcontain\">");
				print("<label for=\"$key\">$key</label>");
				print("<input type=\"text\" name=\"$key\" maxlength=\"100\" id=\"$key\" value=\"$value\" />");
				print("</div>");
			endif;
		endforeach;

		/*print("<div data-role=\"fieldcontain\">");
		print("<label for=\"contact\">Contact info</label>");
		print("<input type=\"text\" name=\"contact\" maxlength=\"100\" id=\"contact\" value=\"$contact\" />");
		print("</div>");

		print("<div data-role=\"fieldcontain\">");
		print("<label for=\"description\">Comments</label>");
		print("<input type=\"text\" name=\"description\" maxlength=\"100\" id=\"description\" value=\"$description\" />");
		print("</div>");*/

		print("</fieldset>");
		print("<button type=\"submit\" value=\"Save\">Save Opportunity</button>");

		print("</form>\n");
	
}
#------------------------------------------------------------------------------------------------------------------------------------------------------
function showOneOppJSON($id)
{
	global $mysql_link;

	$COL_OPPID= 0;
	$COL_PERSON= 1;
	$COL_CONTACT= 2;
	$COL_DESCRIPTION= 3;
	$sql ="select * from opportunities where opp_id = " . $id;
	$result = mysql_query($sql,$mysql_link);
	$ret = '';   
	if(mysql_num_rows($result))
	{
		$row = mysql_fetch_row($result);
		$ret = "{\"id\":\"".$row[$COL_OPPID]."\",\"person\":\"".$row[$COL_PERSON]."\",\"contact\":\"".$row[$COL_CONTACT]."\",\"description\":\"".$row[$COL_DESCRIPTION]."\"}";
		return $ret;
	}
}
#------------------------------------------------------------------------------------------------------------------------------------------------------
function killOpp($id)
{
	global $mysql_link;

	$sql = "delete from opportunities where opp_id =$id";
	$result = mysql_query($sql,$mysql_link);

}
#------------------------------------------------------------------------------------------------------------------------------------------------------
?>