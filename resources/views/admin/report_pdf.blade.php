<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">

<style>

body{
    font-family: DejaVu Sans;
}

table{

    width:100%;
    border-collapse:collapse;

}

th,td{

    border:1px solid #000;
    padding:8px;
    text-align:center;

}

h2{

    text-align:center;

}

</style>

</head>

<body>

<h2>

Library Management System Report

</h2>

<table>

<tr>

<th>Total Books</th>
<td>{{ $totalBooks }}</td>

</tr>

<tr>

<th>Available Books</th>
<td>{{ $availableBooks }}</td>

</tr>

<tr>

<th>Borrowed Books</th>
<td>{{ $borrowedBooks }}</td>

</tr>

<tr>

<th>Returned Books</th>
<td>{{ $returnedBooks }}</td>

</tr>

<tr>

<th>Active Members</th>
<td>{{ $activeMembers }}</td>

</tr>

<tr>

<th>Overdue Books</th>
<td>{{ $overdueBooks }}</td>

</tr>

<tr>

<th>Fine Collection</th>
<td>৳ {{ number_format($fineCollection,2) }}</td>

</tr>

</table>

</body>
</html>