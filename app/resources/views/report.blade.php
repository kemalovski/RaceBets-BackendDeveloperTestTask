<!DOCTYPE html>
<html>
<head>
<title>List of the total deposits and withdrawals</title>
<style>
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

</head>
<body>

<table>
  <tr>
    <th>Date</th>
    <th>Country</th>
    <th>Unique Customers</th>
    <th>No of Deposits</th>
    <th>Total Deposit Amount</th>
    <th>No of Withdrawals</th>
    <th>Total Withdrawal Amount</th>
  </tr>
  @foreach ($report as $countryInfos)
  <tr>
    <td>{{$countryInfos->date}}</td>
    <td>{{$countryInfos->country}}</td>
    <td>{{$countryInfos->uniqueCustomers}}</td>
    <td>{{$countryInfos->noOfDeposits}}</td>
    <td>{{$countryInfos->totalDepositAmount}}</td>
    <td>{{$countryInfos->noOfWithdrawals}}</td>
    <td>{{$countryInfos->totalWithdrawalAmount}}</td>
  </tr>
  @endforeach
</table>



</body>
</html>
