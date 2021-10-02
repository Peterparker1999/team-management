<?php
include "db_connect.php";
$column_name="*";
$table_name="test1";

$sno=NULL;
$name='Khalnayak';
$branch="CSE";
$Rollno=13;
$Percentage=45.2;

function select_all_query($column_name,$table_name)
{
	$query="select $column_name from $table_name";
	return $query;
}

function select_where_query($column_name,$table_name,$name)
{
	$query="select $column_name from $table_name where name='$name'";
	return $query;
}

function insert_query($table_name,$name,$Rollno,$Percentage)
{
	$query="INSERT INTO $table_name VALUES(NULL,'$name','$Rollno',$Percentage)";
	return $query;
}

function delete_query($table_name,$name)
{
	$query="delete from $table_name where name='$name'";
	return $query;
}

function update_query($table_name,$name)
{
	$query="update $table_name set Name='Aditya' where name='$name'";
	return $query;
}

function create_table($table_name)
{
	$query="create table $table_name(Sno int(100) AUTO_INCREMENT,Name varchar(50),Rollno int(100),Percentage float(50,4),PRIMARY KEY(Sno))";
	return $query;
}

function alter_modify_column($table_name,$column_name)
{
	$query="alter table $table_name modify $column_name int(30)";
	return $query;
}

function alter_add_column($table_name,$column_name)
{
	$query="alter table $table_name add $column_name int(50)";
	return $query;
}

function alter_delete_column($table_name,$column_name)
{
	$query="alter table $table_name drop $column_name";
	return $query;
}

function drop_table($table_name)
{
	$query="drop table $table_name";
	return $query;
}

function truncate_table($table_name)
{
	$query="truncate $table_name";
	return $query;

}

function print_query($query_exec)
{
	echo "<center><table border=1><th>Sno.</th><th>Name</th><th>Roll no.</th><th>branch</th>";
	while($row=mysqli_fetch_array($query_exec))
	{

		echo "<tr><td>".$row["Sno."]."</td><td>".$row["Name"]."</td><td>".$row["Rollno."]."</td><td>".$row["branch"]."</td></tr>";
	}
	echo "</table></center>";
}
echo "<center><h1><b><u>MySQL database</u></b></h1></center>";

#Print Table
$query=select_all_query($column_name,'test1');
$query_exec=mysqli_query($conn,$query);
print_query($query_exec);

#Print with 'where' query
#$query=select_where_query($column_name,$table_name,$name);
#$query_exec=mysqli_query($conn,$query);
#print_query($query_exec);

#Insert Query
#$query=insert_query('test2','sahil',3,23.23);
#$query_exec=mysqli_query($conn,$query);

#Delete Query
#$query=delete_query($table_name,$name);
#$query_exec=mysqli_query($conn,$query);

#Update Query
#$query=update_query($table_name,$name);
#$query_exec=mysqli_query($conn,$query);

#Create Table
#$query=create_table('test2');
#$query_exec=mysqli_query($conn,$query);

#Alter Add Column
#$query=alter_add_column('test2','ID');
#$query_exec=mysqli_query($conn,$query);

#Alter Modify Column
#$query=alter_modify_column('test2','ID');
#$query_exec=mysqli_query($conn,$query);

#Alter Delete Column
#$query=alter_delete_column('test2','ID');
#$query_exec=mysqli_query($conn,$query);

#Drop Table
#$query=drop_table('test2');
#$query_exec=mysqli_query($conn,$query);

#Truncate Table
#$query=truncate_table('test2');
#$query_exec=mysqli_query($conn,$query);

#Print Table
$query=select_all_query($column_name,'test1');
$query_exec=mysqli_query($conn,$query);
print_query($query_exec);
?>
